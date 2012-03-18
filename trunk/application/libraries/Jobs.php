<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jobs{

	public function __construct(){

		$this->ci =& get_instance();

	}

	public function add_job($args){
		
		// change date format from dd-mm-yyyy to yyyy-mm-dd, for SQL
		$args->dateDue = date("Y-m-d", strtotime($args->dateDue));;

		$this->ci->load->model('job_model');
		$jobID = $this->ci->job_model->add_job($args);

		return $jobID[0]->jobID;
	}

	public function get_jobs($status, $customerID = NULL){
		
		$this->ci->load->model('job_model');
		$jobs_list = $this->ci->job_model->get_jobs($status, $customerID);

		if($jobs_list == NULL)
			return NULL;

		$this->ci->load->model('translation');
		foreach($jobs_list as $job){
			$job->translations = array();
			$job->translations = $this->ci->translation->get_translations($job->jobID);
		}

		return $jobs_list;
	}

	public function update_job($args){
		$this->ci->load->model('job_model');
		$this->ci->job_model->update_job($args);

		//email
		$job = $this->ci->job_model->get_job($args['jobID']);
		if($job != NULL){
			$this->ci->load->model('tank_auth/users');
			$customer = $this->ci->users->get_user_by_id($job->customerID, TRUE);

			if($customer != NULL){
				$this->_send_email('job_status_change', $customer->email, array('customer' => $customer, 'job' => $job));
			}
		}
	}

	public function get_job_by_id($jobID){
		$this->ci->load->model('job_model');
		return $this->ci->job_model->get_job_by_id($jobID);
	}

	public function add_document($trans, $orig, $file){
		$this->ci->load->model('translation');

		$job = $this->ci->translation->add_trans($trans, $orig, $file);

       	if( isset($job) ){
	        // update job status if ALL translations uploaded
	        if($this->ci->translation->all_translated($job)) {
				$job_data = array(
					'jobID' => $job,
					'status' => 'Translated'
				);

	            $this->update_job($job_data);
	        }

	        return TRUE;
	    }

	    return FALSE;
	}

	private function _send_email($type, $email, $data){
		$this->ci->load->library('email');
		$this->ci->email->from($this->ci->config->item('webmaster_email', 'tank_auth'), $this->ci->config->item('website_name', 'tank_auth'));
		$this->ci->email->reply_to($this->ci->config->item('webmaster_email', 'tank_auth'), $this->ci->config->item('website_name', 'tank_auth'));
		$this->ci->email->to($email);
		$this->ci->email->subject('Bethel Translations job update');
		$this->ci->email->message($this->ci->load->view('email/'.$type.'-html', $data, TRUE));
		$this->ci->email->set_alt_message($this->ci->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->ci->email->send();
	}

}

/* End of file Jobs.php */
