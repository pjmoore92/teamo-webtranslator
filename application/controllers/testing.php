<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Testing extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}


	public function getAllUsers(){
		$this->load->model('customer_model');
		$customers = $this->customer_model->getAllCustomers();
		if($customers == NULL)
			echo 'No customers registered';
		else{
			foreach($customers as $customer){
				echo $customer->title . ' ' . $customer->fullName . ', ' .
				$customer->email . ', ' . $customer->referenceStr . ', ' .
				$customer->active .'<br />';
			}
		}
	}

	function test(){

		 $this->load->view('testing/test');

		 $this->load->library('upload');

		 $config['upload_path']   = './testingupload'; //if the files does not exist it'll be created
		 $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|php|pdf';
		 $config['max_size']   = '4000'; //size in kilobytes
		 $config['encrypt_name']  = TRUE;

		 $this->upload->initialize($config);

		 $uploaded = $this->upload->up(TRUE); //Pass true if you want to create the index.php files
		 
		 var_dump($uploaded); //prints the result of the operation and analize the data
	}

	function uploadform(){
		$this->load->view('testing/upload_form', array('error' => ' ' ));
	}

	
	function do_upload2(){

		// $this->load->library('jobs');
		// $job_data = array(
		// 	'customerID' => "1",
		// 	'status' => 'QuoteReq',
		// 	'dateDue' => date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60)),
		// 	'toLanguage' => "French",
		// 	'fromLanguage' => "Italian"
		// );
		
		// $result = $this->jobs->add_job($job_data);
		// if( $result['error'] != "" ){
		// 	echo 'OHNOES';
		// 	print_r($result);
		// }
		// else{
		// 	$data = array('upload_data' => $this->upload->data());
		// 	$this->load->view('testing/upload_success', $data);
		// }


		$config['upload_path'] = './testingupload/';
		$config['allowed_types'] = 'pdf|docx|doc';
		
		$this->load->library('upload', $config);

		print_r ($this->upload->upload_files());

		// if ( ! $this->upload->do_upload("docs"))
		// {
		// 	$error = array('error' => $this->upload->display_errors());

		// 	$this->load->view('testing/upload_form', $error);
		// }
		// else
		// {
		// 	$data = array('upload_data' => $this->upload->data());

		// 	$this->load->view('testing/upload_success', $data);
		// }
	}

	public function index()
	{
		$this->load->view('testing/upload', array('error' => ''));
	}
public function do_upload()
	{
	
	$upload_path_url = base_url().'./testingupload/';
	
		$config['upload_path'] = './testingupload/';
		$config['allowed_types'] = 'jpg';
		$config['max_size'] = '30000';
		
	  	$this->load->library('upload', $config);

	  	if ( ! $this->upload->do_upload())
	  	{
	  		$error = array('error' => $this->upload->display_errors());
	  		$this->load->view('testing/upload', $error);
	  	}
	  	else
	  	{ 		
		   $data = $this->upload->data();
		/*	
                  // to re-size for thumbnail images un-comment and set path here and in json array	
		   $config = array(
			'source_image' => $data['full_path'],
			'new_image' => $this->$upload_path_url '/thumbs',
			'maintain_ration' => true,
			'width' => 80,
			'height' => 80
		  );
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		*/
	//set the data for the json array	
	$info->name = $data['file_name'];
        $info->size = $data['file_size'];
	$info->type = $data['file_type'];
        $info->url = $upload_path_url .$data['file_name'];
	$info->thumbnail_url = $upload_path_url .$data['file_name'];//I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
        $info->delete_url = base_url().'testing/deleteImage/'.$data['file_name'];
        $info->delete_type = 'DELETE';
          

	if (IS_AJAX) {   //this is why we put this in the constants to pass only json data
	           echo json_encode(array($info));
                    //this has to be the only the only data returned or you will get an error.
                    //if you don't give this a json array it will give you a Empty file upload result error
                    //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                      }
	else {   // so that this will still work if javascript is not enabled
		  	$file_data['upload_data'] = $this->upload->data();
		  	$this->load->view('testing/upload_success', $file_data);
		}
					
	 }

}
	

public function deleteImage($file)//gets the job done but you might want to add error checking and security
	{
		$success =unlink(FCPATH.'uploads/' .$file);
		//info to see if it is doing what it is supposed to	
		$info->sucess =$success;
		$info->path =base_url().'uploads/' .$file;
		$info->file =is_file(FCPATH.'uploads/' .$file);
	if (IS_AJAX) {//I don't think it matters if this is set but good for error checking in the console/firebug
	    echo json_encode(array($info));}
	else {     //here you will need to decide what you want to show for a successful delete
		  	$file_data['delete_data'] = $file;
		  	$this->load->view('testing/delete_success', $file_data); 
	       }
}

}