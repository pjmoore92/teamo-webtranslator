<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1>Bethel Translations <small>Contact page</small></h1>
</div>
<div class="row">
<br />
<br />
<br />
  <div id="contact_form">
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
	
	<p><label for="name">Your Full Name: </label><?php echo form_input($name_data); ?></p>

	<p><label for="email">Your Email Address: </label><?php echo form_input($email_data); ?></p>	
	
	<p><label for="message">Your Message: </label><?php echo form_input($message_data); ?></p>


	<p><input type="submit" class="btn primary" value="Send e-mail" action=<?php echo form_submit('submit', 'Submit'); ?></p>
	
	<?php echo form_close(); ?>
	
	<?php echo validation_errors('<p class="error">'); ?>
	
</div><!--end contact-form-->
	
</div>
</div>

