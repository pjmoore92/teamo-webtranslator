<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?> Bethel Translations</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="<?php echo base_url('style/blockui.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('style/responsive.css'); ?>" rel="stylesheet">
	<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
    <link href='<?php echo base_url('style/jquery-ui/south-street/jquery-ui-1.8.17.custom.css'); ?>' rel='stylesheet' type='text/css'>

    <!-- Le fav and touch icons -->
<!--    <link rel="shortcut icon" href="/images/favicon.ico"> 
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png"> -->
   
    <script type="text/javascript" src="<?php echo base_url('/js/jquery/jquery-1.7.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-modal.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-dropdown.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-alert.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-collapse.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/jquery/jquery-ui-1.8.17.custom.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/script.js'); ?>"></script>
    <script type="text/javascript">jobID = -1; transID = -1;</script>


  </head>
    
  <body>

    <!-- BEGIN HEADER -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php echo anchor('welcome', lang('company.name'), 'class="brand"'); ?>
          <div class="nav-collapse">
            <ul class="nav">
              <li><?php echo anchor('welcome', lang('nav.home')); ?></li>
            <li><?php echo anchor('welcome/view/about', lang('nav.about')); ?></li>
            <li><?php echo anchor('welcome/view/testimonials', lang('nav.testimonials')); ?></li>
            <li><?php echo anchor('welcome/contact', lang('nav.contact')); ?></li>
	    <li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php echo lang('nav.serv') ?>
		<b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <?php echo anchor('welcome/view/document_translation', 'Document Translation'); ?>
                  <?php echo anchor('welcome/view/editing_and_proofreading', 'Editing and Proofreading'); ?>
                  <?php echo anchor('welcome/view/over_the_phone_interpreting', 'Over-the-phone Interpreting'); ?>
                  <?php echo anchor('welcome/view/video_remote_interpreting', 'Video Remote Interpreting'); ?>
                  
                </li>
              </ul>
            </li> 
	    </ul>
	     <ul class ="nav pull-right">
	    <li><a href="/en" class = "language-img"><img src="/images/uk.png" height ="20" width ="20"></a></li>
	    <li><a href="/fr" class = "language-img"><img src="/images/france.png" height ="20" width ="20"></a></li>
	    <li><a href="/it" class = "language-img"><img src="/images/Italy.png" height ="20" width ="20"></a></li>
	  </ul>
	  <!--<ul class = "nav pull-right">
	  	<li><?php echo anchor('','Select language: ');?> </li>
	  </ul>-->
	    <ul class="nav pull-right">
	    <?php if(!$this->tank_auth->is_logged_in()): ?>
		
	    <li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php echo lang('nav.login') ?>
		<b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                 <?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

$login_label = 'Email';

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<form action="http://alasdaircampbell.com/en/auth/login" method="post" accept-charset="utf-8"><table>
	<tbody><tr>
		<td><label for="login">Email</label></td>
		<td><input type="text" name="login" value="" id="login" maxlength="80" size="30"></td>
		<td style="color: red;"></td>
	</tr>
	<tr>
		<td><label for="password">Password</label></td>
		<td><input type="password" name="password" value="" id="password" size="30"></td>
		<td style="color: red;"></td>
	</tr>
	<tr>
					
		
	
	<tr>
		<td colspan=3>
			<label for="remember" style="float:left">Remember me </label>
			<input type="checkbox" name="remember" value="1" id="remember" style="float:right">
			<a href="http://alasdaircampbell.com/en//auth/forgot_password">Forgot password</a>
			<a href="http://alasdaircampbell.com/en//auth/register">Register</a>		</td>
	</tr>
</tbody></table>
<!--<input type="submit" name="submit" value="Let me in"></form>-->

<div class="pull-right">
<input type="submit" class="btn btn-success" name="submit" value="Let me in"></form>
</div>
<?php echo form_close(); ?>
              </ul>
            </li>
            
          <?php else: ?>
            
            <li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php //echo lang('nav.logout') ?>My Account
		<b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <?php echo anchor('auth/login', 'Dashboard'); ?>
                  <?php echo anchor('auth/logout', 'Logout'); ?>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
            </ul>
          </div>
        </div>
      </div>
    </div>


    

    <div id="modal-from-dom-clients" class="modal hide fade">
      <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3><?php echo lang('login.form') ?></h3>
      </div>
      <div class="modal-body">
        <p>
          <form>
              <label for="login-email"><?php echo lang('login.email') ?></label>
              <div class="input">
                <input class="xlarge span4" id="login-email" name="login" size="30" type="text" />
              </div>
              
              <label for="login-ref-code"><?php echo lang('login.ref') ?></label>
              <div class="input">
                <input class="xlarge span4" id="login-ref-code" name="password" size="30" type="password" />
              </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        <input type="checkbox" name="remember" value="1" id="remember" style="margin:0;padding:0">
        <label for="remember">Remember me</label>
        <?php echo anchor('#', 'Go!', array('id' => 'login-submit','class'=>'btn primary')); ?>
        <a href="#" class="btn secondary"><?php echo lang('login.reflost') ?></a>
      </div>
    </div>
    <p/>
    <!-- END OF HEADER -->

    <div class="container-fluid"> <!--FIXME is this needed? -->
      <?= $contents ?>
      <footer class="footer">
        <p class="pull-right">
	<br />
	<a href="http://www.linkedin.com"><img src="/images/linked.png" align="right"></a>
	<a href="http://www.facebook.com"><img src="/images/facebook.png" align="right"></a>
	<br />
	<br />
	<br />
	<a href="/welcome/view/privacy_policy">Privacy Policy</a>
	&copy; <?php 
        $copyYear = 2011; 
        $curYear = date('Y'); 
        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '') .' '.lang('company.name') ?>
	
        </p>
        
      </footer>
    </div>

    <!-- END OF VIEW -->

  </body>
</html>

