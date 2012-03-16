<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<div class="content">
<div class="page-header">
  <h1 class="active">Bethel Translations <small>Document Translation Service</small></h1>
</div>
<div class="row">
  <div class="span10">
    
    <p>
       Bethel translations provides translation services according to a rigorous Quality Assurance process.<br>
Quality in translation is non-negotiable. As a professional French translator, 
I understand that its important main goal is one: to convey the original idea behind the words
of an author to the target language. <br>
<br />
Bethel Translations is dedicated and committed to providing you, the customer, with a range of translation 
services bringing the best in quality and customer satisfaction, at cost effective rates.<br />
</p>
</div>
<br />
<div class="span10">
<p>My areas of expertise include: </p>

<ul>
<li>Computer / General</li>
<li>General / Conversation / Greetings / Letters</li>
<li>Navigation devices</li>
<li>Household appliances</li>
<li>User interface</li>
<li>User manuals</li>
</ul>
</div>
<div class="span10">
<p>To receive a <strong>free full quote</strong> on this service, please click on the button below. Please understand that while I am always happy to take a look at your text, I only take on work
if I am confident I can provide the quality you are entitled to expect.</p>
</div>
    
        <div class="span10">
  	<p style="text-align: center"> 
  		<br>
  		<br>
  		<?php if($this->tank_auth->is_logged_in()): ?>
	  	<?php
		echo anchor(
		    site_url('dashboard/submit'),
		    'Get A Quote Here',
		    array(
		        'class' => 'btn btn-success btn-large'
		      )
          	);?>
          	<?php else: ?>
          	<?php
		echo anchor(
		    site_url('welcome/'),
		    'Get A Quote Here',
		    array(
		        'class' => 'btn btn-success btn-large'
		      )
          	);?>
          	<?php endif; ?>
    </p>
    </div>
    
  </div>
  
  
</div>
</div>
