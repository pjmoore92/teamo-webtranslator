$(document).ready(function(){
  $('#upload-submit').click(function(){

    var lang_from = $('#register-language-from-select').val();
    var lang_to = $('#register-language-to-select').val();
    var deadline = $('#datepicker').val();
    var currency = $('#register-currency-select').val();

    //File submission validation
     if ($('#filelist').html() == ''){	
	var header = $('<a href="#" class="close">&times;</a><h2>Oh dear!</h2>');

        $('#modal-from-dom .modal-header').html('').append(header);

        var message = $('\
          <p>\
          You didn\'t upload any files!<br />\
          Please go back and add 1 or more files.\
          </p>');
        $('#modal-from-dom .modal-body').html('').append(message);
     } 
       
    else{
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
   }
  });

  $(".decline-quote").click(function(){
        var jobid = $(this).parents(".accordion-body").attr("id");

        $.post(
            '/en/dashboard/decline_quote',
            {'jobid' : jobid},
            function(data){
                if(!data.error){
                    var header = $('<a href="#" class="close">&times;</a><h2>Success!</h3>');
                    var body = $('\
                        <p>\
                        Job #<span class="jobid">'+jobid+'</span>\
                        was succesfully declined.\
                        </p>');
                    var footer = $('<a href="#" class="btn close">OK</a>');
                    
                    $("#modal-from-dom .modal-header").html('').append(header);
                    $("#modal-from-dom .modal-body").html('').append(body);
                    $("#modal-from-dom .modal-footer").html('').append(footer);
                    
                    $("#modal-from-dom").modal('toggle');
                    $("#"+jobid).parent().remove();
                }
                else{
                    var header = $('<a href="#" class="close">&times;</a><h2>Oopsies!</h3>');
                    var body = $('<p>'+data.error+'<br />Try again!</p>');
                    var footer = $('<a href="#" class="btn close">OK</a>');
                    
                    $("#modal-from-dom .modal-header").html('').append(header);
                    $("#modal-from-dom .modal-body").html('').append(body);
                    $("#modal-from-dom .modal-footer").html('').append(footer);
                    
                    $("#modal-from-dom").modal('toggle');
                }
            },
            "json"
        );

        return false;
    })
});
