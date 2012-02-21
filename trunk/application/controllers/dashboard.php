<?php if ( ! defined('BASEPATH')) exit('Access denied');

class Dashboard extends MY_Controller {

        public function index(){

                $this->_data['content'] = 'dashboard/main';

                $this->template->set('title', ucfirst($this->_data['role']).' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        public function submit(){

                $this->lang->load('common');
                $this->lang->load('home');

                $this->_data['content'] = 'dashboard/submit';

                $this->template->set('title', $this->_data['role']. ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        public function add_job(){

                if(!$this->input->is_ajax_request()){
                        return json_encode(array('error' => 'Somthin\' ain\' right :<'));
                }
                else{

                        $this->load->library('form_validation');

                        $this->form_validation->set_rules('toLanguage', 'To language', 'required');
                        $this->form_validation->set_rules('fromLanguage', 'From language', 'required');

                        if ($this->form_validation->run() == FALSE){
                                return json_encode(array('error' => 'Somthin\' ain\' right :<'));
                        }
                        else{

                                $dateDue = date('Y-m-d H:i:s', time() + (7 * 24 * 60 * 60));

                                $job_data = array(
                                        'customerID' => $this->_user_id,
                                        'status' => 'QuoteReq',
                                        'dateDue' => $dateDue,
                                        'toLanguage' => $this->form_validation->set_value('toLanguage'),
                                        'fromLanguage' => $this->form_validation->set_value('fromLanguage')
                                );

                                $this->load->model('job_model');
                                $this->job_model->add_job($job_data);

                                die(json_encode(array('response' => 'WOOHOO!')));
                        }
                }
        }

        public function jobs($statusType = "pending"){
                $this->load->model('job_model');
                $_dbType = "";
                switch ($statusType) {
                case "pending":
                        $_dbType = "QuoteReq";
                        break;
                case "quotes":
                        $_dbType = "QuoteSent";
                        break;
                case "translations":
                        $_dbType = "Translated";
                        break;
                default:
                        $_dbType = $statusType;
                        break;
                }

                if ($this->_data['role'] == "admin") {
                        $this->_data['jobs_list'] = $this->job_model->get_by_status($_dbType);
                }
                else {
                        $this->_data['jobs_list'] = $this->job_model->get_by_status($_dbType, $this->_user_id);
                }
                $this->_data['content'] = 'dashboard/'.$statusType;
                $this->template->set('title', ucfirst($this->_data['role']). ' Dashboard -');
                $this->template->load('template', $this->_view_template, $this->_data);
        }

        public function history(){
                //TODO fix historical translations
                $this->_retrieveData("translated");
        }


        public function send_quote(){
                if(!$this->input->is_ajax_request()){
                        die(json_encode(array('error' => 'Somthin\' ain\' right :<')));
                }
                else{

                        $this->load->library('form_validation');

                        $this->form_validation->set_rules('quote', 'Quote', 'required|numeric');
                        $this->form_validation->set_rules('jobid', 'JobID', 'required|numeric');

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
}
