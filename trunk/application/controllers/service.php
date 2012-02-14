<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('plupload');
    }
    function upload()
    {
        echo $this->plupload->process_upload($_REQUEST,$_FILES);
    }
}
