<div class="col-xs-3 col-xs-offset-1 sw-filter-panel">
    
    <h2><?php echo $i18n->translate("FILTERS");?></h5>
    <input type="hidden" id="swp_user_id" value="<?php if(isset($_SESSION['swp_user_id'])){echo $_SESSION['swp_user_id'];}?>"/>

    <div class="row row-centered" >

        <div class="col-xs-6">
            <h5><?php echo $i18n->translate("TYPE");?></h5>
            <div class="row inforow-less">
                <div class="btn-group" id="selector" popover-trigger="show" popover-placement="left" popover="{{ 'Login or register here'}}">
                    <label type="button" class="btn btn-default active" id="checkp2"><span class="glyphicon glyphicon-camera"></span> </label>
                    <label type="button" class="btn btn-default active" id="checkwc2"><span class="glyphicon glyphicon glyphicon-facetime-video"></span></label>
                </div>
            </div>
        </div>

        <div class="col-xs-6">
            <h5><?php echo $i18n->translate("AUTHOR");?></h5>
            <div class="row inforow-less">
                <input id="switch-onText" type="checkbox" checked="" data-label-width="30" data-handle-width="30" data-size="mini" data-on-text="<?php echo $i18n->translate("ALL");?>" data-off-text="<?php echo $i18n->translate("MINE");?>" name="author-checkbox"
                    <?php if ($login->isUserLoggedIn() == false) {echo "readonly";}?>>
            </div>
        </div>
    </div>


    <div class="row row-centered inforow" data-toggle="collapse" href="#swinfo">
        <h5>
            <?php echo $i18n->translate("ALTITUDE_KM");?>
            <span class="glyphicon glyphicon-chevron-down pull-right" id="altspan" data-toggle="collapse" href="#sliderAltDiv" ></span>
        </h5>
    </div>
    <!-- to fix padding -->
    <div class="row inforow-less collapse collapseFilter" style="padding-bottom: 50px; "  id="sliderAltDiv">
        <div id="sliderAlt" ></div>
    </div>


    <div class="row row-centered inforow" >
        <h5><?php echo $i18n->translate("PEAKS");?>
            <span class="glyphicon glyphicon-chevron-down pull-right" id="peaksspan" data-toggle="collapse" href="#peaksdiv" ></span>
        </h5>
    </div>    
    <div class="row inforow-less collapse collapseFilte" id="peaksdiv">
        <textarea id="peaksTA" class="peaks boxsizingBorder" rows="1" style="width:100%; background-color: white;"></textarea>
    </div>

    
    <div class="row row-centered inforow" >
        <h5><?php echo $i18n->translate("DATE");?>
            <span class="glyphicon glyphicon-chevron-down pull-right" id="datespan" data-toggle="collapse" href="#datediv" ></span>
        </h5>
    </div>
    <div class="row inforow-less collapse collapseFilte" id="datediv">
        <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span></span> <b class="caret"></b>
        </div>
    </div>

</div>