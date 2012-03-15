<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends Form_validation {

    
    /**
     * Check currency
     * @access 	public
     * @param 	string
     * @return 	bool
     */
    public function check_currency($str){
    	$this->CI->load('business');

    	$allowed = $this->CI->config->item('currencies');
    	
    	if( !in_array($str, $allowed)){
    		$this->CI->form_validation->set_message('check_currency', 'That currency is not allowed');
    		return FALSE;
    	}
    	else
    		return TRUE;
    }
}
