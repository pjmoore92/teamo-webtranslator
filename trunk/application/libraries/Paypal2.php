<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal2{

	public function __construct(){
		$this->ci =& get_instance();

		$this->ci->load->library('pp_utils');
		$this->ci->load->library('ewpservices');
		$this->ci->config->load('paypal');
	}
	
	public function get_button($job){

		$buttonParams = array(
			"cmd" => "_xclick",
			"business" => $this->ci->config->item("DEFAULT_EMAIL_ADDRESS"),
			"cert_id" => $this->ci->config->item("DEFAULT_CERT_ID"),
			"charset" => "UTF-8",
			"item_name" => "Translation services",
			"item_number" => $job->jobID,
			"amount" => $job->quote,
			"currency_code" => strtoupper($job->currency),
			"return" => base_url('/dashboard/jobs/quoted'),
			"cancel_return" => base_url('/dashboard/jobs/quoted'),//http://alasdaircampbell.com/en", //$this->input->post("cancelURL", TRUE),
			"notify_url" => base_url('/en/payment_validation/validate')
		);

		$envURL = "https://www.".$this->ci->config->item("DEFAULT_ENV").".paypal.com";

		$buttonReturn = $this->ci->ewpservices->encryptButton(
			$buttonParams,
			realpath($this->ci->config->item("DEFAULT_EWP_CERT_PATH")),
			realpath($this->ci->config->item("DEFAULT_EWP_PRIVATE_KEY_PATH")),
			$this->ci->config->item("DEFAULT_EWP_PRIVATE_KEY_PWD"),
			realpath($this->ci->config->item("PAYPAL_CERT_PATH")),
			$envURL,
			$this->ci->config->item("BUTTON_IMAGE")
		);

		if(!$buttonReturn["status"]) {
			// $this->pp_utils->PPError($buttonReturn["error_msg"], $buttonReturn["error_no"]);
			log_message('error', $buttonReturn["error_no"] . " " . $buttonReturn["error_msg"]);
			return NULL;
		}
		
		return $buttonReturn["encryptedButton"];

	}

	public function validate_ipn($arg){
		$log_str = "****************************************************************************************************\n";
		if(array_key_exists("txn_id", $arg)) {
			$log_str .= "Received IPN,  TX ID : ".htmlspecialchars($arg["txn_id"]);
			$log_str .= "%d %b %Y %H:%M:%S " . "[IPNListner.php] $log_str\n";
		} else {
			$log_str .= "IPN Listner recieved an HTTP request with out a Transaction ID.";
			$log_str .= "%d %b %Y %H:%M:%S\n";
			exit;
		}

		$item_number = $arg['item_number'];
		$mc_currency = $arg['mc_currency'];
		$mc_gross = $arg['mc_gross'];

		$tmpAr = array_merge($arg, array("cmd" => "_notify-validate"));
		$postFieldsAr = array();
		foreach ($tmpAr as $name => $value) {
			$postFieldsAr[] = "$name=$value";
		}
		$log_str .= "Sending IPN values:\n".implode("&", $postFieldsAr);
		$log_str .= "%d %b %Y %H:%M:%S " . "[IPNListner.php] $log_str\n";

		$ppResponseAr = $this->ci->pp_utils->PPHttpPost("https://www.".$this->ci->config->item("DEFAULT_ENV").".paypal.com/cgi-bin/webscr", implode("&", $postFieldsAr), false);
		if(!$ppResponseAr["status"]) {
			$log_str .= "--------------------\n";
			$log_str .= "IPN Listner recieved an Error:\n";

			if(0 !== $ppResponseAr["error_no"]) {
				$log_str .= "Error ".$ppResponseAr["error_no"].": ";
			}
			$log_str .= $ppResponseAr["error_msg"];
			$log_str .= "%d %b %Y %H:%M:%S " . "[IPNListner.php] $log_str\n";
			log_message('error', $log_str);
			exit;
		}

		$log_str .= "--------------------\n";
		$log_str .= "IPN Post Response:\n".$ppResponseAr["httpResponse"];
		$log_str .= "%d %b %Y %H:%M:%S " . "[IPNListner.php] $log_str\n";
		
		$this->ci->load->library('jobs');
		$job = $this->ci->jobs->get_job_by_id($item_number);
		if($job != NULL)
			if(strtoupper($job->currency) != strtoupper($mc_currency) || $job->quote != intval($mc_gross))
				log_message('error', 'Transaction #'.$item_number . ' failed the check:\n' . $log_str);
			else{
				
                $job_data = array(
	                'jobID' => $item_number,
	                'status' => 'Paid'
                );
				
				$this->ci->jobs->update_job($job_data);
			}
		else
			log_message('error', 'IPN Validation: Could not load the job #' . $item_number);
	}

}