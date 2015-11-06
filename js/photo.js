var photoGlb;
var snowCtx;
var depthCtx;
var altCtx;
var detailsReady;
var marker;

$(function(){
	loadPhoto(readQueryString(), function (photo) {
        photoGlb=photo;
        fillPhoto(photo);
    });

    $('.rating').click( function(){
      var star= parseInt($(event.target).prop("id"));
      $('#ratinginput').attr('value', star);
      for (var i = 1; i <= star; i++) {
          $('#'+i).addClass('glyphicon-star').removeClass('glyphicon-star-empty');
      };
      for (var i = star+1; i <= 5; i++) {
          $('#'+i).addClass('glyphicon-star-empty').removeClass('glyphicon-star');
      };
    })

    $(window).resize(function(photoDetails){
        drawPeaks(photoDetails);    
    });
});

function fillPhoto(photoDetails) {
	$('#imageid').attr('src', retrieveUrl(photoDetails, 3));
	enableCollapse();

	if(photoDetails.gpsLng && photoDetails.gpsLat){
        updateCoords(photoDetails.id, photoDetails.gpsLat, photoDetails.gpsLng);

	} else {
	    $('#mapInfo').hide();
	    $('#latlngInfo').hide();
	    $('#nearbydiv').hide();
        
        $('#latlngInputBtn').addClass("btn-danger");
        $('#latlngInputBtn').removeClass("btn-primary");
        $('#latlngInputBtn').html("Insert Coordinates");
        initializeMap(photoDetails.id);
	}



	if(photoDetails.auxTsShot){
      $("#date").html ("<b>Taken on </b>"+ new Date(photoDetails.auxTsShot).toLocaleString());  
    } else {
      $("#date").html ( " Shot date undefined");  
    };
    if(photoDetails.gpsAlt){
      $("#gpsAlt").html ("GPS Altitude: "+ photoDetails.gpsAlt);
    }

    if(photoDetails.vFov){
      $("#vFov").html ( "vFov: "+ photoDetails.vFov);
    } else {
      $("#vFov").html ( "vFov: undefined ");
    }
    if(photoDetails.hFov){
      $("#hFov").html ( "hFov: "+ photoDetails.hFov);
    } else {
      $("#hFov").html ( "hFov: undefined ");
    }


    //source
    $("#source").html(  " <b>Source: </b>"+photoDetails.source);

    if(photoDetails.type=='P'){
        $("#type").html ( " <b>Type: </b>Photo");
    } else {
        $("#type").html (' <b>Type: </b> WebCam <button type="button" class="btn btn-xs btn-info btn-lg">'+
        '<span class="glyphicon glyphicon-play" aria-hidden="true"></span> Start Slideshow</button>');
    }

	var status=photoDetails.status;
    $.getJSON("config/status.json", function( data ) {
        $('#statusMessage').addClass("label-"+data.status[status].level);
        $('#statusMessage').append(data.status[status].message);
    });

	if(photoDetails.auxRender){
        $('#viewRender').click( function(){
            window.location='render.php?photoId='+photoDetails.id;
        });
    } else{
        $('#viewRender').attr('disabled', true);
    }

    //TODO Validation button
    
    
    if(photoDetails.auxAlignment){
        $('#switch-peaks').bootstrapSwitch('disabled', false).bootstrapSwitch('state', false)    ;

        $('#imageid').on('load', function() {
			drawPeaks(photoDetails);
		});
        
        $('#switch-peaks').on('switchChange.bootstrapSwitch', function(event, state) {
			if(state){
				$('#peaks-container').show();
			} else {
				$('#peaks-container').hide();
			}
		});

    
    //Same peaks     
    //    uploadGallery(8, calcPeaksFilter(photoDetails), "#peakslinks", [photoDetails.id]);
    //    $('#samepeaksdiv').show();

        
        if(photoDetails.auxAlignment.auxFileAbsUrlDepthMask){
            downloadGeneralMask(photoDetails.auxAlignment.auxFileAbsUrlDepthMask, 'depthCtx');
        }

        if(photoDetails.auxAlignment.auxFileAbsUrlAltMask){
            downloadGeneralMask(photoDetails.auxAlignment.auxFileAbsUrlAltMask, 'altCtx');
        }

    } else{
    	$("#switch-peaks").bootstrapSwitch();
    }

    if(photoDetails.auxFileAbsUrlSnowMask){
        $('#switch-snow').bootstrapSwitch('disabled', false).bootstrapSwitch('state', false);
        $('#imageid').on('load', function() {
			drawSnowMask(photoDetails);
		});

		$('#switch-snow').on('switchChange.bootstrapSwitch', function(event, state) {
			if(state){
				$('#snow-container').show();
			} else {
				$('#snow-container').hide();
			}
		});
        downloadGeneralMask(photoDetails.auxFileAbsUrlSnowMask, 'snowCtx');
    } else {
    	$("#switch-snow").bootstrapSwitch();
    }
    


    if(photoDetails.userId.indexOf('SWP')>=0){
        $("#author").html(" <b>By: </b> Jon Snow");
    } else {
        $("#author").html(" <b>By: </b>"+ photoDetails.userId);
    }
    // var oid= photoDetails.userId.replace('SWP','');
    // $.ajax({
    //     type:       "GET",
    //     url:        "php/readUser.php?oid="+oid,
    //     success:    function(data) {
    //         $("#author").html(" <b>By: </b>"+ data);
    //     }//end success function
    // }); 
    
    uploadGallery(8, "userIds[]="+photoDetails.userId, "#userlinks", [photoDetails.id]);
    $('#sameusrdiv').show();

};

