$(function() {

  var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,html4',
    browse_button : 'pickfiles',
    container : 'container',
        unique_names : 'true',
    max_file_size : '15mb',
    url : '/en/service/upload/',
    flash_swf_url : '/js/plupload/plupload.flash.swf',
    silverlight_xap_url : '/js/plupload/plupload.silverlight.xap',
    filters : [
      {title : "Documents", extensions : "pdf,doc,docx,rtf,txt"}
            ],
        multipart_params : { job : -2, trans : -2 }
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

  uploader.bind('BeforeUpload', function(up, file) {
    up.settings.multipart_params = { job : jobID, trans : transID };
  });

  uploader.bind('Error', function(up, err) {
    $('#filelist').append("<div>" + err.message +
      (err.file ? err.file.name : "") +
      "</div>"
    );

    up.refresh(); // Reposition Flash/Silverlight
  });

  uploader.bind('FileUploaded', function(up, file) {
    $('#' + file.id + " b").html("100%");
  });
});
