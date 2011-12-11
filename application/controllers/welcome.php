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
	public function index()
	{
                $this->template->set('title', '');
                $this->template->load('template', 'welcome_message');
	}

	public function about()
	{
                $this->template->set('title', 'About');
                $this->template->load('template', 'about');
	}

	public function testimonials()
	{
                $this->template->set('title', 'Testimonials -');
                $this->template->load('template', 'testimonials');
	}

	public function contact()
	{
                $this->template->set('title', 'Contact -');
                $this->template->load('template', 'contact');
	}

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('welcome', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
