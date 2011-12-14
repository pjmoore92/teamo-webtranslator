<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model{

    private $table = 'customer';
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function registerCustomer($data, $activated = TRUE){
        $data['title'] = 'Mr';
        $data['active'] = $activated ? 1 : 0;

        if($this->db->insert($this->table, $data)){
            $user_id = $this->db->insert_id();
            return array('user_id' => $user_id);
        }
        else
            return FALSE;
    }

    public function getAllCustomers(){
        $query = $this->db->query("SELECT * FROM `{$this->table}`");
        
        if ($query->num_rows() > 0) return $query->result();
        return NULL;
    }

    public function is_email_available($email){
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(email)=', strtolower($email));
        // $this->db->or_where('LOWER(new_email)=', strtolower($email));

        $query = $this->db->get($this->table);
        return $query->num_rows() == 0;
    }

    public function activateCustomer($user_id, $activation_key, $activate_by_email){
        $this->db->select('1', FALSE);
        $this->db->where('customerID', $user_id);
        if ($activate_by_email) {
            $this->db->where('new_email_key', $activation_key);
        } else {
            $this->db->where('new_password_key', $activation_key);
        }
        $this->db->where('active', 0);
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() == 1) {

            $this->db->set('active', 1);
            $this->db->set('new_email_key', NULL);
            $this->db->where('customerID', $user_id);
            $this->db->update($this->table);

            return TRUE;
        }
        return FALSE;
    }

    public function get_user_by_email($email){
        $this->db->where('LOWER(email)=', strtolower($email));

        $query = $this->db->get($this->table);
        if ($query->num_rows() == 1) return $query->row();
        return NULL;
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */
