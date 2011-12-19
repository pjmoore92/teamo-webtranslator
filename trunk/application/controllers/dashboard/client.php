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
		
		$this->load->model('tank_auth/users');
		$user = $this->users->get_user_by_id($user_id, TRUE);
		$data['email'] = $user->email;

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', 'dashboard/client', $data);

	}
}