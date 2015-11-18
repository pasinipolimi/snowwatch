<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta charset="utf-8">
    <?php include 'php/favicons.php'; ?>
    <title><?php echo $i18n->translate("IMAGE_GALLERY");?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/filtersCSS.php'; ?>

    <script>
        var lang="<?php echo $i18n->getAppliedLang();?>"
    </script>

    <?php include 'php/dependencies/commonsJS.php'; ?>
    <?php include 'php/dependencies/filtersJS.php'; ?>

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
            <div class="col-md-9 galleryContainer">
                <?php 
                    include 'php/slideshow.php'; 
                    echo generateSlideshow("links1", null);
                ?>

            </div>
            
              <?php include 'php/filters.php'; ?>
            
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
