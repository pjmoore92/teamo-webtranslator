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

	public function login(){
		if ($this->tank_auth->is_logged_in()) {									// logged in
			echo 'WOOHOO, you\'re logged in!';
			//redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				if ($data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
			}
			$data['errors'] = array();

			if ($this->form_validation->run()) {
				// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email']))
				{
					// success
					redirect('');

				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			$this->lang->load('common');
			$this->lang->load('home');

			$this->template->set('title', 'Login');
			$this->template->load('template', 'login_form', $data);
			// $this->load->view('login_form', $data);
		}
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

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if($this->form_validation->run() == FALSE)
				echo json_encode(array('error'=>'form validation error'));
			else{
				//validation was ok

				$name =  $this->form_validation->set_value('name');
				$email = $this->form_validation->set_value('email');
				$refcode = strtoupper(random_string('alpha', 8));

				if (!is_null(
						$data = $this->tank_auth->registerCustomer(
							$name,
							$email,
							$refcode,
							$email_activation))
				){
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {
						// send "activate" email
						$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
						$data['name'] = $name;
						$data['refcode'] = $refcode;
						$this->_send_email('activate', $data['email'], $data);
						unset($data['password']); // Clear password (just in case)
						// $this->_show_message($this->lang->line('auth_message_registration_completed_1'));
					}

					echo json_encode(array('name' => $name, 'email' => $email, 'refcode' => $refcode));

				}
				else
					echo json_encode(array('error'=>'model error'));
			}
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate(){
		$user_id		= $this->uri->segment(4);
		$new_email_key	= $this->uri->segment(5);

		// Activate user
		if ($this->tank_auth->activateCustomer($user_id, $new_email_key)) {
			// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('auth/login/', 'Login'));

		} else {
			// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}


	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	private function _send_email($type, $email, &$data){

		$data['username'] = '';

		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message){
		$this->session->set_flashdata('message', $message);
		echo $message;
		// redirect('/auth/');
	}

	private function _alpha_dash_space($str){
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */
