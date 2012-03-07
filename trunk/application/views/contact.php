<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>
<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Contact</small></h1>    
<div class="row">
  <div id="contact_form">
        <hr>
        <div class="span4 offset2">
        <?php echo form_open('welcome/contact'); ?>
        
        <?php
        
        $name_data = array(
                'name' => 'name',
                'id' => 'name',
                'value' => set_value('name')            
        );

        $email_data = array(
                'name' => 'email',
                'id' => 'email',
                'value' => set_value('email')
        );
        
        $message_data = array(
                'name' => 'message',
                'id' => 'message',
                'value' => set_value('message')
        );
        
        $error = array(
                'style' => 'colour:red',
        );

        $nval ="";
        $eval ="";
        ?>
        
        <?php
             if($this->tank_auth->is_logged_in()){
             //Autopopulates name field
             $query = $this->db->get('customer');
             foreach ($query->result() as $row)
             {
                 $this->session->userdata('user_id');
                 if($this->session->userdata('user_id') == $row->customerID){
                 	$nval = $row->fullName;
                 } 
             }
             //Autopopulates email field
             $query = $this->db->get('users');
             foreach ($query->result() as $row)
             {
                 $this->session->userdata('user_id');
                 if($this->session->userdata('user_id') == $row->id){
                                 $eval = $row->email;
                 }
             }
             }          
        ?> 
             
        <br>
        <p><label for="name">Your Full Name </label></p>

        <!-- <p><?php echo form_input($name_data); ?>  </p> -->
        <p>
                <div class="input">        
                        <input type="text" name="name" value = "<?php echo($nval) ?>" value id="name">    
                </div>             
        </p>

        <p><label for="email">Your Email Address  </label></p>

        <!-- <p><?php echo form_input($email_data); ?> </p> -->
        

        <p>
                <div class="input">
                        <input type="email" name="email" value = "<?php echo($eval)?>" value id="email" >
                        <?php echo form_error('email', '<div class="alert-error">', '</div>'); ?>
                </div>    
        </p>

        <p>
                <div class="input">
                        <label for="selet01">Your Subject </label>      
                        <?php                           
                                $selected = (( isset($selected) ) ? $selected : '');
                                echo form_dropdown('select01', $dropdown_opts, $selected, array('id' => 'select01'));
                        ?>
                </div>
              
        <p>
                <label for="message">Your Message </label>
                <div class="input">
                        <textarea class="xxlarge" id="message" name="message" rows="10" value=""></textarea>
                        <?php echo form_error('message', '<div class="alert-error">', '</div>'); ?>
                </div>
                
        </p>
        
        <p>
                <div class="input">
                <!-- <input type="submit" class="btn btn-success btn-large" value="Send e-mail" action= -->
                <?php echo form_submit(array('name' => 'submit', 'value' => 'Send e-mail', 'class' => 'btn btn-success btn-large')); ?>
                </div>
        </p>
        </div>
        
        <?php echo form_close(); ?>
        
        <!--<?php echo validation_errors('<p class="error" style="color:red">'); ?>-->
        
</div><!--end contact-form-->
        
</div>
</div>
