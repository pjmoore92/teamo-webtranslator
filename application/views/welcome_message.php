<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<!-- TODO horizontal sliding Ads a la BBC? -->
<div class="hero-unit">
<h1><?php echo lang('helloWorld') ?></h1>

<a href="/en"><img src="/images/uk.jpg"></a>
<a href="/fr"><img src="/images/france.jpg"></a>
<a href="/it"><img src="/images/italy.jpg"></a>
<p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat
a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non
commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
elit. The other services I offer are This that and This.</p>
<p><a class="btn btn-success ">Learn more &raquo;</a></p>
</div>

<!--<form>-->
<!-- Example row of columns -->
<form id="fileform" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="span3 offset1" style="text-align:center">
  <h2><?php echo lang('upload.details') ?></h2>
    <p>
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
  <div class="span3 offset1" style="text-align:center">
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
            <div id="filelist">No files added.</div>
            <br />
            <a id="pickfiles" class="btn btn-info" href="#">Select files</a> 
            <a id="uploadfiles" class="btn btn-info" href="#">Upload files</a>
        </div>
     </p>
 </div>
  <div class="span3 offset1" style="text-align:center">
    <h2><?php echo lang('upload.setreqs') ?></h2>
    <p>
        <label for="register-language-to">Language</label>
        <div class="input">
          <select class="medium" name="register-language-to" id="register-language-to-select">
            <option value="french">French</option>
          </select>
        </div>

        <label for="register-currency">Currency</label>
        <div class="input">
          <select class="medium" name="register-currency" id="register-currency-select">
            <option>GBP &pound;</option>
            <option>EUR &euro;</option>
          </select>
        </div>

        <label for="register-deadline">Deadline</label>
        <input type="text" id="datepicker">
    </p>
  </div>

<br />
<br />
<br />
  <div class="span2">&nbsp;</div>
  <div class="span2 offset1" style="text-align:center">
    <p><a id="register-submit" class="btn btn-success" href="#" data-controls-modal="modal-from-dom-register-message" 
              data-backdrop="true" data-keyboard="true">Get your quote! &raquo;</a></p>
  <!--  <input type="submit" class="btn btn-success" value="Get your quote!"> -->
  </div>
  <div class="span-one-third">&nbsp;</div>
</div>


<div id="modal-from-dom-register-message" class="modal hide fade">
  <div class="modal-header">
    <a href="#" class="close">&times;</a>
    <h2>Thank you <span class="name">.</h3>
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
</form>
</div>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/js/plupload/plupload.full.js"></script>

<script type="text/javascript">
$(function() {
	var uploader = new plupload.Uploader({
        runtimes : 'html5,html4,flash,silverlight,browserplus',
		browse_button : 'pickfiles',
		container : 'container',
		max_file_size : '15mb',
		url : '/service/upload/',
		flash_swf_url : '/js/plupload/plupload.flash.swf',
		silverlight_xap_url : '/js/plupload/plupload.silverlight.xap',
		filters : [
			{title : "Documents", extensions : "pdf,doc,docx,rtf,txt"}
		]
	});

	$('#uploadfiles').click(function(e) {
		uploader.start();
		e.preventDefault();
	});

	uploader.init();

	uploader.bind('FilesAdded', function(up, files) {
		$.each(files, function(i, file) {
			$('#filelist').append(
				'<div id="' + file.id + '">' +
				file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
			'</div>');
		});

		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('UploadProgress', function(up, file) {
		$('#' + file.id + " b").html(file.percent + "%");
	});

	uploader.bind('Error', function(up, err) {
		$('#filelist').append("<div>Error: " + err.code +
			", Message: " + err.message +
			(err.file ? ", File: " + err.file.name : "") +
			"</div>"
		);

		up.refresh(); // Reposition Flash/Silverlight
	});

	uploader.bind('FileUploaded', function(up, file) {
		$('#' + file.id + " b").html("100%");
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#register-submit').click(function(){

        var name = $('#register-name').val();
        var email = $('#register-email').val();
        var lang_from = $('#register-language-from-select').val();
        var lang_to = $('#register-language-to-select').val();

        $.post(
            '<?php echo base_url("/en/auth/register"); ?>',/*FIXME*/
            {'name' : name, 'email' : email, 'lang_from':lang_from, 'lang_to':lang_to },
            function(data){
                console.log(data);
                
                if(!data.error){
                    var message = $('\
                        <p>\
                        Name: <span class="name"></span><br />\
                        Email: <span class="email"></span><br /><br />\
                        Please check your email!\
                        </p>');
                    $('#modal-from-dom-register-message .modal-body')
                        .html('').append(message);
                    $('#modal-from-dom-register-message .modal-body .name')
                        .html(data.name);
                    $('#modal-from-dom-register-message .modal-body .email')
                        .html(data.email);

                    jobID = data.jobid;
                    $('#filelist').clone().appendTo('#modal-from-dom-register-message .modal-footer');
                    $('#uploadfiles').trigger('click');
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


