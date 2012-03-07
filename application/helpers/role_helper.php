<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Is Admin Check
 *
 * Quickly determine if user is admin
 *
 * @access	public
 * @return  boolean	
 */
if ( ! function_exists('admin'))
{
	function admin()
	{
        $CI =& get_instance();
        return ($CI->session->userdata('role') == 'admin');
	}
}
