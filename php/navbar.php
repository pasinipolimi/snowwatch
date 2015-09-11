<?php            
    // load the login class
    require_once("php/classes/Login.php");

    // create a login object. when this object is created, it will do all login/logout stuff automatically
    $login = new Login();
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
          <a class="navbar-brand" href="home.php">SnowWatch Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav"> 
            <li id="mappage"><a href="map.php">Maps</a></li>
            <li id="gallerypage"><a href="gallery.php">Gallery</a></li>
            <?php if ($login->isUserLoggedIn() == true) {
              echo "<li id='uploadpage'><a href='upload.php'>Upload</a></li>";
            } ?>
            <li id="aboutpage"><a href="about.php">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              
              <!--<li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>-->
				
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