function calcPeaksFilter(photoDetails){
    var peaks=photoDetails.auxAlignmentPeaks;
    var filters="";
    for (var i = 0; i < peaks.length; i++) {
        var id= peaks[i].auxPeakId;
         filters+="peakIds[]="+id+"&";
    };
    return filters;

}

function drawSnowMask(photoDetails){
    $('#snow-container').empty();  
    x = $("#imageid").position().left;
    y = $("#imageid").position().top;
    imageWidth = $("#imageid").width();
    imageHeight = $("#imageid").height();
    $("#snow-container").append("<img id='snow-img' src='"+photoDetails.auxFileAbsUrlSnowMask+"' class='snowOnPhoto img-responsive'  height='"+imageHeight+ "' width='"+imageWidth+"'  style='left:"+ x +"px;top:"+ y +"px'></img>");      
    $("#snow-container").hide();
}


function updateCoords(photoId, lat, lng){
    $("#mapImg").attr('src', "https://maps.googleapis.com/maps/api/staticmap?center="+lat+","+lng+"&size=300x250&zoom=9&markers=color:red|"+lat+","+lng);
    $("#lat").html( "GPS Longitude: "+ lat);
    $("#lng").html( "GPS Latitude: "+ lng);
    

    
    var delta = 0.1;
    var gpsLatMin=lat-delta;
    var gpsLatMax=lat+delta;
    var gpsLngMin=lng-delta;
    var gpsLngMax=lng+delta; 
    uploadGallery(8, "gpsLatMin="+gpsLatMin+"&gpsLatMax="+gpsLatMax+"&gpsLngMin="+gpsLngMin+"&gpsLngMax="+gpsLngMax, "#nearlinks"); 
    $('#nearbydiv').show();

    $('#mapInfo').show();
    $('#latlngInfo').show();

    initializeMap(photoId, lat, lng);
    
    $('#latlngInputBtn').html("Change Coordinates");
    $('#latlngInputBtn').removeClass("btn-danger");
    $('#latlngInputBtn').addClass("btn-primary");


}

