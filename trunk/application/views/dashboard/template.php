<div class="nav nav-list" >
    <div class="span3">
        <div class="well" >
          <h5>Menu</h5>
          <ul class="nav nav-list">
     <?php if($this->session->userdata('role') == 'client'): ?>
     <?php if($type == 'submit'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/submit"><i class="icon-plus"></i> Submit new Job</a></li>
     <?php endif; ?>
    <?php if($type == 'pending'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/pending"><i class="icon-list"></i> Pending</a></li>
    <?php if($type == 'quoted'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/quoted"><i class="icon-th-list"></i> Quoted</a></li>
    <?php if($type == 'accepted'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/accepted"><i class="icon-th-list"></i> Accepted</a></li>
    <?php if($type == 'declined'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/declined"><i class="icon-th-list"></i> Declined</a></li>
    <?php if($type == 'translations'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/translations"><i class="icon-file"></i> Translations</a></li>
    <?php if($type == 'history'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/history"><i class="icon-time"></i> History</a></li>
    <?php if($this->session->userdata('role') == 'admin'): ?>
    <?php if($type == 'stats'): ?><li class="active"><?php else:?><li><?php endif;?>
        <a href="/dashboard/jobs/stats"><i class="icon-book"></i> Site Statistics</a></li>
    <?php endif; ?>
          </ul>
          <h5>Other</h5>
          <ul class="nav nav-list">
        <li><a href="/auth/logout"><i class="icon-user"></i> Logout</a></li>
        <li><a href="/dashboard/switchrole"><i class="icon-user"></i> Switch Role</a></li>
          </ul>
        </div>
      </div>

      <div class="content">
    <div class="span9">

<?php if($this->session->userdata('role') == 'admin'): ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/admin-dashboard.js"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/client-dashboard.js"></script>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery/jquery.blockUI.js"></script>

<div id="modal-from-dom" class="modal hide fade">
<div class="modal-header"></div>
<div class="modal-body"></div>
<div class="modal-footer"></div>
</div>

<div class="page-header">
<h1><?php echo ucfirst($role); ?> Dashboard <small><?php if( isset($subtitle) ) echo ucfirst($subtitle) . " Jobs"; ?></small></h1>
<h2>Hello, <?php echo $client_name; ?>!</h2>
</div>


<!-- User Notification -->
<?php if($this->session->flashdata('info') == TRUE || $this->session->flashdata('error') == TRUE ): ?>
<div class="msgUI" style="display:none">
<h3><strong><?php if ($this->session->flashdata('info') == TRUE) echo "Success"; else echo "Error"; ?></strong></h3>
<h4><?php echo $this->session->flashdata('msg');?></h4>
</div>

<script>$(document).ready(function() {
    $.blockUI({ 
        message: $('div.msgUI'), 
                fadeIn: 500, 
                fadeOut: 400, 
                timeout: 1500,
                showOverlay: false, 
                centerY: false, 
                css: { 
                    width: '350px', 
                        top: '90px', 
                        left: '', 
                        right: '10px', 
                        border: 'none', 
                        padding: '5px', 
                        backgroundColor: '#000', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .6, 
                        color: '#fff' 
                } 
    }); 
});

</script>
<?php endif; ?>

<?php if( isset($message) ): ?>
  <?php
    $message->type = ($message->type != NULL) ? 'alert-'.$message->type : '';
  ?>
    <div class="alert <?php echo $message->type; ?>">
      <a class="close" data-dismiss="alert">×</a>
      <?php echo $message->text; ?>
    </div>
<?php endif; ?>

<!-- Sidebar -->
<div class="row">
  <div class="span9">
<?php
if($type == 'stats')
    $this->load->view('dashboard/stats');
elseif($type == 'main')
    $this->load->view('dashboard/main');
elseif($type == 'submit')
    $this->load->view('dashboard/submit');
elseif($type == 'payment_success' || $type == 'payment_failure')
    $this->load->view($content);
else
    $this->load->view('dashboard/jobs', array('jobs_list' => $jobs_list, 'subtitle' => $subtitle));
?>
  </div>
</div>
