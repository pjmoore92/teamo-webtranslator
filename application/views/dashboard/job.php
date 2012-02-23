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
								<dd><?php echo ucfirst($job->fromLanguage); ?> to <?php echo ucfirst($job->toLanguage); ?></dd>
							<dt>Sent on</dt>
								<dd><time><?php echo $job->dateRequested; ?></time></dd>
						</dl>
					</div>
					<div class="span3">
						<dl>
							<dt>Quote</dt>
								<dd>&mdash;</dd>
							<dt>Date Due</dt>
								<dd><?php echo $job->dateDue; ?></dt>
						</dl>
						<?php
							if($this->session->userdata('role') == 'client'):
							else:
						?>
						<form class="well form-search">
							<span class="label label-warning">Enter Quote</span>
								<input type="text" class="input-small" placeholder="Quote">
								<a
									class="btn btn-small btn-success send-quote"
									data-controls-modal="modal-from-dom"
									href="#"
								>Send Quote
								</a>
						</form>
						<?php endif;  ?>
					</div> <!-- end .span3 -->
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
                <?php foreach($job->translations as $translation): ?>
						<tr>
							<td>1</td>
							<td><?php echo $translation->name ?></td>
							<td><?php echo anchor($translation->origPath, 'Download'); ?></td>
							<td><?php 
								if($translation->transPath != '')
									echo anchor($translation->transPath, 'Download');
								else
									echo anchor('#', 'Submit translated file');
								?></td>
						</tr>
				<?php endforeach; ?>
					</tbody>
				</table>
			</div><!-- end .well -->
		</div>
	</div>
</div>