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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">    

    <title><?php echo $i18n->translate("PHOTO_DETAIL");?></title>

    
    <?php include 'php/dependencies/commonsCss.php'; ?>


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
  </head>

  <body>

  <?php include 'php/navbar_header.php'; ?>
  <?php include 'php/navbar_menu_dark.php'; ?>

    <div class="container photo-container">
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

            <div class="row">
                <h2 class="col-xs-9">Reviews</h2>
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
                <div class="form-group">
                    <textarea class="col-xs-12" rows="3" id="commentinput" name="comment" <?php if ($availableComments == false) { echo "disabled style='background-color:lightgray';";}?>></textarea>
                </div>
                <br>
                <br>
                <br>
                <br>
                <?php if ($availableComments == false) { echo "<div class='row-centered alert alert-danger'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ".$i18n->translate($unavailableMessage)."</div>"; }?>

                <div class="form-group">                            
                    <button class="btn btn-lg btn-sw col-xs-3 col-xs-offset-9" <?php if ($availableComments == false) { echo "disabled";}?>>SUBMIT</button>
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
            <div class="col-md-4">
                <div class="well">
                    <h4>Photo Info 
                    <button class="DetailsBtn SeeMore btn btn-default btn-xs pull-right" data-toggle="collapse" href="#photoinfo"><?php echo $i18n->translate("SEE_MORE");?></button></h4>
                    <div id= "photoinfo" class="collapse myinfobox centered">
                        <div class="row" id="date"></div>
                        <div class="row inforow-less-top" id="author"></div>
                        <div class="row inforow-less-top"  id="source"></div>
                        <div class="row inforow-less-top" id="type"></div>
                        <div class="row inforow"><div id="mapInfo" ><img id="mapImg" class="img-responsive centered" ></div></div>
                    </div>
                </div>

                <div class="well">
                    <h4>SnowWatch
                        <button class="DetailsBtn btn btn-default btn-xs pull-right" data-toggle="collapse" href="#swinfo"><?php echo $i18n->translate("SEE_LESS");?></button>
                    </h4>
                    <div id="swinfo"  class="collapse in myinfobox" >
                        <div class="row" >
                            <h4><span class="label label-default label-message" id="statusMessage"></span></h4>
                        </div>
                        <div class="row inforow" id="latlngInfo">
                                <div  id="lat"></div>
                                <div  id="lng"></div>
                        </div>
                        <div class="row" id="latlngInput">
                                <div class="row inforow">
                                    <div class="col-md-3">

                                        <button type="button" class="btn btn-sm
                                        <?php if ($login->isUserLoggedIn() == false) { echo "disabled";}?>"
                                        data-toggle="modal" data-target="#coordsModal" id="latlngInputBtn">
                                          <?php echo $i18n->translate("INSERT_COORDINATES");?>
                                        </button>
                                    </div>                
                                </div>
                        </div>
                        <div class="row inforow" >
                                <div id="hFov"></div>
                                <div  id="vFov"></div>
                                <!--<span class="glyphicon" id= "gpsAlt"></span>--> 
                        </div>
                        <div class="row inforow">
                            <div class="col-centered">
                                <span ><a class="btn btn-success btn-sm <?php if ($login->isUserLoggedIn() == false){ echo "disabled"; }?>"
                                    id="viewRender"><?php echo $i18n->translate("ALIGNMENT");?></a></span>
                            </div>        
                            <div class="col-centered">
                                <span ><a class="btn btn-success btn-sm disabled" id="validateBtn"><?php echo $i18n->translate("VALIDATE");?></a></span>
                            </div>        
                        </div>
                        <div class="row inforow row-centered">
                            <div class="col-md-4" id="peaksdiv">
                                <div class="row">
                                    <?php echo $i18n->translate("SHOW_PEAKS");?>:
                                </div>
                                <div class="row col-md-1">
                                    <input id="switch-peaks" type="checkbox"  disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                                </div>
                            </div>
                            <div class="col-md-4" id="snowmaskdiv">
                                <div class="row">
                                    <?php echo $i18n->translate("SNOW_MASK");?>:
                                </div>
                                <div class="row col-md-1">
                                    <input id="switch-snow" type="checkbox" disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                                </div>
                            </div> 
                        </div>     
                    </div>
                </div>
 

<!--                 <div class="well" style="display:none" id="samepeaksdiv">
                    <h4>Same Peaks</h4>
                    <div class="galleryContainer"><?php echo generateSlideshow("peakslinks", "small");?></div>
                </div> -->

                <div class="well" style="display:none" id="sameusrdiv">
                    <h4>Same User</h4>
                    <div class="galleryContainer"><?php echo generateSlideshow("userlinks", "small"); ?></div>
                </div>

                <div class="well" id="nearbydiv" style="display:none">
                    <h4>Near-by</h4>
                    <p>
                       <div class="galleryContainer"> <?php echo generateSlideshow("nearlinks", "small"); ?></div>
                    </p>
                </div>

                

            </div> <!-- ******************************* FINE COLONNA DESTRA ******************************* -->


    </div>

    <div class="modal fade" id="coordsModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo $i18n->translate("ADD_COORDINATES");?></h4>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div id="mapCanvas" style="width: 370px; height: 300px"></div>
                    </div>
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input type="text" class="form-control" id="latInput" placeholder="Latitude">
                            </div>
                            <div class="form-group">
                                <label for="lng">Longitude</label>
                                <input type="text" class="form-control" id="lngInput" placeholder="Longitude">
                            </div>
                        
                    </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $i18n->translate("CLOSE");?></button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveCoordsBtn"><?php echo $i18n->translate("SAVE_CHANGES");?></button>
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