<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Client extends CI_Controller {

	private $_user_id;
	private $_client_name;
	private $_view_template;

	public function __construct(){
		parent::__construct();

		$this->load->library('tank_auth');

		if(!$this->tank_auth->is_logged_in())
			redirect('auth/login');
		else{
			$this->_user_id = $this->session->userdata('user_id');

			$this->load->model('customer_model');
			$user = $this->customer_model->get_customer_name($this->_user_id);
			$this->_client_name = $user->title . '. ' . $user->fullName;

			$this->_view_template = 'dashboard/client/template';
		}
	}

	public function index(){

		$data['content'] = 'dashboard/client/main';
		$data['name'] = $this->_client_name;

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', $this->_view_template, $data);
	}

	public function submit(){

		$this->lang->load('common');
		$this->lang->load('home');


			$data['content'] = 'dashboard/client/submit';
			$data['name'] = $this->_client_name;

			$this->template->set('title', 'Client Dashboard -');
			$this->template->load('template', $this->_view_template, $data);

	}

	public function add_job(){

		if(!$this->input->is_ajax_request()){
			return json_encode(array('error' => 'Somthin\' ain\' right :<'));
		}
		else{
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('toLanguage', 'To language', 'required');
			$this->form_validation->set_rules('fromLanguage', 'From language', 'required');

			if ($this->form_validation->run() == FALSE){
				return json_encode(array('error' => 'Somthin\' ain\' right :<'));
			}
			else{
				
				$dateDue = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60));

				$job_data = array(
								'customerID' => $this->_user_id,
								'status' => 'QuoteReq',
								'dateDue' => $dateDue,
								'toLanguage' => $this->form_validation->set_value('toLanguage'),
								'fromLanguage' => $this->form_validation->set_value('fromLanguage')
							);

				$this->load->model('job_model');
				$this->job_model->add_job($job_data);

				die(json_encode(array('response' => 'WOOHOO!')));
			}
		}

		// $data['name'] = $this->_client_name;
		// $data['content'] = 'dashboard/client/main';

		// $this->template->set('title', 'Client Dashboard -');
		// $this->template->load('template', $this->_view_template, $data);
		

	}

	public function pending(){
		
		$this->load->model('job_model');
		$data['pending_jobs_list'] = $this->job_model->get_all_pending($this->_user_id);

		$data['name'] = $this->_client_name;
		$data['content'] = 'dashboard/client/pending';

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', $this->_view_template, $data);
	}
   
  public function quotes(){
  
		$this->load->model('job_model');
		$data['quoted_jobs_list'] = $this->job_model->get_all_quoted($this->_user_id);

		$data['name'] = $this->_client_name;
		$data['content'] = 'dashboard/client/quotes';

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', $this->_view_template, $data);
  }
  
  public function translations(){

		$this->load->model('job_model');
		$data['translated_jobs_list'] = $this->job_model->get_all_translated($this->_user_id);

		$data['name'] = $this->_client_name;
		$data['content'] = 'dashboard/client/translations';

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', $this->_view_template, $data);
  }
  
  public function history(){
  
		$this->load->model('job_model');
		$data['historic_jobs_list'] = $this->job_model->get_all_history($this->_user_id);

		$data['name'] = $this->_client_name;
		$data['content'] = 'dashboard/client/history';

		$this->template->set('title', 'Client Dashboard -');
		$this->template->load('template', $this->_view_template, $data);
  }
  
}