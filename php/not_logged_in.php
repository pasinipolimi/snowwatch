<?php require_once("php/functions.php"); ?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="sw-profile-icon" src="dist/img/icon-profile.png">Log in or Sign up<span class="caret"></span></a>
<ul class="dropdown-menu sw-dropdown-dark" style="width: 100%;">
    <li>
        <!-- login form box -->
        <form method="post" action="<?php echo fullPageUrl() ?>" name="loginform">

            <div class="form-group row row-centered">                            
                <input id="login_input_username" class="login_input" type="text" name="user_name" placeholder="Username or e-mail" required />
            </div>

            <div class="form-group row row-centered">                            
                <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" placeholder="Password" required />
            </div>

            <?php
                // show potential errors / feedback (from login object)
                if (isset($login) && $login->errors) {
                    foreach ($login->errors as $error) {
                        echo "<div id='login-error' class='row-centered alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> $error</div>";
                    }
                    echo "<script>$('#dropdown-menu').addClass('open');</script>";
                }
            ?>

            <div class="form-group row row-centered">                            
                <input type="submit"  name="login" class="btn btn-lg btn-sw" value="<?php echo $i18n->translate("LOGIN");?>" />
            </div>
        </form>
    </li>
    <li><p class="row row-centered">or</p></li>
    <li>
        <div class="form-group row row-centered">                            
            <a class="btn btn-lg btn-sw" href="register.php">SIGN UP</a>
        </div>
    </li>
</ul>        
 





