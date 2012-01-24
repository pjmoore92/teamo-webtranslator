<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model{

    private $_table = 'job';
    
    public function __construct(){
        parent::__construct();
    }


    public function get_all_pending($customerID){
    	$this->db->where('status', 'QuoteReq');
    	$this->db->where('customerID', $customerID);
    	$query = $this->db->get($this->_table);
		
    	if($query->num_rows() > 0) return $query->result();
    	return NULL;
    }

}

/* End of file job_model.php */
/* Location: ./application/models/job_model.php */