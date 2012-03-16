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

		//upload files;
		// $this->ci->load->library('upload');
		// $response = $this->ci->upload->upload_files();
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

	private function _send_email($type, $email, $data){
		$this->ci->load->library('email');
		$this->ci->email->from($this->ci->config->item('webmaster_email', 'tank_auth'), $this->ci->config->item('website_name', 'tank_auth'));
		$this->ci->email->reply_to($this->ci->config->item('webmaster_email', 'tank_auth'), $this->ci->config->item('website_name', 'tank_auth'));
		$this->ci->email->to($email);
		$this->ci->email->subject(sprintf($this->ci->lang->line('auth_subject_'.$type), $this->ci->config->item('website_name', 'tank_auth')));
		$this->ci->email->message($this->ci->load->view('email/'.$type.'-html', $data, TRUE));
		$this->ci->email->set_alt_message($this->ci->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->ci->email->send();
	}

	private function _upload_files(){
		return NULL;
	}

}

/* End of file Jobs.php */
