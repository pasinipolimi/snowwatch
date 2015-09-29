<?php    
    require_once 'php/header.php'; 
    require_once("php/classes/Registration.class.php");
    if ($login->isUserLoggedIn() == true) {
		header( 'Location: home.php' ) ;  
    } else {
		$registration = new Registration();
        if ($registration->successful == true){
            header( 'Location: home.php' );
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include 'php/navbar.php'; ?>
    
    
    <div class="container swcontainer">

      
        <h1><?php echo $i18n->translate("REGISTER");?></h1>
        <?php
            // show potential errors / feedback (from registration object)
            if (isset($registration)) {
                if ($registration->errors) {
                    foreach ($registration->errors as $error) {
                        echo $i18n->translate($error);
                    }
                }
            }
        ?>

        <!-- register form -->
        <form method="post" action="register.php" name="registerform">

            <!-- the user name input field uses a HTML5 pattern check -->
            <label for="login_input_username"><?php echo $i18n->translate("REGISTRATION_USERNAME");?></label>
            <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

            <!-- the email input field uses a HTML5 email type check -->
            <label for="login_input_email"><?php echo $i18n->translate("REGISTRATION_EMAIL");?></label>
            <input id="login_input_email" class="login_input" type="email" name="user_email" required />

            <label for="login_input_password_new"><?php echo $i18n->translate("REGISTRATION_PASSWORD");?></label>
            <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

            <label for="login_input_password_repeat"><?php echo $i18n->translate("REGISTRATION_REPEAT_PASSWORD");?></label>
            <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
            <input type="submit"  name="register" value="<?php echo $i18n->translate("REGISTER");?>" />

        </form>      

    </div><!-- /.container -->
    <?php include 'php/dependencies/commonsJS.php'; ?>
    
  </body>
</html>