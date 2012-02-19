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

    public function get_customer_name($id){
        $this->db->where('customerID', $id);
        $query = $this->db->get($this->_table);

        if($query->num_rows() == 1) return $query->row();
        return NULL;
    }

    public function getAllCustomers(){
        $query = $this->db->query("SELECT * FROM `{$this->_table}`");
        
        if ($query->num_rows() > 0) return $query->result();
        return NULL;
    }
	
	public function countActiveCustomers(){
		$query = $this->db->query("SELECT COUNT(activated) FROM `{$this->_table}` WHERE activated = '1'");
		
		return $query->result();
	}

}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */
