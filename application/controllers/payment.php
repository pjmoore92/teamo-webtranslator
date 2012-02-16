<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Payment extends MY_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->library('Paypal');
	}

	
	public function pay($jobid = NULL){

		if($jobid == NULL)
			show_404();

		$this->load->model('job_model');
		
		//get the job details
		$job = $this->job_model->get_job_by_id($jobid, $this->_user_id);
		if($job == NULL)
			show_404();

		$this->paypal->addField('business', 'andrei_1329069076_biz@gmail.com');

		// Specify the currency
		$this->paypal->addField('currency_code', 'GBP');// TODO: get currency from DB?

		// Specify the url where paypal will send the user on success/failure
		$this->paypal->addField('return', 'http://alasdaircampbell.com/payment/success/'.$job->jobID);
		$this->paypal->addField('cancel_return', 'http://alasdaircampbell.com/payment/failure');

		// Specify the url where paypal will send the IPN
		$this->paypal->addField('notify_url', 'http://alasdaircampbell.com/paypal/paypal_ipn.php');

		// Specify the product information
		$this->paypal->addField('item_name', 'Translation services');
		$this->paypal->addField('amount', $job->quote);
		$this->paypal->addField('item_number', $job->jobID);

		// Specify any custom value
		// $this->paypal->addField('custom', 'muri-khao');

		// Enable test mode if needed
		$this->paypal->enableTestMode();

		// Let's start the train!
		$this->paypal->submitPayment();

		
		// $this->load->library('curl');

		// $data = array(
  //           'business'=>"andrei_1329069076_biz@gmail.com",
  //           'cmd'=>"_xclick",
  //           'item_name'=>"Translation Services",
  //           'amount'=>"5.95",
  //           'currency_code'=>"USD"
  //       );

		// $this->curl->create("https://www.sandbox.paypal.com/cgi-bin/webscr");
		// $this->curl->post($data);
		// echo $this->curl->execute();

	}

	public function success($jobid = NULL){
		if($jobid == NULL)
			show_404();

		$this->load->model('job_model');
		$this->job_model->set_job_status($jobid, 'Paid');

                
        $this->_data['content'] = 'payment/success';

        $this->template->set('title', $this->_data['role']. ' Dashboard -');
        $this->template->load('template', $this->_view_template, $this->_data);
	}

	public function failure(){
        $this->_data['content'] = 'payment/failure';

        $this->template->set('title', $this->_data['role']. ' Dashboard -');
        $this->template->load('template', $this->_view_template, $this->_data);
	}

}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
