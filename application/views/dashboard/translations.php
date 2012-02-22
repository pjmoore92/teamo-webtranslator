        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> Dashboard <small>Translated Jobs</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>
        </div>
        <div class="row">
        <div class="span9">
          <?php
            if($jobs_list == NULL):
				echo 'You have no translated jobs.';
            else:
			?>
			<div class="accordion" id="accordion2">
			<?php foreach($jobs_list as $job): ?>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $job->jobID; ?>"> Job Number: <?php echo $job->jobID; ?> <i>-  Click to Expand</i> </a>
				</div>
				<div id="<?php echo $job->jobID; ?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<div class="well">
							<div class="row">
								<div class="span3">
									<dl>
										<dt>Client</dt>
											<dd><?php echo $client_name; ?></dd>
										<dt>Languages</dt>
											<dd><?php echo $job->fromLanguage; ?> to <?php echo $job->toLanguage; ?></dd>
										<dt>Sent on</dt>
											<dd><time><?php echo $job->dateRequested; ?></time></dd>
									</dl>
								</div>
								<div class="span3">
									<dl>
										<dt>Price Paid</dt>
											<dd><?php if($job->quote == NULL):
												  		echo 'Quote is Missing! Contact Us';
												  else: 	
												  		echo '£', $job->quote;
												  endif;  ?></dd>
										<dt>Date Due</dt>
											<dd><?php echo $job->dateDue; ?></dt>
									</dl>
									<?php if($this->session->userdata('role') == 'client'): 
											?>
												<button class="btn btn-small btn-warning">Contact Translator</button>										<?php
												  else: 	
												  ?> 
												  <?php endif;  ?>
									
								</div>
							</div>
							  <table class="table table-striped" id="sortTableExample">
								<thead>
								  <tr>
									<th class="header headerSortDown" width="20">#</th>
									<th class="header">Document Name</th>
									<th class="blue header">Word count</th>
									<th class="blue header"><abbr title="Estimated time of arrival">ETA</abbr></th>
									<th class="blue header">Quote</th>
								  </tr>
								</thead>
								<tbody>
								  <tr>
									<td>1</td>
									<td>Docname</td>
									<td>9,000</td>
									<td><time>2011-09-15</time></td>
									<td>£100</td>
								  </tr><tr>
									<td>2</td>
									<td>Docname2</td>
									<td>9,000</td>
									<td><time>2011-09-17</time></td>
									<td>£70</td>
								  </tr><tr>
									<td>3</td>
									<td>Docname3</td>
									<td>9,000</td>
									<td><time>2011-09-07</time></td>
									<td>£50</td>
								  </tr>
								</tbody>
							  </table>
						</div><!-- end .well -->
					</div>
				</div>
				</div>
		<?php endforeach; ?>
        </div>

		  <?php endif; ?>
        </div>
