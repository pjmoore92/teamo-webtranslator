<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Phone Interpretation Service</small></h1>
</div>
<div class="row">
  <div class="span10">
    
    <p>
        Bethel Translations only offers consecutive interpreting services scheduled ahead of time.
        The sessions are conducted through landlines and Skype.<br>
        <br />
        I am committed to providing you, the customer, with a range of interpreting services bringing 
        the best in quality and customer satisfaction, at cost effective rates.<br>
        The main goal is to convey the original idea behind the words of a speaker to the target language.
        Moreover, you can rest assured of the confidentiality of all information provided.<br>
        <br />
        To receive a <strong>free full quote</strong> on this service, please click on the button below.
    </p>
    </div>
    <div class="span10">
    <p>
        Areas of expertise:
    </p>
    <ul>
        <li>Medical</li>
        <li>General</li>
        <li>Public services</li>
    </ul>
    </div>
    <div class="span10">
    <p style="text-align: center"> 
  		<br>
  		<br>
      <?php
        echo anchor(
            site_url('welcome/contact/phone_interpreting'),
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
</div>
