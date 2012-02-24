<?php
    if($jobs_list == NULL):
    echo "You have no {$subtitle} jobs.";
    else:
?>
<div class="accordion" id="accordion2">
<?php
  foreach($jobs_list as $job)
    $this->load->view('dashboard/job', array('job' => $job, 'subtitle' => $subtitle));
?>
</div>

<?php endif; ?>