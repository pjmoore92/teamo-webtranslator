<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Information regarding your translation job</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Your job (#<?php echo $job->jobID; ?>) has been updated!</h2>
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('auth/login'); ?>" style="color: #3366cc;">Login</a></b> to see the changes.</big>
<br />
<br />
Link doesn't work? Copy the following link to your browser address bar:<br />
<nobr><a href="<?php echo site_url('auth/login/'); ?>" style="color: #3366cc;"><?php echo site_url('auth/login/'); ?></a></nobr>


<br />
<br />
Thank you!
</td>
</tr>
</table>
</div>
</body>
</html>