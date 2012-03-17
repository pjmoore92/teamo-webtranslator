<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Payment_validation extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->library('Paypal2');

	}

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
			show_404('PP');
	}
}
