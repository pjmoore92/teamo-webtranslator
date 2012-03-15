var jobID = -1;

$(document).ready(function(){
    $('#register-submit').click(function(){
	
	var location = $('#register-location').val();
        var name = $('#register-name').val();
        var email = $('#register-email').val();
        var lang_from = $('#register-language-from-select').val();
        var lang_to = $('#register-language-to-select').val();
        var deadline = $('#datepicker').val();
        var currency = $('#register-currency-select').val();
	
	//Spam bot detection
	if( location != ''){
	
		var header = $('<a href="#" class="close">&times;</a><h2>Oh dear!</h2>');

                    $('#modal-from-dom-register-message .modal-header')
                        .html('').append(header);

                    var message = $('\
                        <p>\
                        It looks like you are a spam bot.<br />\
                        Please vacate the premises immediately! (<strong><span class="email"></span><strong>)\
                        </p>');
                    $('#modal-from-dom-register-message .modal-body')
                        .html('').append(message);	
	}
	//File submission validation
	else if ($('#filelist').html() == ''){	
		var header = $('<a href="#" class="close">&times;</a><h2>Oh dear!</h2>');

                    $('#modal-from-dom-register-message .modal-header')
                        .html('').append(header);

                    var message = $('\
                        <p>\
                        You didn\'t upload any files!<br />\
                        Please go back and add 1 or more in order to register.\
                        </p>');
                    $('#modal-from-dom-register-message .modal-body')
                        .html('').append(message);
	}
	else{
        $.post(
            'http://alasdaircampbell.com/en/auth/register',/*FIXME*/
            {
              'name' : name,
              'email' : email,
              'lang_from':lang_from,
              'lang_to':lang_to,
              'deadline' : deadline,
              'currency' : currency },
            function(data){
                console.log(data);

                if(!data.error){
                    var header = $('<a href="#" class="close">&times;</a><h2>Thank you, <span class="name"></span>!</h2>');

                    $('#modal-from-dom-register-message .modal-header')
                        .html('').append(header);

                    var message = $('\
                        <p>\
                        We will get to you shortly.<br />\
                        Please check your e-mail! (<strong><span class="email"></span><strong>)\
                        </p>');
                    $('#modal-from-dom-register-message .modal-body')
                        .html('').append(message);
                    $('#modal-from-dom-register-message .name')
                        .html(data.name);
                    $('#modal-from-dom-register-message .modal-body .email')
                        .html(data.email);

                    var footer = $('<a href="#" class="">I can\'t find my reference code</a>');
		    
                    jobID = data.job.id;
                    $('#filelist').clone().appendTo('#modal-from-dom-register-message .modal-footer');
                    $('#uploadfiles').trigger('click');
                }
                else if(data.error == 'already_in_use'){
                    var header = $('<a href="#" class="close">&times;</a><h2>Whoopsies!</h2>');
                    $('#modal-from-dom-register-message .modal-header')
                      .html('').append(header);
                    
                    var message = $('\
                        <p>The email address <strong><span class="email"></span></strong>\
                        is already in use here!</p>');
                    $('#modal-from-dom-register-message .modal-body p')
                      .html('').append(message);
                    $('#modal-from-dom-register-message .modal-body .email')
                        .html(email);

                    var footer = $('\
                        <a class="">Login</a> or \
                        <a class="">get a new reference code.</a>\
                        <a class="btn btn-primary">Close</a>');
                    $('#modal-from-dom-register-message .modal-footer')
                        .html('').append(footer);
                }
                else{
                    var header = $('<a href="#" class="close">&times;</a><h2>Whoopsies!</h2>');
                    $('#modal-from-dom-register-message .modal-header').html('').append(header);
                    
                    var message = $('Whoopsies! Something\'s not right!<br />' + data.error);
                    $('#modal-from-dom-register-message .modal-body p').html('').append(message);
                    /* FIXME */

                    var footer= $('<a data-dismiss="modal" class="btn btn-primary">OK</a>');
                    $('#modal-from-dom-register-message .modal-footer').html('').append(footer);
                }
            },
                "json"
            );
      }
    });
});
