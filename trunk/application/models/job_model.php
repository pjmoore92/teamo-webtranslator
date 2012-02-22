<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model{

    private $_table = 'job';
    private $_cust_table = 'customer';

    public function __construct(){
        parent::__construct();
    }

    public function get_by_status($status, $customerID =  NULL) {
        $ci =& get_instance();
        $ci->load->model('translation');

        $this->db->where('status', $status);
        if ($customerID != NULL) $this->db->where("{$this->_table}.customerID", $customerID);
        
        //JOIN with user_profiles table to get the user specific data
        $this->db->join($this->_cust_table, "{$this->_cust_table}.customerID = {$this->_table}.customerID");
        $this->db->join('users', "users.id = {$this->_table}.customerID");

        $this->db->select('jobID, status, dateRequested, dateDue, fromLanguage, toLanguage, currency, quote, fullName, email');
        $query = $this->db->get($this->_table);
        if($query->num_rows() > 0) {
            $jobs = array();
            foreach ($query->result() as $job) {
                $translations = $ci->translation->get($job->jobID);
                $jobs[] = array($job, $translations);
            }
            return $jobs;
        }
        else
            return NULL;
    }

    /*
      needs to check the date
     */
    public function get_all_history($customerID = NULL){
        // $cur_date = getdate();
        // $due_date = $this->db->get('dateDue');
        // $interval = $cur_date->diff($due_date);

        $this->db->where('status', 'Translated');        
        if ($customerID != 0)
            $this->db->where('customerID', $customerID);
        $query = $this->db->get($this->_table);
        /* Assumes completed jobs are held in translations for 90 days, then moved to history after that period.*/
        if($query->num_rows() > 0 /*&& $interval->d >90*/ ) return $query->result();
        return NULL;
    }

    public function add_job($job_data){

        //Start transaction, lol
        $this->db->trans_start();
        
        //add the new job to the table
        $this->db->insert($this->_table, $job_data);
        
        //query for the ID of the last job added
        $this->db->select("jobID");
        $this->db->order_by("jobID", "desc");
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        
        if($query->num_rows() == 1)
            $jobID = $query->result();

        //complete transaction
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE){
            // generate an error... or use the log_message() function to log your error
        }
        
        return $jobID;
    }

    public function update_job($job_data){

        $this->db->where('jobID', $job_data['jobID']);
        array_shift($job_data); // shift the first element of the array (jobID) off the array
        $this->db->update($this->_table, $job_data);
    }

    public function update_job_dates($job_id, $job_dates){

        $this->db->where('jobID', $job_id);
        $this->db->update($this->_table, $job_dates, FALSE);
    }

    public function get_job_by_id($job_id, $customer_id = NULL){
        
        $this->db->where('jobID', $job_id);
        $this->db->where('status', 'QuoteSent');
        if($customer_id != NULL) $this->db->where('customerID', $customer_id);

        $query = $this->db->get($this->_table);
        if($query->num_rows() == 1) return $query->row();
        return NULL;
    }

    public function set_job_status($job_id, $status){
        $this->db->where('jobID', $job_id);
        $this->db->update($this->_table, array('status'=> $status));
    }
}

/* End of file job_model.php */
/* Location: ./application/models/job_model.php */
