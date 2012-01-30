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
    
    public function get_all_quoted($customerID){
      $this->db->where('status', 'QuoteSent');        
      $this->db->where('customerID', $customerID);
      $query = $this->db->get($this->_table);
		
    	if($query->num_rows() > 0) return $query->result();
    	return NULL;
    }
    
    public function get_all_paid($customerID){
      $this->db->where('status', 'Paid');        
      $this->db->where('customerID', $customerID);
      $query = $this->db->get($this->_table);
		
    	if($query->num_rows() > 0) return $query->result();
    	return NULL;
    }
     
    public function get_all_translated($customerID){
      $this->db->where('status', 'Translated');        
      $this->db->where('customerID', $customerID);
      $query = $this->db->get($this->_table);
		
    	if($query->num_rows() > 0) return $query->result();
    	return NULL;
    }     
    
    /*
      needs to check the date
    */
    public function get_all_history($customerID){
      // $cur_date = getdate();
      // $due_date = $this->db->get('dateDue');
      // $interval = $cur_date->diff($due_date);
      
      $this->db->where('status', 'Translated');        
      $this->db->where('customerID', $customerID);
      $query = $this->db->get($this->_table);
      /* Assumes completed jobs are held in translations for 90 days, then moved to history after that period.*/
    	if($query->num_rows() > 0 /*&& $interval->d >90*/ ) return $query->result();
    	return NULL;
    }

    public function add_job($job_data){
      
      $this->db->insert($this->_table, $job_data);

    }

    public function update_job_dates($job_id, $job_dates){
      
      $this->db->where('jobID', $job_id);
      $this->db->update($this->_table, $job_dates, FALSE);
    }
}

/* End of file job_model.php */
/* Location: ./application/models/job_model.php */