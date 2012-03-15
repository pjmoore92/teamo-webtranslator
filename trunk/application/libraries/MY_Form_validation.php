<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    protected $CI;

    
    function __construct(){
        parent::__construct();

        $this->CI =& get_instance();
    }

    
    /**
     * Check currency
     * 
     * Checks if the supplied currency is accepted.
     * 
     * @access 	public
     * @param 	string
     * @return 	bool
     */
    public function check_currency($str){

        // load the 'business' config file
        $this->CI->load->config('business');

        // load the accepted currencies array
    	$allowed = $this->CI->config->item('currencies');
    	
    	if( !in_array($str, $allowed)){
           //FIXME move this in the language file
    		$this->CI->form_validation->set_message('check_currency', 'That currency is not allowed');
    		return FALSE;
    	}
    	else
    		return TRUE;
    }
}
