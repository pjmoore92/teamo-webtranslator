<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->template->set('title', 'Admin Dashboard -');
		$this->template->load('template', 'dashboard/admin');

	}
}