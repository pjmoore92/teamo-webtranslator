<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Dashboard extends MY_Controller {

        public function index(){

                $this->_data['type'] = 'main';
                $this->_data['subtitle'] = 'overview of ';

                $this->template->set('title', ucfirst($this->_data['role']).' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        //FIXME REMOVE THIS BEFORE GOING LIVE!!!
        public function switchrole(){
            $newrole = $this->_data['role'] == 'admin' ? 'client' :'admin';
            $this->session->set_userdata('role', $newrole);
            $this->_data['role'] = $newrole;
            $this->jobs();
        }

        public function submit(){

                $this->lang->load('common');
                $this->lang->load('home');

                $this->_data['type'] = 'submit';
                $this->_data['subtitle'] = 'Add new';

                $this->template->set('title', $this->_data['role']. ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        public function add_job(){

                if(!$this->input->is_ajax_request()){
                        redirect('');
                }
                else{

                        $this->output->set_content_type('application/json');


                        $config = array(
                                'new_job' => array(
                                        array(
                                                'field' => 'lang_from',
                                                'label' => 'Source language',
                                                'rules' => 'required|xss_clean|from_lang'
                                        ),

                                        array(
                                                'field' => 'lang_to',
                                                'label' => 'Translation language',
                                                'rules' => 'required|xss_clean|to_lang'
                                        ),
                                        
                                        array(
                                                'field' => 'deadline',
                                                'label' => 'Deadline',
                                                'rules' => 'required|xss_clean|valid_date'
                                        ),
                                        
                                        array(
                                                'field' => 'currency',
                                                'label' => 'Currency',
                                                'rules' => 'required|xss_clean|check_currency'
                                        )
                                )
                        );
                        
                        $this->load->library('form_validation');

                        /* run validation for the registration form */
                        $this->form_validation->set_rules($config['new_job']);

                        /* Form validation error messages */
                        $this->form_validation->set_message('required', 'Field <strong>%s</strong> is required');
                        $this->form_validation->set_message('valid_email', '<strong>%s</strong> is not a valid e-mail');

                        if ($this->form_validation->run() == FALSE){
                                $this->output->set_output(
                                        json_encode(array('error'=> sprintf("%s", validation_errors())))
                                );
                        }
                        else{

                                $job = new stdClass;
                                $job->customerID = $this->_user_id;
                                $job->dateDue = $this->form_validation->set_value('deadline');
                                $job->fromLanguage = $this->form_validation->set_value('lang_to');
                                $job->toLanguage = $this->form_validation->set_value('lang_from');
                                $job->currency = $this->form_validation->set_value('currency');


                                $this->load->library('jobs');

                                /* add the job to the DB */
                                $job->id = $this->jobs->add_job($job);

                                $this->output->set_output((json_encode($job)));
                        }
                }
        }

        public function jobs($statusType = "pending"){
                $this->load->library('paypal2');
                $this->load->model('job_model');
                $_dbType = "";
                $subtitle = "";
                switch ($statusType) {
                case "pending":
                        $_dbType = "QuoteReq";
                        $subtitle = "pending";
                        break;
                case "quoted":
                        $_dbType = "QuoteSent";
                        $subtitle = "quoted";
                        break;
                case "translations":
                        $_dbType = "Translated";
                        $subtitle = "translated";
                        break;
                case "accepted":
                        $_dbType = "Paid";
                        $subtitle = "accepted";
                        break;
                case "declined":
                        $_dbType = "QuoteDeclined";
                        $subtitle = "declined";
                        break;
                default:
                        $_dbType = $statusType;
                        break;
                }

                $this->load->library('jobs');
                if ($this->_data['role'] == "admin") {
                        $this->_data['jobs_list'] = $this->jobs->get_jobs($_dbType);
                }
                else {
                        $this->_data['jobs_list'] = $this->jobs->get_jobs($_dbType, $this->_user_id);
                        if($this->_data['jobs_list'] != NULL)
                                foreach($this->_data['jobs_list'] as $job){
                                        $job->button = $this->paypal2->get_button($job);
                                }
                }
                $this->_data['type'] = $statusType;
                $this->_data['subtitle'] = $subtitle;
                $this->template->set('title', ucfirst($this->_data['role']). ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        public function history(){
                //TODO fix historical translations
                $this->_data['type'] = "history";
                $this->_retrieveData("translated");
        }


        public function send_quote(){
                if(!$this->input->is_ajax_request()){
                        die(json_encode(array('error' => 'Somthin\' ain\' right :<')));
                }
                else{

                        $this->load->library('form_validation');

                        $this->form_validation->set_rules('quote', 'Quote', 'required|trim|is_natural');
                        $this->form_validation->set_rules('jobid', 'JobID', 'required|trim|is_natural');

                        if ($this->form_validation->run() == FALSE){
                                die (json_encode(array('error' => 'The form values are not valid! :<')));
                        }
                        else{

                                $job_data = array(
                                        'jobID' => $this->form_validation->set_value('jobid'),
                                        'quote' => $this->form_validation->set_value('quote'),
                                        'status' => 'QuoteSent'
                                );

                                $this->load->model('job_model');
                                $this->job_model->update_job($job_data);

                                die(json_encode(array('response' => 'WOOHOO!')));
                        }
                }
        }

        public function decline_quote(){
                if(!$this->input->is_ajax_request()){
                        die(json_encode(array('error' => 'Somthin\' ain\' right :<')));
                }
                else{

                        $this->load->library('form_validation');
                        $this->form_validation->set_rules('jobid', 'JobID', 'required|trim|numeric');

                        if ($this->form_validation->run() == FALSE){
                                die (json_encode(array('error' => 'The form values are not valid! :<')));
                        }
                        else{

                                $job_data = array(
                                        'jobID' => $this->form_validation->set_value('jobid'),
                                        'status' => 'QuoteDeclined'
                                );

                                $this->load->model('job_model');
                                $this->job_model->update_job($job_data);

                                die(json_encode(array('response' => 'WOOHOO!')));
                        }
                }
        }

        public function stats(){

                if($this->_data['role'] != 'admin')
                        $this->index();

                $this->lang->load('common');
                $this->lang->load('home');

                $this->_data['type'] = 'stats';

                $this->template->set('title', $this->_data['role']. ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

}
