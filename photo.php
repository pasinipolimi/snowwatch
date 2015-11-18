<?php 
    require_once 'php/header.php';
    require_once("php/classes/Review.class.php"); 

    if (isset($_GET["photoId"])){
        $photoId = $_GET["photoId"];       
        $review = new Review();
        $averageRating = $review->getAverageRating($photoId);
        $reviewsList = $review->getList($photoId);
        
        $availableComments=false;
        if ($login->isUserLoggedIn() == true){
            $userId = $_SESSION["user_id"]; 
            $existReview = $review->exists($photoId,$userId);
            if ($existReview == true){
                $unavailableMessage = "REVIEW_ALREADY_WRITTEN";
            }
            else{
                $availableComments=true;
            }
        }
        else{
            $unavailableMessage= "REVIEW_LOG_IN";
        }    
    }
    else{
        header( 'Location: index.php' ) ; 
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'php/favicons.php'; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">    

    <title><?php echo $i18n->translate("PHOTO_DETAIL");?></title>

    
    <?php include 'php/dependencies/commonsCss.php'; ?>

    <script>
        var lang="<?php echo $i18n->getAppliedLang();?>"
    </script>

    


<!--    <link href="remote/highlight.css" rel="stylesheet">-->
    <link href="css/bootstrap-switch.css" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php 
        include 'php/slideshow.php'; 
    ?>

    <meta property="og:image" content="/dist/img/SW_doc_logo.jpg"/>
    <meta property="og:image:secure_url" content="/dist/img/SW_doc_logo.jpg" />
    <link rel="image_src" href="/dist/img/SW_doc_logo.jpg"/>

  </head>

  <body>

  <?php include 'php/navbar_header.php'; ?>
  <?php include 'php/navbar_menu_dark.php'; ?>

    <div class="container photo-container" style="padding-top: 0px; !important">
        <div class="col-xs-8 sw-gallery">

            <div id="imgs-container" style="position:relative" >
                <img class="img-responsive img-thumbnail" id="imageid" data-toggle="collapse"  data-target="#collapseInfo" aria-expanded="false" aria-controls="collapseExample">
                <div id="peaks-container"></div>
                <div id="snow-container"></div>
            </div>

            <div class="collapse" id="collapseInfo">
                <div class="well">
                <div id="collapseInfoDiv"></div>
              </div>
            </div>

            <div class="row" style="padding-top:10px">
                
                    <?php include 'php/social-share.php'; ?>
                
            </div>

            <div class="row">
                <h2 class="col-xs-9"><?php echo $i18n->translate("REVIEWS");?></h2>
                <div class="col-xs-3 sw-stars">
                    <div id="rating_wrapper">
                        <!-- inline width below is rating out of 100 -->
                        <span class="full_stars" style="width: <?php echo $averageRating*100/5?>%;">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                        </span>
                        <span class="empty_stars" >
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                        </span>
                    </div>
                    <span><?php echo $averageRating." ".$i18n->translate("STARS");?></span>
                </div>
            </div>

            <form method="post" action="add_review.php" name="addReview">
                <input type="hidden" name="photo_id" value="<?php echo $_GET["photoId"]?>"/>

                <div class="ratings col">
                    <input type="hidden" id="ratinginput" name="rating" value="0" />
                    <p>
                        <span class="glyphicon glyphicon-star-empty <?php if($availableComments == true){echo "rating";}?>" id ="1"></span>
                        <span class="glyphicon glyphicon-star-empty <?php if($availableComments == true){echo "rating";}?>" id ="2"></span>
                        <span class="glyphicon glyphicon-star-empty <?php if($availableComments == true){echo "rating";}?>" id ="3"></span>
                        <span class="glyphicon glyphicon-star-empty <?php if($availableComments == true){echo "rating";}?>" id ="4"></span>
                        <span class="glyphicon glyphicon-star-empty <?php if($availableComments == true){echo "rating";}?>" id ="5"></span>
                    </p>
                </div>
                <div <?php if ($availableComments == false) {
                 echo "data-toggle='popover' data-trigger='hover'  data-placement='bottom' data-content=\"<span class='glyphicon glyphicon-alert' style='color:#20BEE3'> ".$i18n->translate("REVIEW_ALREADY_WRITTEN")."</span>\"";}?>>
                    <div class="row form-group">
                        <textarea class="col-xs-12" rows="3" id="commentinput" name="comment" <?php if ($availableComments == false) { echo "disabled style='background-color:lightgray' ";}?> ></textarea>
                    
                        <button class="btn btn-lg btn-sw col-xs-3 col-xs-offset-9" style="margin-top: 10px;" <?php if ($availableComments == false) { echo "disabled ";}?>><?php echo $i18n->translate("SUBMIT");?></button>
                    </div>
                </div>
            </form>
            
            <br>
            <br>
            <br>
            <hr>

            <div id="commentsWell">

            <?php
                foreach ($reviewsList as $entry) {
                    include 'php/review_entry.php';
                }                
            ?>
            </div>
        </div>

        <!-- ************************************************************** COLONNA DESTRA ************************************************************** -->
            <!-- ************************************************************** COLONNA DESTRA ************************************************************** -->
            <div class="col-xs-4">
                <div class="well well-photo-detail">

                    <h2 style="margin-top:-10px"> <?php echo $i18n->translate("SHOW");?> </h2>
                    <div   class="myinfobox" >
                        <div class="row" >
                            <h4><span class="label label-default label-message" id="statusMessage"></span></h4>
                        </div>
                        
                        <div class="row inforow" style="padding-bottom:15px;">
                            <div class="col col-md-3" style="text-align:center">
                                <img src="dist/img/icon-mountains.png">    
                                <p style="    margin-top: -10px;"><?php echo $i18n->translate("SHOW_PEAKS");?></p>
                            </div>
                            <div class="col col-md-3" style="margin-left: -20px;     padding-top: 20px; margin-right: 10px;
">
                                <input id="switch-peaks" type="checkbox"  disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                            </div>
                            <div class="col col-md-3" style="text-align:center">
                                    <img src="dist/img/icon-snow.png" >
                                    <p style="    margin-top: -10px;"><?php echo $i18n->translate("SNOW_MASK");?></p>
                            </div>
                            <div class="col col-md-3" style="margin-left: -20px;    padding-top: 20px;" data-toggle="popover" data-trigger="hover"  data-placement="bottom" data-content='<span class="glyphicon glyphicon-warning-sign" style="color:#F29A1A"> <?php echo $i18n->translate("COMING");?></span>'>
                                    <input id="switch-snow" type="checkbox" disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                            </div>
                            
                        </div>  
                        <div class="row inforow">

                                <a class="btn btn-default btn-render <?php if ($login->isUserLoggedIn() == false){ echo "disabled"; }?>"
                                    id="viewRender">
                                     <img src="dist/img/button-allignment.png" class="btn-img">
                                    <?php echo $i18n->translate("ALIGNMENT");?>

                                </a>

                                <a  id="validateBtn" class="  btn btn-default btn-render disabled">
                                <img src="dist/img/button-validate.png" class="btn-img">
                                <?php echo $i18n->translate("VALIDATE");?></a>
                            
                        </div>

                    </div>

                    
                
                    <h2><?php echo $i18n->translate("LOCALIZATION");?><button type="button" class="btn btn-coord-danger
                                        <?php if ($login->isUserLoggedIn() == false) { echo "disabled";}?>"
                                        data-toggle="modal" data-target="#coordsModal" id="latlngInputBtn" style="background:none;">
                                        <span class="glyphicon glyphicon-pencil" style="color:#F56A63"></span>
                                          <?php echo $i18n->translate("INSERT_COORDINATES");?>
                                        </button></h2> 
                    <div id="swinfo"  class="myinfobox" >
                        <div class="row inforow"><div id="mapInfo" ><img id="mapImg" class="img-responsive centered" ></div></div>
                        <!--<div class="row inforow" id="latlngInfo">
                                <div  id="lat"></div>
                                <div  id="lng"></div>
                        </div>-->
                    </div>

                    <h2> <?php echo $i18n->translate("FOV");?> </h2>
                    <div   class="myinfobox" >
                        <div class="row inforow" >
                                <div id="hFov"></div>
                                <div  id="vFov"></div>
                                <!--<span class="glyphicon" id= "gpsAlt"></span>--> 
                        </div>

                    </div>
                    

                    <h2 >Info </h2>
                    <div id= "photoinfo" class="myinfobox" >
                        <div class="row" id="date"></div>
                        <div class="row inforow-less-top" id="author"></div>
                        <div class="row inforow-less-top"  id="source"></div>
                        <div class="row inforow-less-top" id="type"></div>
                        
                    </div>

                </div>
 

                <div class="well well-photo-detail" style="display:none" id="samepeaksdiv">
                    <h2 style="margin-top:-10px"><?php echo $i18n->translate("SMPEAK");?></h2>
                    <div class="galleryContainer"><?php echo generateSlideshow("peakslinks", "small");?></div>
                </div> 
                <div class="well well-photo-detail" style="display:none" id="sameusrdiv">
                    <h2 style="margin-top:-10px"><?php echo $i18n->translate("SMUSR");?></h2>
                    <div class="galleryContainer"><?php echo generateSlideshow("userlinks", "small"); ?></div>
                </div>

                <div class="well well-photo-detail" id="nearbydiv" style="display:none">
                    <h2 style="margin-top:-10px"><?php echo $i18n->translate("NEAR");?></h2>
                    <div class="galleryContainer"> <?php echo generateSlideshow("nearlinks", "small"); ?></div>
                </div>

                

            </div> <!-- ******************************* FINE COLONNA DESTRA ******************************* -->


    </div>

    <div class="modal fade " id="coordsModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header well-photo-detail" style="border-bottom: 0px; padding-bottom:5px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span  style="    color: #fff;">&times;</span></button>
            <h4><?php echo $i18n->translate("ADD_COORDINATES");?></h4>
          </div>
          <div class="modal-body well-photo-detail">
                <div class="row">
                    <div class="col-md-8">
                        <div id="mapCanvas" style="width: 370px; height: 300px"></div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="lat"><?php echo $i18n->translate("Latitude");?></label>
                                <input type="text" class="form-control" id="latInput" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                                <label for="lng"><?php echo $i18n->translate("Longitude");?></label>
                                <input type="text" class="form-control" id="lngInput" placeholder="Longitude">
                                
                            </div>
                            <div class="form-group" style="padding-top:20px">
                                <button type="button" class="btn btn-primary btn-sw" data-dismiss="modal" id="saveCoordsBtn"><?php echo $i18n->translate("SAVE_CHANGES");?></button>
                            </div>
                        
                    </div>
              </div>
          </div>
          
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    </div><!-- /.container -->

  <?php include 'php/footer.php'; ?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiUJC2WiuszJkkHhoqH4nXHBs3skyr62o&libraries=geometry&sensor=false"></script>

    <?php include 'php/dependencies/commonsJS.php'; ?>
    <script src="js/photo.js"></script>
    <script src="libs/bootstrap-switch.js"></script>
    <script src="js/gallery2.js"></script>
    <script>$("#gallerypage").addClass("active");</script>

  </body>
</html>