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

	public function contact()
	{
                $this->template->set('title', 'Contact -');
                $this->template->load('template', 'contact');
	}
	
	public function documents()
	{
                $this->template->set('title', 'Document Translation Service -');
                $this->template->load('template', 'doc_trans_serv');
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
