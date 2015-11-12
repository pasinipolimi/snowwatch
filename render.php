<?php 
    require_once 'php/header.php';
    if ($login->isUserLoggedIn() == false) {
        header( 'Location: index.php' ) ;  
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">    
    <?php include 'php/favicons.php'; ?>

    <title><?php echo $i18n->translate("PHOTO_DETAIL");?></title>


    <?php include 'php/dependencies/commonsCss.php'; ?>
    <?php include 'php/dependencies/commonsJS.php'; ?>

    <link  href="css/jquery.nouislider.min.css" rel="stylesheet">
   <link  href="css/jquery.nouislider.pips.css" rel="stylesheet">
    


    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/warpingMatcher.css">
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
    
    <script src="js/config.js" type="text/javascript"></script>

    <script  type="text/javascript">
        var queryString = function () {
            var query_string = {};
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
              var pair = vars[i].split("=");
              if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = pair[1];
              } else if (typeof query_string[pair[0]] === "string") {
                  var arr = [ query_string[pair[0]], pair[1] ];
                  query_string[pair[0]] = arr;
              } else {
                  query_string[pair[0]].push(pair[1]);
              }
            } 
            return query_string;
        } ();
        
    </script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <?php include 'php/navbar_header.php'; ?>
  <?php include 'php/navbar_menu_dark.php'; ?>

    

    <div class="container swcontainerleft" id="container" >
    <!--<h2 class="col-md-12">Alignment</h2>-->
    <div class="row alert" role="alert alert-warning" id="alert-msg">
      
      
    </div>
    
    <div class="row" id="alignment" hidden>
        
        <div class="col-md-12">
            <div id="main-content" role="main">
                <div class="container_12">

                    <div class="row">
                        
                        <div class="alert alert-dismissable fade in alert-notify " >
                                                        The image has been automatically aligned, in order to provide the best solution.
                            Decide wheather you are satisfied with this alignment or not.
                            In case you are not satisfied manually align the image, following the instructions below.
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                        </div>
                    </div>

                    <div class="row hidden" id="successAlign">
                        <div class="alert alert-dismissable fade in alert-notify " >
                            The Alignment Has Been Saved
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 align-step align-step-current" id="step1">
                            <img src="dist/img/list1.png" class="img-responsive img-alignment">
                            Drag the panorama background according to the mountain photo, matching a mountain peak with its related one on the render.
                        </div>
                        <div class="col-md-3 align-step" id="step2">
                            <img src="dist/img/list2.png" class="img-responsive img-alignment">
                            Once they are perfectly aligned press 'Pin panorama' and click on this peak
                        </div>
                        <div class="col-md-3 align-step" id="step3">
                            <img src="dist/img/list3.png" class="img-responsive img-alignment">
                            Match every other peak contained in the photo by clicking on the peak and dragging the selection to a valid peak on the render. ('Shift' + 'Click' to delete a peak).
                        </div>
                        <div class="col-md-3 align-step" id="step4">
                            <img src="dist/img/list4.png" class="img-responsive img-alignment">
                            Once you have saved the alignment, press 'Continue' in order to see the peaks on the image
                        </div>
                        
                    </div>

                    
                    <div  class="row" style="margin-top:20px;">
                        <div class="col-md-2"  >
                            <div class="fov-div">
                                <a title="Pin Panorama" id="ln17" class="btn btn-default btn-render" href="page8.do" >
                                Pin Panorama</a>
                                <a title="Reset" id="ln18" class="  btn btn-default btn-render" href="page8.do" style="display: none;">
                                Reset</a>
                                <a title="Save Alignment" id="ln14" class="  btn btn-default btn-render" href="page8.do">
                                Continue</a>
                            </div>    
                        </div>
                        <div class="col-md-2 zoom-container" >
                            <div class=" fov-div fov-input"  id="sliderZoomDiv">  
                            <div  style="color: #ffffff; margin-bottom:5px; padding:3px; text-align: center;"> FOV </div>
                            <div  style="text-align: center;">
                                <button type="button" class="btn btn-default btn-xs" id="zoomMinBtn"><span class="glyphicon glyphicon-minus"></span></button>
                                <input ntype="text" class="form-control" ame="one" id="zoominput" style="width: 70px;  background-color : #999999; display: inline; border: 0px solid #ccc; color: #ffffff; text-align: center;">
                                <button type="button" class="btn btn-default btn-xs" id="zoomPluBtn"><span class="glyphicon glyphicon-plus"></span></button>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid_12 alpha omega agrd_24 zoom-container" style="padding-bottom: 50px; "  id="sliderZoomDiv">
                            <div id="sliderZoom" ></div>
                        </div>
                    </div>    
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="warpingArea"></div>
</div>
</div>

    <?php include 'php/footer.php'; ?>



    <script src="libs/jquery.nouislider.all.min.js"></script>

    <script src="js/render.js"></script>
    <script src="libs/jquery-ui.js"></script>  


    <script type="text/javascript" src="libs/underscore-min.js"></script> 
    <script src="js/jquery.warpingMatcher.js"></script>
    <script type="text/javascript" src="libs/point.js"></script> 
    <script type="text/javascript" src="libs/matrix22.js"></script>  
    <script type="text/javascript" src="libs/deformation.js"></script>
    <script type="text/javascript" src="libs/interpolation.js"></script>  
    <script type="text/javascript" src="libs/point_definer.js"></script>
  </body>
</html>
