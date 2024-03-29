<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('dashboard/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('auth/send_again/');

		} else {
			$data['login_by_username'] = (
				$this->config->item('login_by_username', 'tank_auth') AND
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
					$this->form_validation->set_rules(
						'recaptcha_response_field',
						'Confirmation Code',
						'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules(
						'captcha',
						'Confirmation Code',
						'trim|xss_clean|required|callback__check_captcha');
			}
			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {								// success
					redirect('dashboard/');

				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('auth/send_again/');

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

			$this->template->set('title', 'Login');
			$this->template->load('template', 'login_form', $data);

			// $this->load->view('auth/login_form', $data);
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();

        redirect('welcome', 'location');
		//$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		if(!$this->input->is_ajax_request()){
			redirect('');
		}
		else
			if ($this->tank_auth->is_logged_in()) {									// logged in
				redirect('');

			} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
				redirect('auth/send_again/');

			} else {

				/* set JSON headers */
				$this->output->set_content_type('application/json');

				/* generate client reference code */
				$refcode = strtoupper(random_string('alpha', 8));

				$data['errors'] = array();
				$email_activation = $this->config->item('email_activation', 'tank_auth');

				$config = array(
					'new_client' => array(
						array(
							'field' => 'name',
							'label' => 'Name',
							'rules' => 'trim|required|xss_clean|callback_alphadash_space'
						),
						
						array(
							'field' => 'email',
							'label' => 'Email',
							'rules' => 'trim|required|xss_clean|valid_email'
						),
					//),// end of registration

					//'new_job' => array(
						array(
							'field' => 'lang_from',
							'label' => 'Source language',
							'rules' => 'required|xss_clean|from_lang'
						),

						array(
							'field' => 'lang_to',
							'label' => 'Translation language',
							'rules' => 'required|xss_clean|to_lang'
						),
						
						array(
							'field' => 'deadline',
							'label' => 'Deadline',
							'rules' => 'required|xss_clean|valid_date'
						),
						
						array(
							'field' => 'currency',
							'label' => 'Currency',
							'rules' => 'required|xss_clean|check_currency'
						)
					)
				);
				
				/* run validation for the registration form */
				$this->form_validation->set_rules($config['new_client']);

				/* Form validation error messages */
				$this->form_validation->set_message('required', 'Field <strong>%s</strong> is required');
				$this->form_validation->set_message('valid_email', '<strong>%s</strong> is not a valid e-mail');

				/* check form validation responses */
				if ($this->form_validation->run()) {
					if (!is_null($data = $this->tank_auth->create_user(
							'',
							$this->form_validation->set_value('email'),
							$refcode,
							$email_activation))
					){
						/* user account has been succesfully created */

						$data['site_name'] = $this->config->item('website_name', 'tank_auth');

						if ($email_activation) {
							/* send activation email */

							$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
							$this->_send_email('activate', $data['email'], $data);
						}
						else{
							if ($this->config->item('email_account_details', 'tank_auth')) {
								/* send welcome email */

								$this->_send_email('welcome', $data['email'], $data);
							}
						}
						
						unset($data['password']);

						$customer = new stdClass;
						$customer->id = $data['user_id'];
						$customer->name = $this->form_validation->set_value('name');;
						$customer->email = $this->form_validation->set_value('email');
						$customer->refcode = $refcode;
						$customer->job->customerID = $data['user_id'];
						$customer->job->fromLanguage = $this->form_validation->set_value('lang_from');
						$customer->job->toLanguage = $this->form_validation->set_value('lang_to');
						$customer->job->dateDue = $this->form_validation->set_value('deadline');
						$customer->job->currency = $this->form_validation->set_value('currency');

						/* create the entry in the 'customer' table */
						$this->load->model('customer_model');
						$this->customer_model->add_customer(
							array(
								'customerID' => $customer->id,
								'fullName' => $customer->name
							)
						);


						$this->load->library('jobs');

					
						/* add the job to the DB */
						$customer->job->id = $this->jobs->add_job($customer->job);

						/**
						 * send the customer details, pretty much for debugging only;
						 * live version would only need the name and email
						 **/
    					$this->output->set_output(
	    					json_encode($customer));
					}
					else{
						/* could not add user to the DB */

						$this->output->set_output(
							json_encode(array('error' => 'already_in_use'))
						);
					}
				}
				else{
					/* form validation failed */

					$this->output->set_output(
						json_encode(array('error'=> sprintf("%s", validation_errors())))
					);
				}
			}
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					// $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}

			$message = new stdClass;
			$message->text = $this->lang->line('auth_message_activation_email_sent');
			$message->type = 'success';

			$data['message'] = $message;

			$this->template->set('title', 'Send again -');
			$this->template->load('template', 'auth/send_again_form', $data);

		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(4);
		$new_email_key	= $this->uri->segment(5);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();

			$message = new stdClass;
			$message->text = $this->lang->line('auth_message_activation_completed');
			$message->type = 'success';

			$data = array(
				'message' => $message,
				'login_by_username' => (
					$this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'))
				);

		} else {																// fail
			$message = new stdClass;
			$message->text = $this->lang->line('auth_message_activation_failed');
			$message->type = 'error';

			$data = array(
				'message' => $message,
				'login_by_username' => (
					$this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'))
			);

		}
		
		$this->template->set('title', 'Login -');
		$this->template->load('template', 'auth/login_form', $data);
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					// $this->_show_message($this->lang->line('auth_message_new_password_sent'));
					$message = new stdClass;
					$message->text = $this->lang->line('auth_message_new_password_sent');
					$message->type = 'success';

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}

			$data['message'] = ( isset($message) ? $message : NULL);

			$this->template->set('title', 'Forgotten password -');
			$this->template->load('template', 'auth/forgot_password_form', $data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(4);
		$new_pass_key	= $this->uri->segment(5);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				// $this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('auth/login/', 'Login'));
				$message = new stdClass;
				$message->text = $this->lang->line('auth_message_new_password_activated');
				$message->type = 'success';

				$data['message'] = $message;

			} else {														// fail
				// $this->_show_message($this->lang->line('auth_message_new_password_failed'));

				$message = new stdClass;
				$message->text = $this->lang->line('auth_message_new_password_failed');
				$message->type = 'error';

				$data['message'] = $message;
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				// $this->_show_message($this->lang->line('auth_message_new_password_failed'));

				$message = new stdClass;
				$message->text = $this->lang->line('auth_message_new_password_failed');
				$message->type = 'error';

				$data['message'] = $message;
			}
		}

		$data['message'] = ( isset($message) ? $message : NULL);

		$this->template->set('title', 'Reset password -');
		$this->template->load('template', 'auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

					$message = new stdClass;
					$message->text = $this->lang->line('auth_message_password_changed');
					$message->type = 'success';

					$data['message'] = $message;

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}

			$this->template->set('title', 'Change password -');
			$this->template->load('template', 'auth/change_password_form', $data);
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
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
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	public function alpha_dash_space($str){
		if( preg_match("/^([-a-z_ ])+$/i", $str))
			return TRUE;
		else{
			$this->form_validation->set_message('alpha_dash_space', 'That name is not allowed');
			return FALSE;
		}
    }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
