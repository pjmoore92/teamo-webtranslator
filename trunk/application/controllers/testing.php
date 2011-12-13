<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Testing extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}


	public function getAllUsers(){
		$this->load->model('customer_model');
		$customers = $this->customer_model->getAllCustomers();
		if($customers == NULL)
			echo 'No customers registered';
		else{
			foreach($customers as $customer){
				print_r($customer);
			}
		}
	}
}