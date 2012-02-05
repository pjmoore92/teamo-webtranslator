        <div class="page-header">
          <h1>Client dashboard <small>Pending quotes</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>

          <!--<div class="alert-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p><strong>Update:</strong> Joelle has sent you the quote for Docname3. Please review it!</p>
          </div>-->

          <div class="alert alert-block alert-error fade in">
            <a class="close" data-dismiss="alert" href="#">&times;</a>
            <p>
              <strong>Update:</strong> Joelle has sent you a quote for <strong>Docname2</strong>:
              It will cost &pound;50 and it will be ready on the <time>2011-09-17</time>.
            </p>
            <div class="alert-actions">
              <a class="btn btn-small btn-success" href="#">I accept!</a>
              <a class="btn btn-small btn-danger" href="#">No, thanks!</a>
            </div>
          </div>

        </div>
        <div class="row">
        <div class="span9">
          <?php
              if($jobs_list == NULL):
                echo ':( You have no pending jobs.';
              else:
          ?>
		  <?php endif; ?>
         <!-- <table class="zebra-striped" id="sortTableExample">
            <thead>
              <tr>
                <th class="header headerSortDown">#</th>
                <th class="header">Date requested</th>
                <th class="header">Date due</th>
                <th class="blue header">From language</th>
                <th class="blue header">To language</th>
              </tr>
            </thead>-->
	    <div class="accordion" id="accordion2">
	    <?php foreach($jobs_list as $job): ?>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $job->jobID; ?>"> Job <?php echo $job->jobID; ?></a>
				</div>
				<div id="<?php echo $job->jobID; ?>" class="accordion-body collapse in">
					<div class="accordion-inner">
					<tr>
						<td><?php echo $job->jobID; ?></td>
						<td><?php echo $job->dateRequested; ?></td>
						<td><?php echo $job->dateDue; ?></td>
						<td><?php echo $job->fromLanguage; ?></td>
						<td><?php echo $job->toLanguage; ?></td>
					</tr>
					</div>
				</div>
				</div>
		<?php endforeach; ?>
        </div>
		
        </div>
