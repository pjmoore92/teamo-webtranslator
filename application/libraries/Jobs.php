<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jobs{

	public function __construct(){

		$this->ci =& get_instance();

	}

	public function add_job($args){
		
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

	private function _upload_files(){
		return NULL;
	}

}

/* End of file Jobs.php */
