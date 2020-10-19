
<!DOCTYPE html>
<html lang="es">

   <head>
      <title>Resort Getaway | ¡¡Quiero ir a Cancún o Punta Cana !! Oferta todo incluido ahora 2020-2021</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="¡¡Quiero ir a Cancún o Punta Cana !! Oferta todo incluido ahora 2020-2021">
      <meta name="author" content="Resort Getaway">

      <link rel="shortcut icon" href="favicon.png">
      <!-- Theme CSS -->
      <link rel="stylesheet" href="assets/css/main.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

   </head>
   
   <body ng-app="landingTwo" ng-controller="landingCtrl">

    <p class="get-token" style="display: none;"><?php echo $_GET['token']; ?></p>

   <!--login popup page-->
   <div id="reset-password-modal" class="modal fade">
       <div class="modal-dialog">
         <center>
           <div class="modal-content modal-content-sign-in">
               <div class="modal-body">
                  <div style="margin-top: 20px;">
                     <div class="row justify-content-center">
                        <div style="margin-bottom:  5px;">
                          <p class="update-password-mail-msg"></p>
                        </div>
                        <div>
                          <a href="http://localhost/myapp/ResortGetaway-landings/landing-page-2" class="submit-btn-login btn-social back-to-main">Back to main Page</a>
                        </div>
                        <div class="col-sm-12 center update-user-password-div">
                           <p class="p-normal-txt">Update your password from here</p>

                           <hr>

                           <div style="margin-bottom:  5px;">
                                <p class="update-now-error-msg"></p>
                            </div>
                            <div style="margin-bottom:  5px;">
                                <div class="right-inner-addon input-container">
                                    <p><i class="fa fa-envelope"></i></p>
                                    <input type="text" class="form-input-field user-email-update" placeholder="User Email" />
                                </div>
                            </div>
                           <div style="margin-bottom:  5px;">
                                <div class="right-inner-addon input-container">
                                    <p><i class="fa fa-unlock-alt"></i></p>
                                    <input type="password" class="form-input-field user-password-update" placeholder="New Password" />
                                </div>
                            </div>
                            <div style="margin-bottom:  5px;">
                                <div class="right-inner-addon input-container">
                                    <p><i class="fa fa-unlock-alt"></i></p>
                                    <input type="password" class="form-input-field user-confirm-password-update" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div style="margin-bottom:  5px;">
                               <div class="g-recaptcha g-recaptcha-sign-in" data-sitekey="6LcVtdQZAAAAAJR7pz8NQ_3Pjc4yrrt28e8tt0zZ"></div>
                            </div>
                            <div style="margin-bottom:  5px;">
                                <p class="captcha-forgot-error">Please verify that your not a robot!</p>
                            </div>
                            <div>
                               <a class="submit-btn-login btn-social update-password-click">Update password</a>
                            </div>
                            <div  class="margin-bottom-sign-in">
                               <!-- <p style="color: #888;">Not a member? <a class="send-to-join-now">Join Now</a></p> -->
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
           </div>
        </center>
       </div>
   </div>

   </body>
</html>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src='https://www.google.com/recaptcha/api.js'></script>

<script defer src="assets/fonts/fontawesome-free-5.14.0-web/js/all.min.js"></script>


<script type="text/javascript">

  //email validation
  function validateEmail(email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      if( !emailReg.test( email ) || email.length == 0 ) {
          return false;
      } else {
          return true;
      }
  }

  $("#reset-password-modal").modal({backdrop: 'static', keyboard: false});

  $('.update-password-click').click(function(){

    $('.captcha-forgot-error').hide();
    $('.update-password-click').text("Processing....");
    $('.update-password-click').addClass( "disableClick" );

    //get values
    let user_email = $('.user-email-update').val();
    let user_password = $('.user-password-update').val();
    let user_confirm_password = $('.user-confirm-password-update').val();
    let user_token = $('.get-token').text();

    console.log(user_token)
    let error_list = [];

    if(!user_email){
      error_list.push("Email Required!");
    }
    else if(!validateEmail(user_email)){
      error_list.push("Enter valid Email!");
    }
    else if( user_email.length>=100 ){
      error_list.push("Email must be less than 100 characters!");
    }

    if(!user_password){
      error_list.push("Password Required!");
    }
    else if( user_password.length<=5 ){
      error_list.push("Password must be greater than 6 characters!");
    }

    if(!user_confirm_password){
      error_list.push("Confirm Password Required!");
    }
    else if( user_password != user_confirm_password ){
      error_list.push("Password mismatch!");
    }

    if(error_list.length>0){
      $('.update-now-error-msg').text(error_list);
      $('.update-now-error-msg').show();

      $('.update-password-click').text("Update password");
      $('.update-password-click').removeClass( "disableClick" );
    }
    else{ 
      $('.update-now-error-msg').hide();

      var response = grecaptcha.getResponse();
      if(response.length == 0) 
      { 
        $('.captcha-forgot-error').show();

        $('.update-password-click').text("Update password");
        $('.update-password-click').removeClass( "disableClick" );
        return false;
      }
      else{
        $('.captcha-forgot-error').hide();

        $.ajax({
            url: 'http://localhost/myapp/ResortGetaway-backend/public/api/password/reset',
            type: 'POST',
            data: {
                email: user_email,
                password: user_password,
                password_confirmation: user_confirm_password,
                token: user_token
            },
            success: function(msg) {

              console.log(!msg["email"])
              console.log(user_email,user_password,user_confirm_password)

              $('.update-password-click').text("Update password");
              $('.update-password-click').removeClass( "disableClick" );

              if( msg["email"] ){
                $('.update-now-error-msg').text(msg["email"]);
                $('.update-now-error-msg').show();
              }
              else if( msg["status"] ){
                $('.update-now-error-msg').hide();

                $('.update-password-mail-msg').text("Your password successfully updated.");
                $('.update-password-mail-msg').show();
                $('.back-to-main').show();

                $('.user-email-update').val("");
                $('.user-password-update').val("");
                $('.user-confirm-password-update').val("");

                $('.update-user-password-div').hide();

              }
              else{
                $('.update-now-error-msg').hide();
                console.log(msg)
              }
            },
            error: function(xhr, status, error) {
              console.log(status);
            }
        });
      }

    }

  });
</script>
