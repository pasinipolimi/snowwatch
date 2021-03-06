<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta charset="utf-8">
    <title>SnowWatch Portal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/filtersCss.php'; ?>
    <?php include 'php/dependencies/commonsJS.php'; ?>
    <?php include 'php/dependencies/filtersJS.php'; ?>
    <?php require_once("php/client_translator.php"); ?>

    <link rel="stylesheet" href="css/gallery.css">

    <style>
      #format { margin-top: 2em; }
    </style>
    
</head>
<body>

    <?php include 'php/navbar_header.php'; ?>
    <?php include 'php/navbar_menu_dark.php'; ?>

    <div class="container swcontainerleft" > 
        <div class="row">
            <div class="col-md-8 well galleryContainer">
                <?php 
                    include 'php/slideshow.php'; 
                    echo generateSlideshow("links1", null);
                ?>
            </div>
            <div class="col-xs-offset-1 ">
              <?php include 'php/filters.php'; ?>
            </div>
      </div>

    </div>


  
  
  <script src="js/gallery2.js"></script>
  <script>
    $("#gallerypage").addClass("active");
    $(window).load(function () {  
      //uploadGallery(200, computeFilterString(), "#links1", "");
      reloadGallery();
    })
    
    function reloadGallery(){
      uploadGallery(100, computeFilterString(), "#links1", "");
    }
  </script>
  
  <?php include 'php/footer.php'; ?>

</body> 
</html>
