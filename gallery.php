<?php session_start(); 
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<html lang="en">
<head>
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta charset="utf-8">
    <title>Snowwatch Image Gallery</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/filtersCss.php'; ?>

    <link rel="stylesheet" href="css/gallery.css">

    <style>
      #format { margin-top: 2em; }
    </style>
    
</head>
<body>

    <?php include 'php/navbar.php'; ?>

    <div class="container swcontainerleft" > 
        <div class="row">
            <div class="col-md-9 well galleryContainer">
                <?php 
                    include 'php/slideshow.php'; 
                    echo generateSlideshow("links1", null);
                ?>
            </div>
            <div class="col-md-3">
                <?php include 'php/filters2.php'; ?>
            </div>
      </div>

    </div>



  <?php include 'php/dependencies/commonsJS.php'; ?>
  <?php include 'php/dependencies/filtersJS.php'; ?>
  
  
  <script src="js/gallery2.js"></script>
  <script>
    $("#gallerypage").addClass("active");
    $(window).load(function () {  
      //uploadGallery(200, computeFilterString(), "#links1", "");
      reloadGallery();
    })
    
    function reloadGallery(){
      uploadGallery(200, computeFilterString(), "#links1", "");
    }
  </script>
  
  

</body> 
</html>
