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
                                                'rules' => 'required|xss_clean|callback_check_lang_from'
                                        ),

                                        array(
                                                'field' => 'lang_to',
                                                'label' => 'Translation language',
                                                'rules' => 'required|xss_clean|callback_check_lang_to'
                                        ),
                                        
                                        array(
                                                'field' => 'deadline',
                                                'label' => 'Deadline',
                                                'rules' => 'required|xss_clean|callback_check_deadline'
                                        ),
                                        
                                        array(
                                                'field' => 'currency',
                                                'label' => 'Currency',
                                                'rules' => 'required|xss_clean|callback_check_currency'
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
                                $job->customer_id = $this->_user_id;
                                $job->deadline = $this->form_validation->set_value('deadline');
                                $job->lang_to = $this->form_validation->set_value('lang_to');
                                $job->lang_from = $this->form_validation->set_value('lang_from');


                                $this->load->library('jobs');

                                $details = array(
                                        'customerID' => $job->customer_id,
                                        'status' => 'QuoteReq',
                                        'fromLanguage' => $job->lang_from,
                                        'toLanguage' => $job->lang_to,
                                        'deadline' => $job->deadline
                                );
                                
                                /* add the job to the DB */
                                $job->id = $this->jobs->add_job($details);

                                $this->output->set_output((json_encode($job)));
                        }
                }
        }

        public function jobs($statusType = "pending"){
                $this->load->model('job_model');
                $_dbType = "";
                $subtitle = "";
                switch ($statusType) {
                case "pending":
                        $_dbType = "QuoteReq";
                        $subtitle = "pending";
                        break;
                case "quotes":
                        $_dbType = "QuoteSent";
                        $subtitle = "quoted";
                        break;
                case "translations":
                        $_dbType = "Translated";
                        $subtitle = "translated";
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

                        $this->form_validation->set_rules('quote', 'Quote', 'required|trim|numeric');
                        $this->form_validation->set_rules('jobid', 'JobID', 'required|trim|numeric');

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

        public function stats(){

                if($this->_data['role'] != 'admin')
                        $this->index();

                $this->lang->load('common');
                $this->lang->load('home');

                $this->_data['type'] = 'stats';

                $this->template->set('title', $this->_data['role']. ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }


    /**
     * Check if 'From' language is allowed
    */
    public function check_lang_from($lang){
        $allowed = array('english', 'italian');
        
        if( !in_array($lang, $allowed)){
                $this->form_validation->set_message('check_lang_from', 'That language is not allowed');
                return FALSE;
        }
        else
                return TRUE;
    }
    
    /**
     * Check if 'From' language is allowed
    */
    public function check_lang_to($lang){
        $allowed = array('french');
        
        // if( !in_array($lang, $allowed)){
        if($lang != 'french'){
                $this->form_validation->set_message('check_lang_to', 'That language is not allowed');
                return FALSE;
        }
        else
                return TRUE;
    }

        /**
         * Check if date is valid (YYY-MM-DD)
         */
    public function check_deadline($date){
        if(strlen($date) == 10){
                $year = substr($date, 0, 4);
                $month = substr($date, 5, 2);
                $day = substr($date, 8, 2);

                if(
                        ($year == FALSE || $year == '') &&
                        ($month == FALSE || $month == '') &&
                        ($day == FALSE || $day == '')
                ){
                        
                        $this->form_validation->set_message('check_deadline', 'Date not valid');
                        return FALSE;
                }

                if(is_numeric($year) && is_numeric($month) && is_numeric($day))
                        if(checkdate((int)$month, (int)$day, (int)$year))
                                return TRUE;
        }
        
        $this->form_validation->set_message('check_deadline', 'Date not valid');
        return FALSE;
    }

    /**
     *
     */
    public function check_currency($curr){
        $allowed = array('gbp', 'eur');
        
        if( !in_array($curr, $allowed)){
                $this->form_validation->set_message('check_currency', 'That currency is not allowed');
                return FALSE;
        }
        else
                return TRUE;
    }
}
