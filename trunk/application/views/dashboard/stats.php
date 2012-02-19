        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> dashboard</h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>
        </div>
        <div class="row">
        <div class="span9">
          <?php
		  $data = $this->customer_model->countActiveCustomers();
		  ?>
		  
		  <?php foreach($data as $datum): ?>
			<?php foreach($datum as $datumArray): ?>
				<dd> Number of Current Users (Activated) : <?php echo $datumArray; ?></dd>
			<?php endforeach; ?>
		  <?php endforeach; ?>
		  
        </div>
        </div>