function drawPeaks (photoDetails){
    $('#peaks-container').empty();
    var numPeaks = 0;
    if (photoDetails.auxAlignmentPeaks!= undefined){
        numPeaks= photoDetails.auxAlignmentPeaks.length;
    }
    var startImageX = $("#imageid").position().left;
    var startImageY = $("#imageid").position().top;
    var imageWidth = $("#imageid").width();
    var imageHeight = $("#imageid").height();
    var origImageWidth = photoDetails.hSize;
    var origImageHeight = photoDetails.vSize;

    for(var i=0; i<numPeaks; i++) {   
        var p = photoDetails.auxAlignmentPeaks[i];
        var x = startImageX + (p.x * imageWidth /origImageWidth ) -12;
        var y = startImageY + (p.y * imageHeight / origImageHeight ) -24;
        // var x = p.x * 100 / origImageWidth;
        // var y = p.y * 100 / origImageHeight;

        // x = "calc( "+x+"% - 12px )";
        // y = "calc( "+y+"% - 12px )";
        
        
        $("#peaks-container").append("<img src='images/peak2.png' class='peaksonphoto'  height='28' width='28' class='render-peak' id='"+p.id+"' style='left:"+ x +"px;top:"+ y +"px'></img>");
        //$("#peaks-container").append("<img src='images/peak2.png' class='peaksonphoto'  height='28' width='28' class='render-peak' id='"+p.id+"' style='left:"+ x +";top:"+ y +"'></img>");
        
    }
    $('#peaks-container').hide();
    
}

function downloadGeneralMask(urlMask, ctxName){
    
    var img = new Image();
    img.src = "./php/image_proxy.php?url="+urlMask;
    
    img.onload = function() {
        var canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, img.width, img.height);
        window[ctxName]=ctx;
        img.style.display = 'none';
        detailsReady=true;
    };
}


function enableCollapse(imgId){    
    $('#imgs-container').on( 'mouseenter', function (){$('#collapseInfo').show();} );
    $('#imgs-container').on( 'mouseleave', function (){$('#collapseInfo').hide();} );
    $('#imgs-container').on( 'mousemove', showPxlInfo );
    $('#peaks-container').on( 'mousemove', 'img', showPeakInfo );  
}



function showPxlInfo(event){
    var message;
    if(detailsReady){
        startImageX = $("#imageid").offset().left;
        startImageY = $("#imageid").offset().top;
        imageWidth = $("#imageid").width();
        imageHeight = $("#imageid").height();
        origImageWidth = photoGlb.hSize;
        origImageHeight = photoGlb.vSize;

        var x = Math.floor(coordsResize( startImageX, event.pageX,  imageWidth, origImageWidth ));
        var y = Math.floor(coordsResize( startImageY, event.pageY,  imageHeight, origImageHeight ));

         message = "<div class='row'>";//"pixels "+ event.pageX+"(" + x + ")" +"  "+event.pageY+"(" + y + ")";
        if(snowCtx){
            message += "<div class='col-md-2'>"+readSnowData(x,y)+"</div>";
        }
        if(depthCtx){
            message += "<div class='col-md-3'>" + readDepthData(x,y)+"</div>";
        }
        if(altCtx){
            message += "<div class='col-md-3'>" + readAltData(x,y)+"</div>";
        }
        message+="</div>";
    } else {
        message = "Downloading data, please wait";
    }
    
    $('#collapseInfoDiv').html(message);
    
}


function showPeakInfo(event){

    event.stopPropagation();
    var peakId=event.toElement.id;
    var peakinfo=findPeak(peakId);
    var message= "<div class='row row'><div class='col-md-12'>";
    if(peakinfo){
        message += "<b>Name: </b> "+ peakinfo.auxName+" <b>Distance (km):</b> "+peakinfo.auxDistKm+" <b>Altitude (m):</b> "+peakinfo.auxGpsAlt;
    } else {
        message += "Peak info not found";
    }

    message+="</div></div>";
    $('#collapseInfoDiv').html(message);
}


function findPeak(peakId){
    for(var i=0; i<photoGlb.auxAlignmentPeaks.length; i++) {   
        var p = photoGlb.auxAlignmentPeaks[i];
        if (p.id==peakId){
            return p;
        }
    }
    return null;
}

function readSnowData(x,y){
    var message="";
    
    var data = snowCtx.getImageData(x, y, 1, 1).data;
    var r=data[0];
    var g=data[1];
    var b=data[2];
    var alpha=data[3];
    //message+= " snow: " + r + g + b;
    if(r==0 && b==0 && g==0){
        //terreno
        message += 'Terrain';
    } else {
        if(r==255 && b==255 && g==255){
            message += 'Snow';
        } else {
            message += 'Sky';
        }
    }
    return  "<b>"+message+"</b>"; 
}

