<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Client extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', 'dashboard/client');

	}
}