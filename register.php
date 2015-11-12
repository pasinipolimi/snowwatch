<?php    
    require_once 'php/header.php'; 
    require_once("php/classes/Registration.class.php");
    if ($login->isUserLoggedIn() == true) {
		header( 'Location: index.php' ) ;  
    } else {
		$registration = new Registration();
        if ($registration->successful == true){
            header( 'Location: index.php' );
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>SnowWatch Portal</title>

    
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/commonsJS.php'; ?>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include 'php/navbar_header.php'; ?>
    <?php include 'php/navbar_menu_dark.php'; ?>    
    
    <img class="sw-upload-jumbotron" src="dist/img/background-upload.png">
    
    <div class="container sw-upload-content ">
      
        <div class="col-sm-offset-5">
            <h1><?php echo $i18n->translate("SIGN_UP_TITLE");?></h1>
        </div>

        <div class="col-sm-6 col-sm-offset-4">   

            <form method="post" action="register.php" name="registerform">

                <div class="control-group">
                  <!-- Username -->
                  <label class="control-label" for="login_input_username"><?php echo $i18n->translate("USERNAME");?></label>
                  <div class="controls">
                    <input id="login_input_username" class="login_input input-xlarge" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required >
                    <p class="help-block"><?php echo $i18n->translate("USERNAME_HELP");?></p>
                  </div>
                </div>
             
                <div class="control-group">
                  <!-- E-mail -->
                  <label class="control-label" for="login_input_email"><?php echo $i18n->translate("EMAIL");?></label>
                  <div class="controls">
                    <input id="login_input_email" class="login_input input-xlarge" type="email" name="user_email" required />
                    <p class="help-block"><?php echo $i18n->translate("EMAIL_HELP");?></p>
                  </div>
                </div>
             
                <div class="control-group">
                  <!-- Password-->
                  <label class="control-label" for="login_input_password_new"><?php echo $i18n->translate("PASSWORD");?></label>
                  <div class="controls">
                    <input id="login_input_password_new" class="login_input  input-xlarge" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
                    <p class="help-block"><?php echo $i18n->translate("PASSWORD_HELP");?></p>
                  </div>
                </div>
             
                <div class="control-group">
                  <!-- Password -->
                  <label class="control-label"  for="login_input_password_repeat"><?php echo $i18n->translate("PASSWORD_CONFIRM");?></label>
                  <div class="controls">
                    <input id="login_input_password_repeat" class="login_input  input-xlarge" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                    <p class="help-block"><?php echo $i18n->translate("PASSWORD_CONFIRM_HELP");?></p>
                  </div>
                </div>
             
               <?php
                    // show potential errors / feedback (from registration object)
                    if (isset($registration)) {
                        if ($registration->errors) {
                            foreach ($registration->errors as $error) {
                                // echo"<div class='col-sm-offset-4'>".$i18n->translate($error)."</div>";
                                echo "<div class='row-centered alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ".$i18n->translate($error)."</div>";

                            }
                        }
                    }
                ?>

                <div class="control-group">
                  <!-- Button -->
                  <div class="controls">
                    <input type="submit" name="register" class="btn btn-sw" value="<?php echo $i18n->translate("SIGN_UP");?>" />
                  </div>
                </div>
            </form>      
        </div>

    </div><!-- /.container -->
    <br>
    <br>
    <br>
    <br>
    <?php include 'php/footer.php'; ?>

  </body>
</html>