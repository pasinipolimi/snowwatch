
<div class="well filters">
    <h2>Filters</h2>

    
    <div class="row row-centered" >

            <div class="col-md-6 col-padd" >
                <div class="row"><h4><span class="label label-default " style='width:40px'>Type</span></h4></div>
                <div class="row inforow-less">
                    <div class="btn-group" id="selector" popover-trigger="show" popover-placement="left" popover="{{ 'Login or register here'}}">
                        <!--<div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default" id="checkwc2lbl">
                            <input type="checkbox" id="checkwc2"> <span class="glyphicon glyphicon glyphicon-facetime-video"></span>
                        </label>
                        <label class="btn btn-default" id="checkp2lbl">
                            <input type="checkbox" id="checkp2" > <span class="glyphicon glyphicon-camera"></span> 
                        </label>-->
                        <label type="button" class="btn btn-default active" id="checkp2"><span class="glyphicon glyphicon-camera"></span> </label>
                        <label type="button" class="btn btn-default active" id="checkwc2"><span class="glyphicon glyphicon glyphicon-facetime-video"></span></label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-padd">
                <div class="row"><h4><span class="label label-default ">Author</span></h4></div>
                <div class="row inforow-less">
                    <input id="switch-onText" type="checkbox" checked="" data-label-width="30" data-handle-width="30" data-size="mini" data-on-text="All" data-off-text="Mine" name="author-checkbox">
                </div>
            </div>
    </div>



    <div class="row inforow" data-toggle="collapse" href="#swinfo">
        <h4><span class="label label-default label-message">
            Altitude (km)
            <span class="glyphicon glyphicon-chevron-down pull-right" id="altspan" data-toggle="collapse" href="#sliderAltDiv" ></span>
            </span>
        </h4>
    </div>
    <!-- to fix padding -->
    <div class="row inforow-less collapse collapseFilter" style="padding-bottom: 50px; "  id="sliderAltDiv">
        <div id="sliderAlt" ></div>
    </div>

    <div class="row inforow" >
        <h4><span class="label label-default label-message">Peaks
            <span class="glyphicon glyphicon-chevron-down pull-right" id="peaksspan" data-toggle="collapse" href="#peaksdiv" ></span>
        </span></h4>
    </div>    
    <div class="row inforow-less collapse collapseFilte" id="peaksdiv">
        <textarea id="peaksTA" class="peaks boxsizingBorder" rows="1" style="width:100%"></textarea>
    </div>

    <div class="row inforow" >
        <h4><span class="label label-default label-message">Date
            <span class="glyphicon glyphicon-chevron-down pull-right" id="datespan" data-toggle="collapse" href="#datediv" ></span>
        </span></h4>
    </div>
    
    <div class="row inforow-less collapse collapseFilte" id="datediv">
        
        <div id="daterange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span></span> <b class="caret"></b>
        </div>
    </div>

     
      

    
    
</div>