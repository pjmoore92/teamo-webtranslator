<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>
<!-- TODO horizontal sliding Ads a la BBC? -->
<div class="hero-unit">
<h1><?php echo lang('helloWorld') ?></h1>
<p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat
a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non
commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
elit.</p>
<p><a class="btn primary large">Learn more &raquo;</a></p>
</div>

<!--<form>-->
<!-- Example row of columns -->
<div class="row">
  <div class="span-one-third" style="text-align:center">
    <h2>Input your info</h2>
    <!--<p>Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>-->
    <p>
    <form>
      <label for="register-name">Your name</label>
      <div class="input">
        <input class="xlarge span3" id="register-name" name="register-name" size="30" type="text" />
      </div>
        
      <label for="register-email">Your e-mail</label>
      <div class="input">
        <input class="xlarge span3" id="register-email" name="register-email" size="30" type="text" />
      </div>
    </form>
    </p>
  </div>
  <div class="span-one-third" style="text-align:center">
    <h2>Upload your docs</h2>
     <!--<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
     <p>
     <form>
        <label for="register-language-from">Source language</label>
        <div class="input">
          <select class="medium" name="register-language-from" id="register-language-from-select">
            <option>English</option>
            <option>French</option>
            <option>Italian</option>
          </select>
        </div>

      </p>
      <p>
          <label for="register-documents-upload">Documents</label>
          <div class="input">
          <input class="input-file" id="register-documents-upload" name="register-documents-upload" type="file">
          <!--<input class="input-file" id="fileInput2" name="fileInput" type="file">
          <input class="input-file" id="fileInput3" name="fileInput" type="file">-->
          </div>
      </form>
     </p>
 </div>
  <div class="span-one-third" style="text-align:center">
    <h2>Set requirements</h2>
    <!--<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.</p>-->
    <p>
    <form>
        <label for="register-language-to">Language</label>
        <div class="input">
          <select class="medium" name="register-language-to" id="register-language-to-select">
            <option>English</option>
            <option>French</option>
            <option>Italian</option>
          </select>
        </div>

        <label for="register-currency">Currency</label>
        <div class="input">
          <select class="medium" name="register-currency" id="register-currency-select">
            <option>GBP &pound;</option>
            <option>EUR &euro;</option>
          </select>
        </div>
    </form>
    </p>
  </div>
</div>
<br />
<br />
<br />
<div class="row">
  <div class="span-one-third">&nbsp;</div>
  <div class="span-one-third" style="text-align:center">
    <p><a id="register-submit" class="btn" href="#" data-controls-modal="modal-from-dom-register-message" 
              data-backdrop="true" data-keyboard="true">Get your quote! &raquo;</a></p>
    <input type="submit" class="btn primary" value="Get your quote!">
  </div>
  <div class="span-one-third">&nbsp;</div>
  <!--<div class="span-one-third">Quote</div>-->
</div>
<!-- </form> -->

    <div id="modal-from-dom-register-message" class="modal hide fade">
      <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3>Thank you!</h3>
      </div>
      <div class="modal-body">
        <p>
          Name: <span class="name"></span><br />
          Email: <span class="email"></span><br />
          Reference code: <span class="refcode"></span><br />
          Please check your email!
        </p>
      </div>
      <div class="modal-footer">
        <!-- <a href="dashboard/client/index.html" class="btn primary">Go!</a>
        <a href="#" class="btn secondary">I can't find my reference code</a> -->
      </div>
    </div>

<script type="text/javascript">
  $(document).ready(function(){
    $('#register-submit').click(function(){

      var name = $('#register-name').val();
      var email = $('#register-email').val();

      $.post(
        '<?php echo base_url("/en/auth/register"); ?>',/*FIXME*/
        {'name' : name, 'email' : email },
        function(data){
          if(!data.error){
            var message = $('\
              <p>\
                Name: <span class="name"></span><br />\
                Email: <span class="email"></span><br />\
                Reference code: <span class="refcode"></span><br /><br />\
                Please check your email!\
              </p>');
            $('#modal-from-dom-register-message .modal-body')
              .html('').append(message);
            $('#modal-from-dom-register-message .modal-body .name')
              .html(data.name);
            $('#modal-from-dom-register-message .modal-body .email')
              .html(data.email);
            $('#modal-from-dom-register-message .modal-body .refcode')
              .html(data.refcode);
          }
          else{
            $('#modal-from-dom-register-message .modal-body p')
              .html('Whoopsies! Something\'s not right!<br />DEBUGGING: ' + data.error);
              /* FIXME */
          }
        },
        "json"
      );
    });
  });
</script>
