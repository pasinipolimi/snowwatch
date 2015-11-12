<?php
  //Gets the current URL without the lang parameter
  $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  list($url,) = explode('?lang=', $url);
  list($url,) = explode('&lang=', $url);
  $query = parse_url($url, PHP_URL_QUERY);
  if ($query) {
      $url .= '&';
  } else {
      $url .= '?';
  }
?>



<nav class="navbar sw-navbar-dark-top">
    <div class="container">
        <span class="col-xs-2" style="position:absolute">
            <a href="<?php echo $url ?>lang=en">EN</a> / <a href="<?php echo $url ?>lang=it">IT</a>
        </span>
        <span class="sw-nav-logo">
            <a href="index.php"><img src="dist/img/logo.png"></a>
        </span>
        <!--<ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        </ul>-->
        <ul class="nav navbar-nav navbar-right row-centered col-xs-3">
            <li id="dropdown-menu" class="dropdown" style="width:100%;">              
            <?php            
              if ($login->isUserLoggedIn() == true) {
                  // the user is logged in
                  include("php/logged_in.php");
              } else {
                  // the user is not logged in
                  include("php/not_logged_in.php");
              }
            ?>
            </li>
        </ul>
    </div>
</nav>