        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> dashboard</h1>
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
				<td>
				  <p> Number of Users who have activated their Account </p>
				</td>
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
				<td>
				   <p> Number of Users, activated and unactivated </p>
				</td>
				<td>
				  <?php echo $users = $this->customer_model->countAllCustomers(); ?>
				</td>
			  </tr>
			</tbody>
		  </table>
		  
		

		</div>
        </div>
        </div>
