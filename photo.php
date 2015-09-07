
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>SnowWatch Portal - Photo Detail</title>

    
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

    <?php include 'php/navbar.php'; ?>

    
    
    <div class="container swcontainerleft">
      
        <div class="row">
            <div class="col-md-8">
               
                <div id="imgs-container" style="position:relative" >
                    <img class="img-responsive" id="imageid" data-toggle="collapse"  data-target="#collapseInfo" aria-expanded="false" aria-controls="collapseExample">
                    <div id="peaks-container"></div>
                    <div id="snow-container"></div>
                </div>

                <div class="collapse" id="collapseInfo">
                  <div class="well">
                    <div id="collapseInfoDiv"></div>
                  </div>
                </div>
                


                <hr>
                <div class="row">
                    <div class="ratings col-md-8">
                      <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        4.0 stars
                      </p>
                    </div>
                    <!--<div  class="well col-md-4 col-md-offset-3">
                     <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                     <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                     <a class="btn btn-social-icon btn-flickr"><i class="fa fa-flickr"></i></a>
                     <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                    </div>-->
                </div>
                <!-- ******************************* REVIEW E COMMENTI ******************************* -->
                <!-- ******************************* REVIEW E COMMENTI ******************************* -->
                <div class="well" >
                    <div class="row">
                        <div class="col-md-9">
                            <div class="ratings col" id="ratinginput">
                              <p>
                                <span class="glyphicon glyphicon-star-empty rating" id ="1"></span>
                                <span class="glyphicon glyphicon-star-empty rating" id ="2"></span>
                                <span class="glyphicon glyphicon-star-empty rating" id ="3"></span>
                                <span class="glyphicon glyphicon-star-empty rating" id ="4"></span>
                                <span class="glyphicon glyphicon-star-empty rating" id ="5"></span>
                              </p>
                            </div>
                            <textarea class="form-control" rows="3" id="commentinput"></textarea>
                        </div>
                        <div class="text-right col-md-3 ">
                            <a class="btn btn-success" id="postCommentBtn">Leave a Review</a>
                        </div>
                    </div>
                    <hr>
                    <div id="commentsWell">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <b> Samwell Tarly</b> 
                            <span class="pull-right">10 days ago</span>
                            <p>This photo is awsome!</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <b> Ygritte</b> 
                            <span class="pull-right">12 days ago</span>
                            <p>You know nothing, JonSnow!</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <b> Ramsay Bolton</b> 
                            <span class="pull-right">15 days ago</span>
                            <p>I've seen some better than this...</p>
                        </div>
                    </div>
                    </div>
                </div>     
            </div> <!-- fine colonna foto-->




            <!-- ************************************************************** COLONNA DESTRA ************************************************************** -->
            <!-- ************************************************************** COLONNA DESTRA ************************************************************** -->
            <div class="col-md-4">
                <div class="well">
                    <h4>Photo Info 
                    <button class="DetailsBtn SeeMore btn btn-default btn-xs pull-right" data-toggle="collapse" href="#photoinfo">See More</button></h4>
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
                        <button class="DetailsBtn btn btn-default btn-xs pull-right" data-toggle="collapse" href="#swinfo">See Less</button>
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

                                        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#coordsModal" id="latlngInputBtn">
                                          Insert Coordinates
                                        </button>
                                    </div>                
                                </div>
                        </div>
                        <div class="row inforow" >
                                <div id="hFov"></div>
                                <div  id="vFov"></div>
                                <!--<span class="glyphicon" id= "gpsAlt"></span>--> 
                        </div>
                        <div class="row inforow row-centered">
                            <div class="col-centered">
                                <span ><a class="btn btn-success btn-sm" id="viewRender">Alignment</a></span>
                            </div>        
                            <div class="col-centered">
                                <span ><a class="btn btn-success btn-sm disabled" id="validateBtn">Validate</a></span>
                            </div>        
                        </div>
                        <div class="row inforow row-centered">
                            <div class="col-md-1 col-centered" id="peaksdiv">
                                <div class="row">
                                    Show Peaks:
                                </div>
                                <div class="row">
                                    <input id="switch-peaks" type="checkbox"  disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                                </div>
                            </div>
                            <div class="col-md-1 col-centered" id="snowmaskdiv">
                                <div class="row">
                                    Snow Mask:
                                </div>
                                <div class="row">
                                    <input id="switch-snow" type="checkbox" disabled data-size="mini" data-on-text="ON" data-off-text="OFF" >
                                </div>
                            </div> 
                        </div>             
                    </div>
                </div>

                <div class="well" style="display:none" id="samepeaksdiv">
                    <h4>Same Peaks</h4>
                    <div class="galleryContainer"><?php echo generateSlideshow("peakslinks", "small");?></div>
                </div>

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
    </div>



    <div class="modal fade" id="coordsModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add coordinates</h4>
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveCoordsBtn">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
      

    </div><!-- /.container -->
    <?php include 'php/dependencies/commonsJS.php'; ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiUJC2WiuszJkkHhoqH4nXHBs3skyr62o&libraries=geometry&sensor=false"></script>
    <script src="libs/bootstrap-switch.js"></script>
    <script src="js/gallery2.js"></script>
    <script src="js/photo.js"></script>
    
  </body>
</html>
