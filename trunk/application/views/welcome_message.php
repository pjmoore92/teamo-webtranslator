<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<?php
  // load business config file for available currencies and languages
  $this->load->config('business');

  $currencies = $this->config->item('currencies');
  $languages_to = $this->config->item('languages_to');
  $languages_from = $this->config->item('languages_from');
?>

<!-- TODO horizontal sliding Ads a la BBC? -->
<div class="hero-unit">
<h1><?php echo lang('helloWorld') ?></h1>
<p>
<strong>
Bethel Translations provides translations and Interpreting services from English and Italian into the French language, and French proof-reading services to translation agencies, businesses and individuals.

We pride ourselves in our ability to deliver exceptional services and have set the standard for business translation and interpreting precision and quality - that means you save time and money and you can enjoy the translation and interpreting process while you work with us.

If you would like a quote for any of these services, please navigate to my <a href =http://alasdaircampbell.com/en/welcome/contact>Contact</a> page.
You can also register below and upload your documents. I will review them and send you a quote for a translation in your chosen language.
We hope you enjoy our website and look forward to hearing from you soon.
</strong>
</p>
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
            <?php
              if( $languages_from != NULL )
                foreach( $languages_from as $lang ):
            ?>
            <option value="<?php echo $lang; ?>"><?php echo ucfirst($lang); ?></option>
            <?php endforeach; ?>
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
            <?php
              if( $languages_to != NULL )
                foreach( $languages_to as $lang ):
            ?>
            <option value="<?php echo $lang; ?>"><?php echo ucfirst($lang); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
	
        <label for="register-currency">Currency	
        <i class = "icon-question-sign" rel="tooltip" title="This is the currency you would like pay in"></i>
        </label>        
        <div type = "hidden" class="input">
          <select class="medium" name="register-currency" id="register-currency-select">
            <?php
              if( $currencies != NULL )
                foreach( $currencies as $currency ):
            ?>
            <option value="<?php echo $currency; ?>"><?php echo strtoupper($currency); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <label for="register-deadline">Deadline
        <i class = "icon-question-sign" rel="tooltip" title="The date you want your document(s) translated before"></i>
        </label>
        <input type="text" id="datepicker" placeholder="dd-mm-yyyy">
    </p>
  </div>
  </div>
<br />
<br />
<br />

  
  <div class = "row" position ="absolute" style="text-align:center">
    <div class="grid" style="text-align:center">
    <p></p>
    </div>
    <div class="grid" style="text-align:center">
    <p><a id="register-submit" class="btn btn-success btn-large" href="#" data-controls-modal="modal-from-dom-register-message" 
              data-backdrop="true" data-keyboard="true">Submit + Register! &raquo;</a></p>
  <!--  <input type="submit" class="btn btn-success" value="Get your quote!"> -->
    </div>
    <div class="grid" style="text-align:center">
    <p></p>
    </div>
  </div>
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
