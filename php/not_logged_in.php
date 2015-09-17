<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
}
?>

<!-- login form box -->
<form method="post" action="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']; ?>" name="loginform">

    <label for="login_input_username" style="color: #9d9d9d;"><?php echo $i18n->translate("USERNAME");?></label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />

    <label for="login_input_password" style="color: #9d9d9d;"><?php echo $i18n->translate("PASSWORD");?></label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

    <input type="submit"  name="login" value="<?php echo $i18n->translate("LOGIN");?>" />

</form>

<a href="register.php">Register new account</a>
