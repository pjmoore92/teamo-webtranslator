<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Welcome extends CI_Controller {

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

	private $_static_dir;

	public function __construct(){
		parent::__construct();
		$this->_static_dir = 'static';
	}

	public function index()
	{
                $this->lang->load('common');
                $this->lang->load('home');
                $this->template->set('title', '');
                $this->template->load('template', 'welcome_message');
	}

	public function contact($selected = NULL)
	{

		$data['dropdown_opts'] = array(
				'general_enquiry' => 'General Enquiry',
				'quote' => 'Quote',
				'video_translation' => 'Video Translation',
				'interpretation' => 'Interpretation',
				'other' => 'Other'
			);
		
		if( isset($selected) && in_array($selected, array_keys($data['dropdown_opts'])))
				$data['selected'] = $selected;

		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		//TODO: set rules for dropdown!
		
		if($this->form_validation->run() == FALSE)
		{
			$this->lang->load('common');
                		$this->lang->load('home');
                		$this->template->set('title', 'Contact');
                		$this->template->load('template', 'contact', $data);
		}
		else
		{
			// validation has passed. Now send the email
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			$subjectselect = $this->input->post('select01');
			
			$this->load->library('email');
			$this->email->set_newline("\r\n");

			$this->email->from($email, $name);
			$this->email->to('pjmoore@staloysius.org');
			$this->email->cc('teamo@stbernadettes.co.uk');		
			$this->email->subject('Bethel Translations: '.$subjectselect);		
			$this->email->message($message);

			
			if($this->email->send())
			{
			$array = 'Your Message has been sent!';
			?>
			<div class="span3 alert alert-block fade in">
            <a class="close" data-dismiss="alert" href="#">x</a>
            <strong><?php echo $array; ?></strong>
			</div>
            <?php
			$this->lang->load('common');
                		$this->lang->load('home');
                		$this->template->set('title', '');
                		$this->template->load('template', 'welcome_message');
			}

			else
			{
				show_error($this->email->print_debugger());
			}			
		}
	}

	public function view( $page = 'home'){

		if ( ! file_exists("application/views/{$this->_static_dir}/{$page}.php"))
			show_404();
		
		$this->lang->load('common');

		$title = ucfirst(str_replace('_', ' ', $page));

		$this->template->set('title', "{$title} - ");
		$this->template->load('template', $this->_static_dir . '/' . $page);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
