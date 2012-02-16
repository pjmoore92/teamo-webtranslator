<?php if ( ! defined('BASEPATH')) exit('Access denied');

class SetupDB extends CI_Controller {

	public function index()
	{
                $this->load->helper('file');
                $this->load->database();
                $query = file_get_contents('/home/claddach/public_html/alasdaircampbell.com/bethel-db-setup.sql');
                if ($this->db->query($query) == null)
                       echo 'IT didnt work';
                else
                       echo 'It worked';
	}

}

