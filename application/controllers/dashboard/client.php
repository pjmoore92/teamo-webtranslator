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
}