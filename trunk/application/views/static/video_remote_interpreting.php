<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Video Remote Interpretation Service</small></h1>
</div>
<div class="row">
  <div class="span10">
    
    <p>
       As a professional interpreter, I also provide video remote interpreting services from English 
       into French language in the <strong>medical area</strong> only.<br>
       <br />
       Video interpreting is the perfect solution when you need to access an on-demand Interpreter and the 
       Interpreting by Telephone and Face-to-Face Interpreting methods are not appropriate or feasible for 
       the situation. As soon as the call is connected, I will appear on the computer monitor. 
       You will be able to see and hear me as if I was in the room with you.<br>
       <br />
       As a Video Remote Interpreter I will be a key member in facilitating language communication 
       on a variety of assignments. <br>
       <br />
       For a <strong>free quote</strong> on this service, please click on the button below.
    </p>
    
    <p style="text-align: center"> 
  		<br>
  		<br>
      <?php
        echo anchor(
            site_url('welcome/contact/video_interpreting'),
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
