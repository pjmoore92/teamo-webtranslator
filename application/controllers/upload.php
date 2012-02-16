<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
        print_r($_FILES);
		$config['upload_path'] = 'incoming/';
		$config['allowed_types'] = 'pdf|doc|docx|rtf|txt';
		$config['max_size']	= '150';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload');
        $this->upload->initialize($config); // MUST CALL ELSE config not loaded

		if ( ! $this->upload->do_upload('file')) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}
		else {
			$data = array('upload_data' => $this->upload->data());

//            $this->load->model('translation_model');
//            $this->translation_model->add_orig($job, $filePath);

			$this->load->view('upload_success', $data);
		}
	}
}
?>
