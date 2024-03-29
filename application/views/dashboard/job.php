<div class="accordion-group">
	<div class="accordion-heading">
		<a
			class="accordion-toggle"
			data-toggle="collapse"
			data-parent="#accordion2"
			href="#<?php echo $job->jobID; ?>"
		>
			Job Number: <?php echo $job->jobID; ?><i>- Click to Expand</i>
		</a>
	</div>
	<div id="<?php echo $job->jobID; ?>" class="accordion-body collapse">
		<div class="accordion-inner">
			<div class="well">
				<div class="row">
					<div class="span3">
						<dl>
							<dt>Client</dt>
								<dd><?php echo $job->fullName; ?></dd>
							<dt>Languages</dt>
								<dd>
									<?php echo ucfirst($job->fromLanguage); ?>
									to
									<?php echo ucfirst($job->toLanguage); ?>
								</dd>
							<dt>Sent on</dt>
								<dd><time><?php echo $job->dateRequested; ?></time></dd>
						</dl>
					</div>
					<div class="span3">
						<dl>
							<dt>Quote</dt>
								<dd><?php echo (($subtitle != 'pending') ? $job->quote . " " . strtoupper($job->currency) : "&mdash;") ?></dd>
							<dt>Date Due</dt>
								<dd><?php echo $job->dateDue; ?></dt>
						</dl>
						<?php
							if($this->session->userdata('role') == 'client'){
								if($subtitle == 'quoted'):
						?>
									You can:
									<?php echo $job->button; ?>
									<a class="btn btn-small btn-danger decline-quote"> Decline</a>
									Note: If you have already paid, and the payment is pending, there is no need to click again.
						<?php
								endif;
							}
							else{
						?>
							<?php if(in_array($subtitle, array('pending', 'quoted'))): ?>
							<form class="well form-search">
								<span class="label label-warning">
									<?php echo (($subtitle == 'pending') ? 'Enter' : 'Update'); ?>
									Quote
								</span>
									<input type="text" class="input-small" placeholder="Quote"> <?php echo strtoupper($job->currency); ?>
									<a
										class="btn btn-small btn-success <?php echo (($subtitle == 'pending') ? 'send' : 'update'); ?>-quote"
										data-controls-modal="modal-from-dom"
										href="#"
									><?php 
										if( $subtitle == 'pending' )
											echo 'Submit';
										if( $subtitle == 'quoted' )
											echo 'Update'
									?> Quote
									</a>
							</form>
							<?php endif;  ?>
						<?php }//endif;  ?>
					</div> <!-- end .span3 -->
				</div>
				<table class="table table-striped" id="sortTableExample">
					<thead>
					  <tr>
						<th class="header headerSortDown" width="20">#</th>
						<th class="header">Document Name</th>
						<th class="blue header">Original File</th>
						<?php if( $subtitle == 'translated' ): ?>
						<th class="blue header">Translated File</th>
						<?php endif; ?>
					  </tr>
					</thead>
					<tbody>
                <?php foreach($job->translations as $key => $translation): ?>
						<tr>
							<td><?php echo $key + 1; ?>.</td>
							<td><?php echo $translation->name ?></td>
							<td><?php echo anchor($translation->origPath, 'Download'); ?></td>
							<?php if( $subtitle == 'accepted' && admin() ): ?>
							<td><?php echo uploadbox($job->jobID, $translation->id); ?></td>
							<?php endif; ?>
							<?php if( $subtitle == 'translated' ): ?>
							<td><?php echo anchor($translation->transPath, 'Download'); ?></td>
							<?php endif; ?>
						</tr>
				<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- end .well -->
		</div>
	</div>
</div>
