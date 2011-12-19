<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

    private $_table = 'customer';
    
    public function __construct(){
        parent::__construct();
    }

    public function add_customer($data){
        if($this->db->insert($this->_table, $data))
            return TRUE;
        else
            return FALSE;
    }

    public function getAllCustomers(){
        $query = $this->db->query("SELECT * FROM `{$this->table}`");
        
        if ($query->num_rows() > 0) return $query->result();
        return NULL;
    }

}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */
