$(document).ready(function(){


  /**
   * 
   */
  $('#login-submit').click(function(){
    var email = $("#login-email").val();
    var pass = $('#login-ref-code').val();
    
    $.post(
      '/en/auth/login',
      {
        'login' : email,
        'password' : pass,
        'remember' : 0
      }
    );
  })
  /* end of login-submit */

  /**
   * 
   */
  $("#datepicker").datepicker({
    showOn: "both",
    buttonImage: "images/calendar.gif",
    buttonImageOnly: true
  });

});