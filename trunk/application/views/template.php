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
    <link href="<?php echo base_url('style/bootstrap.css'); ?>" rel="stylesheet">
    <!--<link href="<?php echo base_url('style/bootstrap-responsive.css'); ?>" rel="stylesheet">-->
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <style type="text/css">
      body {
        padding-top: 40px;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png">
   
    <script type="text/javascript" src="<?php echo base_url('/js/jquery/jquery-1.7.1.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/jquery/jquery.form.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-modal.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-dropdown.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-alert.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-collapse.js'); ?>"></script>


  </head>
    
  <body>

    <!-- BEGIN HEADER -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <?php echo anchor('welcome', lang('company.name'), 'class="brand"'); ?>
          <div class="nav-collapse">
            <ul class="nav">
              <li><?php echo anchor('welcome', lang('nav.home')); ?></li>
            <li><?php echo anchor('welcome/about', lang('nav.about')); ?></li>
            <li><?php echo anchor('welcome/testimonials', lang('nav.testimonials')); ?></li>
            <li><?php echo anchor('welcome/contact', lang('nav.contact')); ?></li>
<li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php echo lang('nav.serv') ?>
		<b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <?php echo anchor('/en', 'Document Translation'); ?>
                  <?php echo anchor('/en', 'Editing and Proofreading'); ?>
                  <?php echo anchor('/en', 'Over-the-phone Interpreting'); ?>
                  <?php echo anchor('/en', 'Video Remote Interpreting'); ?>
                  
                </li>
              </ul>
            </li> 
	    </ul>
	    <ul class="nav pull-right">
	<li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php echo lang('nav.lang') ?>
		<b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li>
                  
                  <?php echo anchor('/en', 'English'); ?>
                  <?php echo anchor('/fr', 'French'); ?>
                  <?php echo anchor('/it', 'Italian'); ?>
                </li>
              </ul>
            </li> 
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

    <script type="text/javascript">
      $(document).ready(function(){

        $('#login-submit').click(function(){
          var email = $("#login-email").val();
          var pass = $('#login-ref-code').val();
          
          $.post(
          '<?php echo base_url("/en/auth/login"); ?>',/*FIXME*/
          {'login' : email, 'password' : pass, 'remember' : 0 }
        );
        })
      });
    </script>
    <!-- END OF HEADER -->

    <div class="container-fluid"> <!--FIXME is this needed? -->
      <?= $contents ?>
      <footer class="footer">
        <p class="pull-right">
	<br />
	<a href="/welcome/privacy">Privacy Policy</a>
	&copy; <?php 
        $copyYear = 2011; 
        $curYear = date('Y'); 
        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '') .' '.lang('company.name') ?>
	<br />
	<a href="http://www.linkedin.com"><img src="/images/linked.png" align="right"></a>
	<a href="http://www.facebook.com"><img src="/images/facebook.png" align="right"></a>
        </p>
        
      </footer>
    </div>

    <!-- END OF VIEW -->

  </body>
</html>

