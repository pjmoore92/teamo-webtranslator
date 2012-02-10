<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Contact</small></h1>
</div
<div class="row">
  <div id="contact_form">
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

	
	?>
	
	<?php if($this->tank_auth->is_logged_in()): ?>
	<?php endif; ?>
	<p><label for="name">Your Full Name </label></p>

	<!-- <p><?php echo form_input($name_data); ?>  </p> -->
	<p>
		<div class="input">	
			<input type="text" name="name" value id="name">
			<?php echo form_error('name', '<div class="alert-error">', '</div>'); ?>
		</div>
			
	</p>

	<p><label for="email">Your Email Address  </label></p>

	<!-- <p><?php echo form_input($email_data); ?> </p> -->
	

	<p>
  		<div class="input">	
			<input type="email" name="email" value id="email" autocomplete="on">
			<?php echo form_error('email', '<div class="alert-error">', '</div>'); ?>
		</div>
		
	</p>

	<p>
		<div class="input">
			<label for="selet01">Your Subject </label>	
			<select name="select01" id="select01">
				<option value="General Enquiry">General Enquiry</option>
				<option value="Quote">Quote</option>
				<option value="Video Translation">Video Translation</option>
				<option value="Interpretation">Interpretation</option>
				<option value="Other">Other</option>
			</select>
		</div>
              
	<p>
		<label for="message">Your Message </label>
  		<div class="input">
			<textarea class="xxlarge" id="message" name="message" rows="10" value="">
			</textarea>
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