function readAltData(x,y){
    var message="";
    var data = altCtx.getImageData(x, y, 1, 1).data;
    var r=data[0];
    var g=data[1];
    var b=data[2];
    var alpha=data[3];
    if(r==255 && g==255 && b==255){
        return message;
    }
    var alt = r * 5000 / 254;
    message+= "<b>Altitude: </b>"+Math.round(alt)+"m";
    //todo fondoscala
    return message; 
}


function readDepthData(x,y){
    
    var message="";
    var data = depthCtx.getImageData(x, y, 1, 1).data;
    var r=data[0];
    var g=data[1];
    var b=data[2];
    var alpha=data[3];
    if(r==255 && g==255 && b==255){
        return message;
    }
    var depth = r * 20000 / 254;
    message+= "<b>Distance: </b>"+Math.round(depth)+"m";
    //todo fondoscala
    return message; 
}


function coordsResize(offset, x, dim, originalDim){
 return (x - offset) / dim * originalDim ; 
}

function initializeMap(photoId, lat, lng) {
    var centerLat = lat ? lat : 46; 
    var centerLng = lng ? lng : 12;
    
    var mapOptions = {
        center: new google.maps.LatLng(centerLat, centerLng),
        zoom: 5,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("mapCanvas"),
    mapOptions);
    
    marker = new google.maps.Marker({
            draggable:true,
            map: map
    });

    if(lat && lng){
        marker.setPosition(new google.maps.LatLng(lat, lng));
        
        $("#latInput").val( lat );
        $("#lngInput").val( lng );
        
    } else {
           
    }


    google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
    //        marker.setVisible(true);
            //google.maps.event.clearListeners(map, 'click');
            $("#latInput").val( event.latLng.A);
            $("#lngInput").val( event.latLng.F);
    }); 

    marker.setMap(map);
    google.maps.event.addListener(marker, 'dragend', function (event) {
            $("#latInput").val( this.getPosition().lat());
            $("#lngInput").val( this.getPosition().lng());
    });

    $('#latInput').keyup(function(event){
        var lat=$("#latInput").val();
        var lng=marker.getPosition().lng();
        marker.setPosition(new google.maps.LatLng(lat, lng));
        map.setCenter(new google.maps.LatLng(lat, lng)); 
    })

    $('#lngInput').keyup(function(event){
        var lat=marker.getPosition().lat();
        var lng=$("#lngInput").val();
        
        marker.setPosition(new google.maps.LatLng(lat, lng));
        map.setCenter(new google.maps.LatLng(lat, lng)); 
    })

    $('#coordsModal').on('shown.bs.modal', function() {
          var currentCenter = map.getCenter();  // Get current center before resizing
          google.maps.event.trigger(map, "resize");
          map.setCenter(currentCenter); // Re-set previous center
    });

    $('#saveCoordsBtn').on('click', function(){
        $.ajax({ 
                type: 'get',
                url: engineHost+'editMedia?mediaId='+photoId +'&gpsLat='+marker.getPosition().lat()+'&gpsLng='+marker.getPosition().lng(),
                dataType: 'jsonp',
                success: function(xhr,status){    
                    updateCoords(photoId,marker.getPosition().lat(), marker.getPosition().lng());
                    $.getJSON("config/status.json", function( data ) {
                        $('#statusMessage').removeClass().addClass('label').addClass('label-message').addClass("label-"+data.status['WAITING_RENDER'].level);
                        $('#statusMessage').html(data.status['WAITING_RENDER'].message);
                    });

                },
                error: function(xhr,status){
                    //ignoro
                }
        });
        

    })

}



function placeMarker(location, map) {
    var marker = new google.maps.Marker({
        position: location, 
        map: map,
        draggable:true
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
        $("#latInput").val( this.getPosition().lat());
        $("#lngInput").val( this.getPosition().lng());
    });
} 


// ********************************************************************************** HIDE-SHOW PHOTO DETAILS ******************************************************************************************

$('.DetailsBtn').click(function(){
    
        var $this = $(this);
        $this.toggleClass('SeeMore');
        if($this.hasClass('SeeMore')){
            $this.text('See More');         
        } else {
            $this.text('See Less');
        }
    });