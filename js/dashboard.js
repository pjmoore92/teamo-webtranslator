$(document).ready(function(){
	$(".toggle-accordion")
		.css('cursor', 'pointer')
		.live(
			"click",
			function(){
				var id = $(this).data("jobid");
				$('div#' + id).collapse('toggle');
			});
});