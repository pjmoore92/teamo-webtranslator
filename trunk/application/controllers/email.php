<?php

/**
* SENDS EMAIL WITH GMAIL
*/
class Email extends CI_Controller
{
	
	
	function index() 
	{
		$this->load->view('contact');
	}
	
	function send() 
	{	
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('contact');
		}
		else
		{
			// validation has passed. Now send the email
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			
			$this->load->library('email');
			$this->email->set_newline("\r\n");

			$this->email->from($email, $name);
			$this->email->to('pjmoore@staloysius.org');		
			$this->email->subject('Contact Page Email');		
			$this->email->message($message);

			
			if($this->email->send())
			{	
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
}


      