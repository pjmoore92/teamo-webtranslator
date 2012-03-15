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


    
    /**
     * Check date
     *
     * Check if the argument is a valid date (DD-MM-YYYY).
     *
     * @access public
     * @param string
     * @return bool
     */
    public function valid_date($str){
        if(strlen($str) == 10){
            $day = substr($str, 0, 2);
            $month = substr($str, 3, 2);
            $year = substr($str, 5, 4);

            if(
                ($year == FALSE || $year == '') &&
                ($month == FALSE || $month == '') &&
                ($day == FALSE || $day == '')
            ){
                
                $this->CI->form_validation->set_message('valid_date', 'Date not valid');
                return FALSE;
            }

            if(is_numeric($year) && is_numeric($month) && is_numeric($day))
                if(checkdate((int)$month, (int)$day, (int)$year))
                    return TRUE;
        }
        
        $this->CI->form_validation->set_message('valid_date', 'Date not valid');
        return FALSE;
    }
}
