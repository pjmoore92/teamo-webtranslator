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
    dateFormat: "dd-mm-yy",
    minDate: +1
  });

});
