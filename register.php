<?php    
    session_start(); 
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.
    // load the login class
    require_once("php/classes/Login.php");

    // create a login object. when this object is created, it will do all login/logout stuff automatically
    $login = new Login();

    if ($login->isUserLoggedIn() == true) {
        // the user is logged in
		header( 'Location: home.php' ) ;  
    } else {
        // the user is not logged in
        // load the registration class
		require_once("php/classes/Registration.php");
		// create the registration object. when this object is created, it will do all registration stuff automatically
		// so this single line handles the entire registration process.
		$registration = new Registration();
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

      
        <h1>Register</h1>
        <?php
            // show potential errors / feedback (from registration object)
            if (isset($registration)) {
                if ($registration->errors) {
                    foreach ($registration->errors as $error) {
                        echo $error;
                    }
                }
                if ($registration->messages) {
                    foreach ($registration->messages as $message) {
                        echo $message;
                    }
                }
            }
        ?>

        <!-- register form -->
        <form method="post" action="register.php" name="registerform">

            <!-- the user name input field uses a HTML5 pattern check -->
            <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
            <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />

            <!-- the email input field uses a HTML5 email type check -->
            <label for="login_input_email">User's email</label>
            <input id="login_input_email" class="login_input" type="email" name="user_email" required />

            <label for="login_input_password_new">Password (min. 6 characters)</label>
            <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

            <label for="login_input_password_repeat">Repeat password</label>
            <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
            <input type="submit"  name="register" value="Register" />

        </form>      

    </div><!-- /.container -->
    <?php include 'php/dependencies/commonsJS.php'; ?>
    
  </body>
</html>