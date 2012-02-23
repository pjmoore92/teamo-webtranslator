        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> Dashboard <small>Pending Jobs</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>
        </div>
        <div class="row">
        <div class="span9">
          <?php
            if($jobs_list == NULL):
				echo 'You have no pending jobs.';
            else:
			?>

			<div class="accordion" id="accordion2">
			<?php foreach($jobs_list as $job): ?>
				<?php $this->load->view('dashboard/job', array('job' => $job)); ?>
			<?php endforeach; ?>
        	</div>

		  <?php endif; ?>
		</div>
		