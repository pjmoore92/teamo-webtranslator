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
      <div class="input">
        <select class="medium" name="register-currency" id="register-currency-select">
          <option value="gbp">GBP &pound;</option>
          <option value="eur">EUR &euro;</option>
        </select>
      </div>

      <label for="register-deadline">Deadline
      <i class = "icon-question-sign" rel="tooltip" title="The date you want your document(s) translated before"></i>
      </label>
      <input type="text" id="datepicker" placeholder="yy-mm-dd">
  </p>
</div>
<div class="span-one-third" style="text-align:center">
  <p><a id="upload-submit" class="btn" href="#" data-controls-modal="modal-from-dom" 
    data-backdrop="true" data-keyboard="true">Upload!</a></p>
</div>

<script type="text/javascript" src="<?php echo base_url('/js/plupload/plupload.full.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/upload.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/client-dashboard.js'); ?>"></script>
