<?php require_once("php/functions.php"); ?>

<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="sw-profile-icon" src="dist/img/icon-profile.png"><?php echo $i18n->translate("LOG_IN_OR_SIGN_UP");?><span class="caret"></span></a>
<ul class="dropdown-menu sw-dropdown-dark" style="width: 100%;">
    <li>
        <!-- login form box -->
        <form method="post" action="<?php echo fullPageUrl() ?>" name="loginform">

            <div class="form-group row row-centered">                            
                <input id="login_input_username" class="login_input" type="text" name="user_name" placeholder="<?php echo $i18n->translate("USERNAME_OR_EMAIL");?>" required />
            </div>

            <div class="form-group row row-centered">                            
                <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" placeholder="<?php echo $i18n->translate("PASSWORD");?>" required />
            </div>

            <?php
                // show potential error / feedback (from login object)
                if (isset($login) && $login->error) {
                    echo "<div id='login-error' class='row-centered alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ". $i18n->translate($login->error) ."</div>";
                    echo "<script>$('#dropdown-menu').addClass('open');</script>";
                }
            ?>

            <div class="form-group row row-centered">                            
                <input type="submit"  name="login" class="btn btn-lg btn-sw" value="<?php echo $i18n->translate("LOG_IN");?>" />
            </div>
        </form>
    </li>
    <li><p class="row row-centered"><?php echo $i18n->translate("OR");?></p></li>
    <li>
        <div class="form-group row row-centered">                            
            <a class="btn btn-lg btn-sw" href="register.php"><?php echo $i18n->translate("SIGN_UP");?></a>
        </div>
    </li>
</ul>