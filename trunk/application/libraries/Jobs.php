<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Jobs{
	
	public function __construct(){
		
		$this->ci =& get_instance();

	}


	public function add_job($args){
		
		$job_data = array(
			'customerID' => $args['customerID'],
			'status' => 'QuoteReq',
			// 'dateDue' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)),
			'dateDue' => $args['deadline'],
			'toLanguage' => $args['toLanguage'],
			'fromLanguage' => $args['fromLanguage']
		);

		$this->ci->load->model('job_model');
		$jobID = $this->ci->job_model->add_job($job_data);

		//upload files;
		// $this->ci->load->library('upload');
		// $response = $this->ci->upload->upload_files();
		return $jobID[0]->jobID;
	}

	private function _upload_files(){

		if(count($_FILES["docs"]) == 0)
			return FALSE;

		$config['upload_path'] = './testingupload/';
		$config['allowed_types'] = 'pdf|docx|doc';

		$this->ci->load->library('upload', $config);

		foreach ($_FILES["docs"]["error"] as $key => $error) {


			if ( ! $this->ci->upload->do_upload("docs") ){
				$data['error'] = array('error' => $this->ci->upload->display_errors());
				// $this->load->view('testing/upload_form', $error);

			}
			else{
				$data = array('upload_data' => $this->ci->upload->data());
				// $this->load->view('testing/upload_success', $data);
			}

			//  sample code from php.com
			// if ($error == UPLOAD_ERR_OK) {
			// 	$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
			// 	$name = $_FILES["pictures"]["name"][$key];
			// 	move_uploaded_file($tmp_name, "data/$name");
			// }
		}

		return $data;
	}

}

/* End of file Jobs.php */