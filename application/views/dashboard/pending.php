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
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $job[0]->jobID; ?>"> Job Number: <?php echo $job[0]->jobID; ?> <i>-  Click to Expand</i> </a>
				</div>
				<div id="<?php echo $job[0]->jobID; ?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<div class="well">
							<div class="row">
								<div class="span3">
									<dl>
										<dt>Client</dt>
											<dd><?php echo $job[0]->fullName; ?></dd>
										<dt>Languages</dt>
											<dd><?php echo $job[0]->fromLanguage; ?> to <?php echo $job[0]->toLanguage; ?></dd>
										<dt>Sent on</dt>
											<dd><time><?php echo $job[0]->dateRequested; ?></time></dd>
									</dl>
								</div>
								<div class="span3">
									<dl>
										<dt>Quote</dt>
											<dd>&mdash;</dd>
										<dt>Date Due</dt>
											<dd><?php echo $job[0]->dateDue; ?></dt>
									</dl>
									<?php if($this->session->userdata('role') == 'client'): 		
												  else: 	
												  ?><form class="well form-search">
												  <span class="label label-warning">Enter Quote</span>
        											  <input type="text" class="input-small" placeholder="Quote">
        											  
												  <a class="btn btn-small btn-success send-quote" data-controls-modal="modal-from-dom" href="#">Send Quote</a>
												  </form>
												  <?php endif;  ?>
									
								</div>
							</div>
							  <table class="table table-striped" id="sortTableExample">
								<thead>
								  <tr>
									<th class="header headerSortDown" width="20">#</th>
									<th class="header">Document Name</th>
									<th class="blue header">Original File</th>
									<th class="blue header">Translated File</th>
								  </tr>
								</thead>
								<tbody>
                                <?php $translist = $job[1]; foreach ($translist as $translation): ?>
								  <tr>
									<td>1</td>
                                    <td><?php echo $translation[0] ?></td>
                                    <td><?php echo anchor($translation[1]->filePath, 'Download') ?></td>
                                    <td><?php echo anchor($translation[2]->filePath) ?></td>
                                  </tr>
                                <?php endforeach; ?>
								</tbody>
							  </table>
						</div><!-- end .well -->
					</div>
				</div>
				</div>
		<?php endforeach; ?>
        </div>

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
	    
        </div>
