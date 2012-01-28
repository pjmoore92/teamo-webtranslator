<?php

class Form extends CI_Controller
{
 function index()
 {
  $this->load->helper(array('form', 'url'));
  $this->load->library('form_validation');
  $this->form_validation->set_rules('full_name', 'Full Name', 'required');
  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
  $this->form_validation->set_rules('subject', 'Subject', 'required');
  $this->form_validation->set_rules('comment', 'Comment', 'required');
  if ($this->form_validation->run() == FALSE)
  {
   $this->load->view('contact');
  }
  else
  {
   $this->load->library('email');
   $this->config->item('protocol');

   $this->email->from($this->input->post('email'), $this->input->post('full_name'));
   $this->email->to('pjmoore92@gmail.com');
   $this->email->subject('Email Test');
   $this->email->message($this->input->post('comment'));
   if($this->email->send())
   {
    echo 'Your email has been sent';
   }
   else
   {
    show_error($this->email->print_debugger());
   }
  }
 }
}
?> 