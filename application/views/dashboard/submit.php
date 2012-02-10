        <div class="page-header">
          <h1>Client dashboard <small>Submit new job</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>

          <!--<div class="alert-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p><strong>Update:</strong> Joelle has sent you the quote for Docname3. Please review it!</p>
          </div>-->

          <div class="alert-message block-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p>
              <strong>Update:</strong> Joelle has sent you a quote for <strong>Docname2</strong>:
              It will cost &pound;50 and it will be ready on the <time>2011-09-17</time>.
            </p>
            <div class="alert-actions">
              <a class="btn small success" href="#">I accept!</a>
              <a class="btn small danger" href="#">No, thanks!</a>
            </div>
          </div>

        </div>
        <div class="row">
             <form id="fileform" enctype="multipart/form-data">
          <div class="span-one-third" style="text-align:center">
            <h2><?php echo lang('upload.browse') ?></h2>
             <!--<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
             <p>
                <label for="upload-language-from">Source language</label>
                <div class="input">
                  <select class="medium" name="upload-language-from" id="upload-language-from-select">
                    <option>English</option>
                    <option>French</option>
                    <option>Italian</option>
                  </select>
                </div>

              </p>
              <p>
                  <label for="upload-documents-upload">Documents</label>
                  <div class="input">
                  <input class="input-file" id="upload-documents-upload" name="upload-documents-upload" type="file">
                  <!--<input class="input-file" id="fileInput2" name="fileInput" type="file">
                  <input class="input-file" id="fileInput3" name="fileInput" type="file">-->
                  </div>
             </p>
         </div>
          <div class="span-one-third" style="text-align:center">
            <h2><?php echo lang('upload.setreqs') ?></h2>
            <!--<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.</p>-->
            <p>
                <label for="upload-language-to">Language</label>
                <div class="input">
                  <select class="medium" name="upload-language-to" id="upload-language-to-select">
                    <option>English</option>
                    <option>French</option>
                    <option>Italian</option>
                  </select>
                </div>

                <label for="upload-currency">Currency</label>
                <div class="input">
                  <select class="medium" name="upload-currency" id="upload-currency-select">
                    <option>GBP &pound;</option>
                    <option>EUR &euro;</option>
                  </select>
                </div>
            </p>
          </div>
          <div class="span-one-third" style="text-align:center">
            <p><a id="upload-submit" class="btn" href="#" data-controls-modal="modal-from-dom-upload-message" 
              data-backdrop="true" data-keyboard="true">Upload!</a></p>
          </div>
            </form>
        </div>
      </div>
    
    <div id="modal-from-dom-upload-message" class="modal hide fade">
      <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3>Thank you!</h3>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <!-- <a href="dashboard/client/index.html" class="btn primary">Go!</a>
        <a href="#" class="btn secondary">I can't find my reference code</a> -->
      </div>
    </div>

      <script type="text/javascript">
        $(document).ready(function(){
          $('#upload-submit').click(function(){

            var toLanguage = $('#upload-language-to-select').val();
            var fromLanguage = $('#upload-language-from-select').val();

            $.post(
              '<?php echo base_url("/en/dashboard/add_job"); ?>',/*FIXME*/
              {'toLanguage' : toLanguage, 'fromLanguage' : fromLanguage },
              function(data){
                if(!data.error){
                  var message = $('\
                    <p>\
                      <h3>'+data.response+'</h3>\
                      From language: <span class="fromLanguage"></span><br />\
                      To language: <span class="toLanguage"></span><br />\
                    </p>');
                  $('#modal-from-dom-register-message .modal-body')
                    .html('').append(message);
                  $('#modal-from-dom-register-message .modal-body .fromLanguage')
                    .html(fromLanguage);
                  $('#modal-from-dom-register-message .modal-body .toLanguage')
                    .html(toLanguage);
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
