<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('string');

		$this->load->library('form_validation');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}


	public function register(){

		//check if request was AJAX or not
		if(!$this->input->is_ajax_request())
			redirect('');
		else{
			$this->form_validation->set_rules(
				'name',
				'Name',
				'trim|required|xss_clean|callback__alphadash_space)'
			);
			$this->form_validation->set_rules(
				'email',
				'E-mail',
				'trim|required|valid_email' 
			);
			/* FIXME add is_unique[customer.email] */

			if($this->form_validation->run() == FALSE)
				echo json_encode(array('error'=>'form validation error'));
			else{
				$name = $this->input->post('name');
				$email = $this->input->post('email');

				$refcode = random_string('alpha', 8);

				$arr = array('name' => $name, 'email' => $email, 'refcode' => $refcode);

				$this->load->model('customer_model');
				if($this->customer_model->registerCustomer($arr))
					echo json_encode($arr);
				else
					echo json_encode(array('error'=>'model error'));
			}
		}
	}

	private function _alpha_dash_space($str){
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */
