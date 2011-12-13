<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

    private $table = 'customer';
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function registerCustomer($input){
        $data = array(
            'fullName' => $input['name'],
            'email' => $input['email'],
            'referenceStr' => $input['refcode'],
            'title' => 'Mr',
            'active' => 0
        );

        if($this->db->insert($this->table, $data))
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
