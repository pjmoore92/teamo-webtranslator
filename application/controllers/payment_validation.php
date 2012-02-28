<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Payment_validation extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->library('Paypal2');

	}


	// public function index(){
	// 	// Log the IPN results
	// 	$this->paypal->ipnLog = TRUE;

	// 	// Enable test mode if needed
	// 	$this->paypal->enableTestMode();

	// 	// Check validity and write down it
	// 	if ($this->paypal->validateIpn()){
	// 	    if ($this->paypal->ipnData['payment_status'] == 'Completed'){
	// 			log_message('error', 'PayPal IPN: SUCCESS' . $this->paypal->ipnData);
	// 	    }
	// 	    else{
	// 			log_message('error', "PayPal IPN: FAILURE\n\n" . $this->paypal->ipnData);
	// 	    }
	// 	}
	// 	log_message('error', 'PayPal IPN: validateIpn failed');
	// }

	public function validate(){
		
		if($this->input->post(NULL, TRUE)){
			log_message('error', 'I\'m in validate()!');
			$ipn = array();
			foreach ($this->input->post(NULL, TRUE) as $name => $value) {
				$ipn["$name"] = "$value";
			}
			$this->paypal2->validate_ipn($ipn);
		}
		else
			show_404('PLM!!!!!!!!');
	}
}
