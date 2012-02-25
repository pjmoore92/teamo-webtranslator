$(document).ready(function(){
  jobID = -1;
  $('#upload-submit').click(function(){

        var lang_from = $('#register-language-from-select').val();
        var lang_to = $('#register-language-to-select').val();
        var deadline = $('#datepicker').val();
        var currency = $('#register-currency-select').val();

    $.post(
      'http://alasdaircampbell.com/en/dashboard/add_job',/*FIXME*/
      {
        'lang_from':lang_from,
        'lang_to':lang_to,
        'deadline' : deadline,
        'currency' : currency
      },
            function(data){
                console.log(data);

                if(!data.error){
                    var header = $('\
                      <a href="#" class="close">&times;</a>\
                      <h2>Thank you!</h2>\
                    ');

                    $('#modal-from-dom .modal-header')
                        .html('').append(header);

                    var message = $('\
                        <p>\
                        Your job is pending and we will get back to you shortly with a quote.<br />\
                        </p>');
                    $('#modal-from-dom .modal-body')
                        .html('').append(message);

                    jobID = data.id;
                    $('#filelist').clone().appendTo('#modal-from-dom .modal-footer');
                    $('#uploadfiles').trigger('click');
                }
                else{
                    var header = $('<a href="#" class="close">&times;</a><h2>Whoopsies!</h2>');
                    $('#modal-from-dom .modal-header').html('').append(header);
                    
                    var message = $(data.error);
                    $('#modal-from-dom .modal-body').html('').append(message);
                    /* FIXME */

                    var footer= $('<a data-dismiss="modal" class="btn btn-primary">OK</a>');
                    $('#modal-from-dom .modal-footer').html('').append(footer);
                }
            },
      "json"
    );
  });
});