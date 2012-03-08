<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<!-- TODO horizontal sliding Ads a la BBC? -->
<div class="hero-unit">
<h1><?php echo lang('helloWorld') ?></h1>

<p>I offer excellent translation services with a primary focus on translating documents 
from French to English and vice versa. I also offer some other services as can be viewed in 
the menus above. If you would like a quote for any of these, please navigate to my contact page.</p>

<p>You can register below and upload your documents. I will review them and send you a quote for a
translation in your chosen language.</p>
</div>

<!--<form>-->
<!-- Example row of columns -->
<?php if ($this->tank_auth->is_logged_in()){
?>
<div class="container">
<div class="row">
<h2>
It looks like you are logged in, please submit docs via the <a href = http://alasdaircampbell.com/en/dashboard/submit>dashboard</a>!
</h2>
<?php
}
else{
?>
<div class="container">
<form id="fileform" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="grid" style="text-align:center">
  <h2><?php echo lang('upload.details') ?></h2>
    <p>
      <! Anti spam bot detection field - DO NOT remove! !>
      <input type="hidden" id="register-location" name="register-location" value=""/>
      <label for="register-name">Your name</label>
      <div class="input">
        <input class="xlarge span3" id="register-name" name="register-name" size="30" type="text" />
      </div>

      <label for="register-email">Your e-mail</label>
      <div class="input">
        <input class="xlarge span3" id="register-email" name="register-email" size="30" type="email" />
      </div>
    </p>
  </div>
  <div class="grid" style="text-align:center">
    <h2><?php echo lang('upload.browse') ?></h2>
     <div>
        <label for="register-language-from">Source language</label>
        <div class="input">
          <select class="medium" name="register-language-from" id="register-language-from-select">
            <option value="english">English</option>
            <option value="italian">Italian</option>
          </select>
        </div>

      </div>
      <p>
        <div id="container">
            <div id="filelist"></div>
            <br />
            <a id="pickfiles" class="btn btn-info" href="#">Select files</a> 
            <a id="uploadfiles" href="#"></a>
	    <br />
	    <b>&dagger;</b>Accepted file formats: pdf,doc,docx,rtf,txt<br>Maximum File Size: <b>20MB</b>	
        </div>
     </p>
 </div>
  <div class="grid" style="text-align:center">
    <h2><?php echo lang('upload.setreqs') ?></h2>
    <p>
        <label for="register-language-to">Language
        <i class = "icon-question-sign" rel="tooltip" title="The language you want to translate to"></i>
        </label>
        <div class="input">
          <select class="medium" name="register-language-to" id="register-language-to-select">
            <option value="french">French</option>
          </select>
        </div>
	
        <label for="register-currency">Currency	
        <i class = "icon-question-sign" rel="tooltip" title="This is the currency you would like pay in"></i>
        </label>        
        <div type = "hidden" class="input">
          <select class="medium" name="register-currency" id="register-currency-select">
            <option value="gbp">GBP &pound;</option>
            <option value="eur">EUR &euro;</option>
            <option value="usd">USD &dollar;</option>
          </select>
        </div>

        <label for="register-deadline">Deadline
        <i class = "icon-question-sign" rel="tooltip" title="The date you want your document(s) translated before"></i>
        </label>
        <input type="text" id="datepicker" placeholder="yy-mm-dd">
    </p>
  </div>

<br />
<br />
<br />
<br>
  <div class="span3">&nbsp;</div>
  <div class="span3 offset1" style="text-align:center">
    <p><a id="register-submit" class="btn btn-success btn-large" href="#" data-controls-modal="modal-from-dom-register-message" 
              data-backdrop="true" data-keyboard="true">Submit + Register! &raquo;</a></p>
  <!--  <input type="submit" class="btn btn-success" value="Get your quote!"> -->
  </div>
  <div class="span-one-third">&nbsp;</div>
</div>
</div>
<?php
}
?>
<div id="modal-from-dom-register-message" class="modal hide fade in">
  <div class="modal-header">
  </div>
  <div class="modal-body"><p></p>
  </div>
  <div class="modal-footer">
  </div>
</form>
</div>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/js/plupload/plupload.full.js"></script>

<script type="text/javascript" src="<?php echo base_url('js/upload.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/register.js'); ?>"></script>
