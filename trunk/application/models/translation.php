<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Translation extends CI_Model{

    private $_table = 'translation';
    private $_doc_table = 'document';

    public function __construct(){
        parent::__construct();
    }

    public function get($job) {
        if ($job) {
            $this->db->select('name,origDoc,translatedDoc');
            $this->db->where('jobID',$job);
            $query = $this->db->get($this->_table);
            if ($query->num_rows() > 0) {
                $translations = array();
                foreach ($query->result() as $trans) {
                    $docname = $trans->name;

                    $this->db->start_cache();
                    $this->db->select('filePath');
                    $this->db->stop_cache();

                    $this->db->where('documentID', $trans->origDoc);
                    $origFile = $this->db->get('document')->row();

                    $this->db->where('documentID', $trans->translatedDoc);
                    $transFile = $this->db->get('document')->row();

                    $translations[] = array($docname, $origFile, $transFile);
                    $this->db->flush_cache();
                }
                return $translations;
            }
        }
        return NULL;
    }

    public function add_orig($jobid, $docname, $filename){

        // check jobid is valid
        $this->db->where("jobID", $jobid);
        $query = $this->db->get("job");
        if ($query->num_rows() > 0) {	

            $this->db->trans_start();

            //FIXME 
            //truncate filename from /home/claddach/public_html/alasdaircampbell.com/*
            $filename = substr($filename, 48);

            //add file to document table
            $record = array(
                'filePath' => $filename);
            $this->db->insert($this->_doc_table, $record);

            //query for the ID of the last document added
            $this->db->select("documentID");
            $this->db->order_by("documentID", "desc");
            $this->db->limit(1);
            $query = $this->db->get($this->_doc_table);

            if($query->num_rows() != 1)
            {
                //log db error
            }

            $row = $query->row();
            $docid = $row->documentID;

            // now insert new translation job record
            $record = array(
                'jobID' => $jobid,
                'name' => $docname,
                'origDoc' => $docid
            );
            $this->db->insert($this->_table, $record);

            //complete transaction
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE){
                log_message('error', 'transaction failed in translation::add_orig');
                return false;
            }
            return true;
        }
        else {
            log_message('error', 'jobid '.$jobid.' did not match a record');
            return false;
        }
    }

    public function get_translations($jobID){
        
        $this->db->where("{$this->_table}.jobID", $jobID);
        $this->db->get($this->_table);
        
        echo this->db->last_query();
        
    }
}

