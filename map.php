<?php require_once 'php/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SnowWatch Portal</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500,700" rel="stylesheet" type="text/css">
      
    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/filtersCss.php'; ?>
    <link href="css/mappadada.css" rel="stylesheet">
  
    <?php include 'php/dependencies/commonsJS.php'; ?>
    <?php include 'php/dependencies/filtersJS.php'; ?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiUJC2WiuszJkkHhoqH4nXHBs3skyr62o&libraries=geometry&sensor=false"></script>
    <script src="js/worldMap.js"></script>
    <script src="libs/richmarker.js"></script>

    <style>

      .thumbdiv_big {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            width:100px; 
            height:100px;
            z-index: 2;
            border:2px solid #fff;
          }
          .thumbdiv_small {
        
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            width:40px; 
            height:40px;
            z-index: 1;
            border:2px solid #fff;
          } 
    </style>

    <link href="skin/square/red.css" rel="stylesheet">
  </head>
<body class="bootstrap-default">

  
  <?php include 'php/navbar_header.php'; ?>
  <?php include 'php/navbar_menu_dark.php'; ?>
  <script>$("#mappage").addClass("active");</script>
    
  <!--<div class="starter-template">
 <div class="container starter-template2" > -->
    <div class="container container-fixed-top-padding">
      <div class="row">
        <div class="col-md-12">
          <div id="main-content" role="main">
            <div class="container_12">
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div id="map-canvas"></div>

    <div class="container swcontainerleft" > 
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-xs-offset-1">
          <?php include 'php/filters.php'; ?>
        </div>
      </div>
    </div>
        
  <script src="js/gallery2.js"></script>
    <script>
        function reloadGallery(){
            reloadMap($('#map-canvas'));
        }
  </script>

</body>
</html>