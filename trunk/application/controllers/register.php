<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->helper('form');
		
		// $this->load->database();

		$this->load->library('tank_auth');
		$this->load->library('form_validation');
	}

	public function index(){

		//check if request was AJAX or not
		if(!$this->input->is_ajax_request())
			redirect('');
		else{

			$this->form_validation->set_rules(
				'name',
				'Name',
				'trim|required|alpha_dash'
			);
			$this->form_validation->set_rules(
				'email',
				'E-mail',
				'trim|required|valid_email' 
			);
			/* FIXME add is_unique[customer.email] */

			if($this->form_validation->run() == FALSE)
				die('');
			else{
				$name = $this->input->post('name');
				$email = $this->input->post('email');

				$refcode = random_string('alpha', 8);

				$arr = array('name' => $name, 'email' => $email, 'refcode' => $refcode);

				$this->load->model('customer_model');
				if($this->customer_model->registerCustomer($arr))
					echo json_encode($arr);
				else die(array('name'=>'model error'));
			}
		}
	}
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */
