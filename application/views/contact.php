<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h2>Bethel Translations <small>Contact page</small></h2>
</div>
<div class="row">
  <div id="contact_form">
	<div class="span4 offset2">
	<?php echo form_open('email/send'); ?>
	
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

	
	?>
	
	<p><label for="name">Your Full Name </label></p>

	<!-- <p><?php echo form_input($name_data); ?>  </p> -->
	<p>
  		<div class="input">	
                <input type="text" name="name" value id="name"><?php echo form_error('name', '<div class="alert-error">', '</div>'); ?>
		</div>
		
	</p>

	<p><label for="email">Your Email Address  </label></p>

	<!-- <p><?php echo form_input($email_data); ?> </p> -->
	

	<p>
  		<div class="input">	
                <input type="email" name="email" value id="email" autocomplete="on"><?php echo form_error('email', '<div class="alert-error">', '</div>'); ?>
		</div>
		
	</p>

	<p>
		<div class="input">
		<label for="selet01">Your Subject </label>	
		<select id="select01">
                	<option>General Enquiry</option>
	                <option>Quote</option>
        	        <option>Video Translation</option>
                	<option>Interpretation</option>
	                <option>Other</option>
                </select>
		</div>
              
	<p>
		<label for="message">Your Message </label>
  		<div class="input">	
                <textarea class="xxlarge" id="message" name="message" rows="10" value="<input type="text" name="message" value="" id="message"  /></textarea><?php echo form_error('message', '<div class="alert-error">', '</div>'); ?>
		</div>
		
	</p>
	
	<p>
		<div class="input">
		<input type="submit" class="btn btn-success btn-large" value="Send e-mail" action=<?php echo form_submit('submit', 'Submit'); ?>
		</div>
	</p>
	</div>
	
	<?php echo form_close(); ?>
	
	<!--<?php echo validation_errors('<p class="error" style="color:red">'); ?>-->
	
</div><!--end contact-form-->
	
</div>
</div>

