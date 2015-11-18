<div class="col-xs-3  sw-filter-panel">
    
    <h2><?php echo $i18n->translate("FILTERS");?></h5>
    <input type="hidden" id="swp_user_id" value="<?php if(isset($_SESSION['swp_user_id'])){echo $_SESSION['swp_user_id'];}?>"/>

    <div class="row row-centered" >

        <div class="col-xs-6">
            
            <div class="row inforow-less" style="margin-bottom: 10px;">
                <h4 style="    margin-bottom: 0px;    margin-left: 20px;"><?php echo $i18n->translate("TYPE");?></h4>
                <div class="col col-md-6 camera sw-active selector" style="text-align:center" id="checkp2">
                        <div  class="filter-icons"><?php echo $i18n->translate("PHOTO");?></div>
                </div>
                <div class="col col-md-6  webcam sw-inactive selector" style="text-align:center" id="checkwc2">
                        <div class="filter-icons"><?php echo $i18n->translate("VIDEO");?></div>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="row inforow-less" style="margin-bottom: 10px;">
                <h4 style="    margin-bottom: 0px;    margin-left: 5px;"><?php echo $i18n->translate("AUTHOR");?></h4>
                <div id="mine" class="col col-md-6 me-filter sw-inactive <?php if ($login->isUserLoggedIn() == true) {echo "switcher";}?>" style="text-align:center; padding-right:0px; margin-left:10px" id="checkp2" >
                        <div  class="filter-icons"><?php echo $i18n->translate("MINE");?></div>
                </div>
                <div class="col col-md-6  all-filter sw-active author <?php if ($login->isUserLoggedIn() == true) {echo "switcher";}?>" style="text-align:center;  padding-left:0px; margin-right:-10px" id="checkwc2">
                        <div class="filter-icons"><?php echo $i18n->translate("ALL");?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row inforow"  style="margin-bottom:30px">
        <div class="col col-xs-12">
            <h4 style="text-align:left; margin-bottom: 0px;"><?php echo $i18n->translate("ALTITUDE_KM");?><span class="glyphicon glyphicon-off alt_btn_on" id="alt_btn"  style="padding-left: 10px;"></span></h4>
            <div class="row">
                <div class="col col-xs-12" style="    margin-top: 10px;">
                    <div class="sup">
                        <div id="containeralt">
                            <div id="right_panel" class='right_panel_on'>
                                <div id="drag"></div>
                            </div>
                            <div id="top_panel">
                                <div id="top_drag"></div>
                            </div>
                        </div>
                        <div id="number_down">1.0</div>

                        <div id="number_up">4.0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row inforow" style="padding-bottom:20px">
        <div class="col col-xs-12">
            <h4 style="text-align:left; margin-bottom: 0px;"><?php echo $i18n->translate("PEAKS");?></h4>
            <div class="row">
                <div class="col col-xs-2"><img src="dist/img/icon-mountains.png" style="width: 30px"> </div>
                <div class="col col-xs-10" style="    margin-top: 5px;">
                <!--<textarea id="peaksTA" class="peaks boxsizingBorder" rows="1" style="width:100%; background-color: white;"></textarea>-->
                <input type="text" id="tag2" style="    width: 195px !important"/>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="row inforow" style="padding-bottom:30px">
        <div class="col col-xs-12">
            <h4 style="text-align:left; margin-bottom: 10px;"><?php echo $i18n->translate("DATE");?></h4>
            <div class="col col-xs-12">
                <div id="daterange" disabled style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span></span> <b class="caret"></b>
                </div>
                </div>
            </div>
    </div>-->
    


</div>