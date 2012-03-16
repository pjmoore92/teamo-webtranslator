<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Editing and Proofreading Service</small></h1>
</div>
<div class="row">
  <div class="span10">
    
    <p>
        I offer proof-reading services whether or not the document was edited by me. <br>
        <br />
        Since I take pride in my work, I will provide you with a high level of quality control 
         ensuring that the translated text reads as well as an original article. This will provide more 
         appropriate translations where necessary and comparing the source and the target to check accuracy 
         and consistency in terminology. Moreover, it will ensure that the meaning and purpose is correctly conveyed.<br>
        During this process, I will correct typing errors, spelling mistakes and grammatical inaccuracies.<br>
        <br />
        To receive a <strong>free quote</strong> on this service, click on the button below. 	
    </p>
    
    <p style="text-align: center"> 
  		<br>
  		<br>
      <?php
        echo anchor(
            site_url('welcome/contact/editing_proofreading'),
            'Get A Quote Here',
            array(
                'class' => 'btn btn-success btn-large'
              )
          );
      ?>
  	</p>
  </div>

  
</div>
</div>
