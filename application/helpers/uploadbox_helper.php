<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Generate upload box
 *
 * @access	public
 * @return  	string
 */
if ( ! function_exists('uploadbox'))
{
	function uploadbox($jobid, $transid)
	{
        $attributes = array('id' => $transid);
        $hidden = array('job' => $jobid, 'trans' => $transid);
        $ret = form_open_multipart('service/uploadtrans', $attributes, $hidden);
        $up = array('name' => 'upload');
        $ret .= form_upload($up);
        $js = '<script>$("input[name=upload]").change(function() { $(this).closest("form").submit(); });</script>';
        $ret .= form_close($js);
        return $ret;
	}
}
