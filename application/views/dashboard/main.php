<table class="table table-bordered table-striped">
	<thead>
	  <tr>
		<th>Description </th>
		<th>Value</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td>
		  <p> Number of Pending jobs </p>
		</td>
		<td>
		    <?php $pendingJob = $this->customer_model->countCustPending(); ?>		  
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
		    <?php $quotedJob = $this->customer_model->countCustAwaitingPayment(); ?>		  
			  <?php foreach($quotedJob as $qJob): ?>
				<?php foreach($qJob as $qJobArray): ?>
					<?php echo $qJobArray; ?>
				<?php endforeach; ?>
			  <?php endforeach; ?>
		</td>
	  </tr>
	  <tr>
		<td>
		  <p> Number of jobs I have paid for </p>
		</td>
		<td>
		    <?php $paidJob = $this->customer_model->countCustPaid(); ?>		  
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
		    <?php $translatedJob = $this->customer_model->countCustTranslated(); ?>		  
			  <?php foreach($translatedJob as $tJob): ?>
				<?php foreach($tJob as $tJobArray): ?>
					<?php echo $tJobArray; ?>
				<?php endforeach; ?>
			  <?php endforeach; ?>
		</td>
	  </tr>
	  <tr>
		<td><p style="text-align:right"><strong>Total Number of Jobs </strong></p></td>
		<td>
		    <?php echo $pJobArray+$qJobArray+$paidJobArray+$tJobArray?>
		</td>
	  </tr>
	</tbody>
</table>
