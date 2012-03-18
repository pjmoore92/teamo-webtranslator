<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email';
}
?>

<?php if( $message != NULL ): ?>
	<?php
		$message->type = ($message->type != NULL) ? 'alert-'.$message->type : '';
	?>
    <div class="alert <?php echo $message->type; ?>">
    	<a class="close" data-dismiss="alert">×</a>
    	<?php echo $message->text; ?>
    </div>
<?php endif; ?>

Enter the e-mail address that you've registered with, so we can reset your password.<br />

<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login); ?></td>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('reset', 'Get a new password'); ?>
<?php echo form_close(); ?>