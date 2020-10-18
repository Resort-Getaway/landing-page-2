
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

    <p class="get-msg" style="display: none;"><?php echo $_GET['msg']; ?></p>

   <div id="verify-modal" class="modal fade">
       <div class="modal-dialog">
         <center>
           <div class="modal-content modal-content-sign-in">
               <div class="modal-body">
                  <div style="margin-top: 20px;">
                     <div class="row justify-content-center">
                        <div class="col-sm-12" style="margin-bottom:  5px;">
                          <p class="verify-msg-div"></p>
                        </div>
                        <div class="col-sm-12">
                          <a href="http://localhost/myapp/ResortGetaway-landings/landing-page-2" class="submit-btn-login btn-social">Back to main Page</a>
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

<script type="text/javascript">
  
  let msg = $('.get-msg').text();

  $("#verify-modal").modal({backdrop: 'static', keyboard: false});

  if( msg == "success"){
    $('.verify-msg-div').text("Your email was verified successfully.");
  }
  else if( msg == "AlreadyVerified"){
    $('.verify-msg-div').text("Your email already verified!");
  }
  else{
    $('.verify-msg-div').text("May be Your Token is expired! Try again with a new token.");
  }
</script>