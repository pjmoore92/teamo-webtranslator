        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> Dashboard <small> Statistics </small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>
        </div>
        <div class="row">
		<div class="span8">
		  <table class="table table-bordered table-striped">
			<thead>
			  <tr>
				<th>Description </th>
				<th>Value</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td> <p> Number of Users who have activated their Account </p> </td>
				<td>
				    <?php $data = $this->customer_model->countActiveCustomers(); ?>		  
					  <?php foreach($data as $datum): ?>
						<?php foreach($datum as $datumArray): ?>
							<?php echo $datumArray; ?>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			  <tr>
				<td> <p> Number of Users, activated and unactivated </p> </td>
				<td> <?php echo $users = $this->customer_model->countAllCustomers(); ?> </td>
			  </tr>
			  <tr>
				<td colspan="2"> <strong>Job Statistics</strong></td>
			  </tr>
			  <tr>
				<td>
				  <p> Number of Pending Jobs</p>
				</td>
				<td>
				    <?php $pendingJob = $this->customer_model->countPending(); ?>		  
					  <?php foreach($pendingJob as $pJob): ?>
						<?php foreach($pJob as $pJobArray): ?>
							<?php echo $pJobArray; ?>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			  <tr>
				<td>
				  <p> Number of Quotes </p>
				</td>
				<td>
				    <?php $quotedJob = $this->customer_model->countAwaitingPayment(); ?>		  
					  <?php foreach($quotedJob as $qJob): ?>
						<?php foreach($qJob as $qJobArray): ?>
							<?php echo $qJobArray; ?>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			  <tr>
				<td>
				  <p> Number of Paid Jobs </p>
				</td>
				<td>
				    <?php $paidJob = $this->customer_model->countPaid(); ?>		  
					  <?php foreach($paidJob as $paidJob): ?>
						<?php foreach($paidJob as $paidJobArray): ?>
							<?php echo $paidJobArray; ?>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			  <tr>
				<td>
				  <p> Number of Translations (Less than 90 days old) </p>
				</td>
				<td>
				    <?php $translatedJob = $this->customer_model->countTranslated(); ?>		  
					  <?php foreach($translatedJob as $tJob): ?>
						<?php foreach($tJob as $tJobArray): ?>
							<?php echo $tJobArray; ?>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			  <tr>
				<td><p style="text-align:right"><strong>Total Number of Jobs (All Statuses)</strong></p></td>
				<td>
				    <?php $total = $this->customer_model->countTotal(); ?>		  
					  <?php foreach($total as $totalJob): ?>
						<?php foreach($totalJob as $totalJobArray): ?>
							<strong><?php echo $totalJobArray; ?></strong>
						<?php endforeach; ?>
					  <?php endforeach; ?>
				</td>
			  </tr>
			</tbody>
		  </table>
		  
		

		</div>
        </div>
        </div>
