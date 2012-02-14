<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Payment extends CI_Controller{

	
	public function pay(){
		
		$this->load->library('curl');

		// $data['cmd'] = "_notify-validate";
		$data = array(
            'business'=>"andrei_1329069076_biz@gmail.com",
            'cmd'=>"_xclick",
            'item_name'=>"Translation Services",
            'amount'=>"5.95",
            'currency_code'=>"USD"
        );

		$this->curl->create("https://www.sandbox.paypal.com/cgi-bin/webscr");
		$this->curl->post($data);
		echo $this->curl->execute();

	}

}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
