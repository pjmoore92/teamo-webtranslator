<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	protected $_user_id;
	protected $_view_template;
	protected $_data;
	    
    public function __construct(){
        
        parent::__construct();
        $this->load->library('tank_auth');

		if(!$this->tank_auth->is_logged_in())
			redirect('auth/login');
        else{
        	$this->_user_id = $this->session->userdata('user_id');

			$this->load->model('customer_model');
			$user = $this->customer_model->get_customer_name($this->_user_id);
			$this->_data['client_name'] = $user->title . '. ' . $user->fullName;
			
			$this->_data['role'] = $this->session->userdata('role');
			
			$this->_view_template = "dashboard/template";
        }
    }
}
