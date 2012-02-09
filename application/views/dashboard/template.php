<div class="nav nav-list" >
	<div class="span3">
        <div class="well" >
          <h5>Menu</h5>
          <ul class="nav nav-list">
			 <?php if($this->session->userdata('role') == 'client'): ?>
            	<li><a href="/dashboard/submit"><i class="icon-plus"></i> Submit new Job</a></li>
             <?php endif; ?>
	    <li><a href="/dashboard/pending"><i class="icon-list"></i> Pending</a></li>
	    <li><a href="/dashboard/quotes"><i class="icon-th-list"></i> Quotes</a></li>
	    <li><a href="/dashboard/translations"><i class="icon-file"></i> Translations</a></li>
	    <li><a href="/dashboard/history"><i class="icon-time"></i> History</a></li>
	    <?php if($this->session->userdata('role') == 'admin'): ?>
            	<li><a href="/dashboard/submit"><i class="icon-book"></i> Site Statistics</a></li>
             <?php endif; ?>
          </ul>
          <h5>Other</h5>
          <ul class="nav nav-list">
	    <li><a href="/auth/logout"><i class="icon-user"></i> Logout</a></li>
          </ul>
        </div>
      </div>

      <div class="content">
	<div class="span9">
    
    <?php if($this->session->userdata('role') == 'admin'): ?>
      <script type="text/javascript" src="<?php echo base_url(); ?>js/admin-dashboard.js"></script>
    <?php endif; ?>

    <div id="modal-from-dom" class="modal hide fade">
      <div class="modal-header"></div>
      <div class="modal-body"></div>
      <div class="modal-footer"></div>
    </div>
    
    <?php $this->load->view($content); ?>

  </div>
