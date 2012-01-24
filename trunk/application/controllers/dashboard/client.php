<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Client extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('tank_auth');
		if(!$this->tank_auth->is_logged_in())
			redirect('auth/login');
	}

	public function index(){

		$user_id = $this->session->userdata('user_id');
		
		$this->load->model('customer_model');
		$user = $this->customer_model->get_customer_name($user_id);
		$data['name'] = $user->title . '. ' . $user->fullName;

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', 'dashboard/client', $data);

	}

	public function pending(){
		
		$user_id = $this->session->userdata('user_id');

		$this->load->model('job_model');
		$pending_jobs_list = $this->job_model->get_all_pending($user_id);

		if($pending_jobs_list == NULL)
			echo ':( You have no pending jobs.';
		else
			print_r($pending_jobs_list);
	}
   
  public function quotes(){
  
    $user_id = $this->session->userdata('user_id');

		$this->load->model('job_model');
		$quoted_jobs_list = $this->job_model->get_all_quoted($user_id);

		if($quoted_jobs_list == NULL)
			echo ':( You have no quoted jobs.';
		else
			print_r($quoted_jobs_list);
  }
  
  public function translations(){
  
    $user_id = $this->session->userdata('user_id');

		$this->load->model('job_model');
		$translated_jobs_list = $this->job_model->get_all_translated($user_id);

		if($translated_jobs_list == NULL)
			echo ';( You have no jobs that have been translated.';
		else
			print_r($translated_jobs_list);
  }
  
  public function history(){
  
    $user_id = $this->session->userdata('user_id');

		$this->load->model('job_model');
		$historic_jobs_list = $this->job_model->get_all_history($user_id);

		if($historic_jobs_list == NULL)
			echo 'You have no historic jobs.';
		else
			print_r($historic_jobs_list);
  }
  
}