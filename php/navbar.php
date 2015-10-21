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
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">SnowWatch Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav"> 
            <li id="mappage"><a href="map.php"><?php echo $i18n->translate("MAPS");?></a></li>
            <li id="gallerypage"><a href="gallery.php"><?php echo $i18n->translate("GALLERY");?></a></li>
            <?php if ($login->isUserLoggedIn() == true) {
              echo "<li id='uploadpage'><a href='upload.php'>". $i18n->translate("UPLOAD") ."</a></li>";
            } ?>
            <li id="aboutpage"><a href="about.php"><?php echo $i18n->translate("ABOUT");?></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              
              <!--<li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>-->

              <a href="<?php echo $url ?>lang=en">EN</a>/
              <a href="<?php echo $url ?>lang=it">IT</a>
				
          <?php            
            if ($login->isUserLoggedIn() == true) {
                // the user is logged in
                include("php/logged_in.php");
            } else {
                // the user is not logged in
                include("php/not_logged_in.php");
            }
          ?>
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>
