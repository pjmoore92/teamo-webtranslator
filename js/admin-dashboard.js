					$(document).ready(function(){
						$(".send-quote").click(function(){
							var jobid = $(this).parents(".accordion-body").attr("id");
							var quote = $(this).siblings(":text").val();

							console.log("jobID: " + jobid + "; quote: " + quote);

							$.post(
								'/en/dashboard/send_quote',
								{'jobid' : jobid, 'quote' : quote },
								function(data){
									if(!data.error){
										var header = $('<a href="#" class="close">&times;</a><h2>Success!</h3>');
										var body = $('\
					                        <p>\
					                        Job #<span class="jobid">'+jobid+'</span>\
					                        was succesfully quoted <span class="quote">'+quote+'</span>.<br />\
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
										// console.log("AJAX error: " + data.error);
									}
								},
								"json"
							);

							return false;
						})

						$(".update-quote").click(function(){
							var jobid = $(this).parents(".accordion-body").attr("id");
							var quote = $(this).siblings(":text").val();

							console.log("jobID: " + jobid + "; quote: " + quote);

							$.post(
								'/en/dashboard/send_quote',
								{'jobid' : jobid, 'quote' : quote },
								function(data){
									if(!data.error){
										var header = $('<a href="#" class="close">&times;</a><h2>Success!</h3>');
										var body = $('\
					                        <p>\
					                        Job #<span class="jobid">'+jobid+'</span>\
					                        was succesfully quoted <span class="quote">'+quote+'</span>.<br />\
					                        </p>');
										var footer = $('<a href="#" class="btn close">OK</a>');
										
										$("#modal-from-dom .modal-header").html('').append(header);
										$("#modal-from-dom .modal-body").html('').append(body);
										$("#modal-from-dom .modal-footer").html('').append(footer);

										$("#"+jobid+" dd .quote").html('').html(quote);
										
										$("#modal-from-dom").modal('toggle');
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