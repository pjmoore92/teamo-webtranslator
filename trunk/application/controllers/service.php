<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
    }
    function upload()
    {
        $this->load->library('plupload');
        echo $this->plupload->process_upload($_REQUEST,$_FILES);
    }
    function uploadtrans()
    {
        $job = $_REQUEST['job'];
        $trans = $_REQUEST['trans'];

        $this->load->library('upload');
        $config['upload_path'] = './files/'.$job.'/';
		$config['allowed_types'] = 'pdf|doc|docx|rtf|txt';
		$config['max_size']	= '20000';
		$config['encrypt_name']	= true;

        $this->upload->initialize($config);

		if ( ! $this->upload->do_upload('upload'))
		{
            $this->session->set_flashdata('error', true);
            $this->session->set_flashdata('msg', $this->upload->display_errors());
		}
		else
		{
			$data = $this->upload->data();
            $orig = $data['orig_name'];
            $file = $data['full_path'];
            $jobid = substr($data['file_path'], 0, strlen($data['file_path']) - 1 );
            $jobid = substr($jobid, strrpos($jobid, '/') + 1);

            $this->load->library('jobs');
            if($this->jobs->add_document($trans, $orig, $file)) {
                $this->session->set_flashdata('info', true);
                $this->session->set_flashdata('msg', 'File <strong>' . $data['client_name'] . "</strong> Successfully Uploaded for job <strong><a class='toggle-accordion' data-jobid='{$jobid}'>#{$jobid}</a></strong>.");
            }
            else {
                $this->session->set_flashdata('error', true);
                $this->session->set_flashdata('msg', 'File <strong>' . $data['client_name']."</strong> Error Adding Translation for job <strong><a class='toggle-accordion' data-jobid='{$jobid}'>#{$jobid}</a></strong>.");
            }

		}

        redirect('dashboard/jobs/accepted', 'refresh');
    }
}
