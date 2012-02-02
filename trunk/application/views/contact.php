<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h2>Bethel Translations <small>Contact page</small></h2>
</div>
<div class="row">
<br />
  <div id="contact_form">
	<div class="span4 offset4">
	<h2>Contact Us</h2>
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

	
	?>
	
	<p><label for="name">Your Full Name </label></p>

	<!-- <p><?php echo form_input($name_data); ?>  </p> -->
	<p>
  		<div class="input">	
                <input type="text" name="name" value id="name">
		</div>
		
	</p>

	<p><label for="email">Your Email Address  </label></p>

	<!-- <p><?php echo form_input($email_data); ?> </p> -->
	

	<p>
  		<div class="input">	
                <input type="email" name="email" value id="email" autocomplete="on">
		</div>
		
	</p>
	
              
	<p>
		<label for="message">Your Message </label>
  		<div class="input">	
                <textarea class="xxlarge" id="message" name="message" rows="10" value="<input type="text" name="message" value="" id="message"  /></textarea>
		</div>
		
	</p>
	
	<p>
		<div class="input">
		<input type="submit" class="btn btn-success btn-large" value="Send e-mail" action=<?php echo form_submit('submit', 'Submit'); ?>
		</div>
	</p>
	</div>
	
	<?php echo form_close(); ?>
	
	<?php echo validation_errors('<p class="error">'); ?>
	
</div><!--end contact-form-->
	
</div>
</div>

