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
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-modal.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/js/bootstrap-dropdown.js'); ?>"></script>
  </head>

  <body>

    <!-- BEGIN HEADER -->
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <?php echo anchor('welcome', lang('company.name'), 'class="brand"'); ?>
          <ul class="nav">
            <li class="active"><?php echo anchor('welcome', lang('nav.home')); ?></li>
            <li><?php echo anchor('welcome/about', lang('nav.about')); ?></li>
            <li><?php echo anchor('welcome/testimonials', lang('nav.testimonials')); ?></li>
            <li><?php echo anchor('welcome/contact', lang('nav.contact')); ?></li>
          </ul>
          <ul class="secondary-nav">

          <?php if(!$this->tank_auth->is_logged_in()): ?>

            <li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php echo lang('nav.login') ?>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#" data-controls-modal="modal-from-dom-clients" 
              data-backdrop="true" data-keyboard="true">Clients</a>
                </li>
              </ul>
            </li>
            
          <?php else: ?>
            
            <li class="dropdown" data-dropdown="dropdown">
              <a href="#" class="dropdown-toggle">
                <?php //echo lang('nav.logout') ?>Logout
              </a>
              <ul class="dropdown-menu">
                <li>
                  <?php echo anchor('auth/logout', 'Logout'); ?>
                </li>
              </ul>
            </li>
          <?php endif; ?>
          </ul>
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
                <input class="xlarge span4" id="login-email" name="login-email" size="30" type="text" />
              </div>
              
              <label for="login-ref-code"><?php echo lang('login.ref') ?></label>
              <div class="input">
                <input class="xlarge span4" id="login-ref-code" name="login-ref-code" size="30" type="password" />
              </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        <a href="dashboard/client/index.html" class="btn primary">Go!</a>
        <a href="#" class="btn secondary"><?php echo lang('login.reflost') ?></a>
      </div>
    </div>
    <p/>
    <!-- END OF HEADER -->

    <div class="container"> <!--FIXME is this needed? -->
      <div id="contents"><?= $contents ?></div>
      <footer>
      <p>&copy; <?php 
        $copyYear = 2011; 
        $curYear = date('Y'); 
        echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '') .' '.lang('company.name') ?> 
      </p>
    </footer>
    </div>

    <!-- END OF VIEW -->

  </body>
</html>
