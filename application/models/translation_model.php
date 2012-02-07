<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Translation_Model extends CI_Model{

    private $_table = 'translation';
    private $_doc_table = 'document';

    public function __construct(){
        parent::__construct();
    }

    public function add_orig($jobid, $filename){

        // check jobid is valid
        $this->db->where("jobID", $jobid);
        $query = $this->db->get($this->_table);
        if ($query->num_rows() > 0) {	
	   log_message('error', 'jobID is fine');

            $this->db->trans_start();

            //add file to document table
            $this->db->insert($this->_doc_table, $filename);

            //query for the ID of the last job added
            $this->db->select("documentID");
            $this->db->order_by("documentID", "desc");
            $this->db->limit(1);
            $query = $this->db->get($this->_doc_table);
            
            if($query->num_rows() == 1)
                $docid = $query->result();

            // now update job record
            $this->db->where('jobID', jobid);
            $record = array(
                'jobID' => $jobid,
                'origDoc' => $docid,
            );
            $this->db->insert($this->_table, $record);

            //complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                // generate an error... or use the log_message() function to log your error
            }
        }
        else log_message('error', 'jobid '.$jobid.' did not match a record');
    }
}

