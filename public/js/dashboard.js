$(document).ready(function(){

    $("#logout").click(function(){
        $("#submit-logout").submit();
    });

    $('#menu-toggle').click(function(){
        $('#wrapper').toggleClass('toggled');
    });

    //Input Design

    $('input').focus(function(event) {
        $(this).closest('.float-label-field').addClass('float').addClass('focus');
      })
      
      $('input').blur(function() {
        $(this).closest('.float-label-field').removeClass('focus');
        if (!$(this).val()) {
          $(this).closest('.float-label-field').removeClass('float');
        }
      });


      $('input#password-check').click(function(){
        if($(this).prop("checked") == true){
            $('input#password').attr('type', 'text');
            $('label#password-eye i').removeClass('bi-eye-slash');
            $('label#password-eye i').addClass('bi-eye');
        }
        else if($(this).prop("checked") == false){
            $('input#password').attr('type', 'password');
            $('label#password-eye i').addClass('bi-eye-slash');
            $('label#password-eye i').removeClass('bi-eye');
        }
    });

    $('input#confirm_password-check').click(function(){
        if($(this).prop("checked") == true){
            $('input#confirm_password').attr('type', 'text');
            $('label#confirm_password-eye i').removeClass('bi-eye-slash');
            $('label#confirm_password-eye i').addClass('bi-eye');
        }
        else if($(this).prop("checked") == false){
            $('input#confirm_password').attr('type', 'password');
            $('label#confirm_password-eye i').addClass('bi-eye-slash');
            $('label#confirm_password-eye i').removeClass('bi-eye');
        }
    });
    
    
});