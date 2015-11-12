

$(function(){
	$("#alert-msg").hide();
	$('#alignment').hide();
	$('warpingArea').hide();

    loadPhoto(readQueryString(),function (photo) {
        tzacco(photo);
    });
 });



function tzacco (photo){
	var fov = photo.hFov ? photo.hFov: 20;

	$('#sliderZoom').noUiSlider({
	    start: [ 50 ],
	    step: 0.1, //di quanto posso saltare
	    //margin: 20,
	    

	    format: wNumb({
	      mark: '.',
	      decimals: 1
	    }),
	  
	    behaviour: 'tap-drag',

	    range: {
	      'min': 10,
	      'max': 360
	    }
	  });

	 $('#sliderZoom').noUiSlider_pips({
	    mode: 'values',
		values: [10, 20, 40,  60,  80,  100, 120,  140,  160,  180, 200,  220,  240,  260,  280,  300,  320,  340,  360],
		density: 0.5
	  });

	$("#sliderZoom").Link('lower').to($('#zoominput'));

	$("#sliderZoom").val(fov);
	$('#zoomPluBtn').click(function(){
		var newfov=(parseFloat($('#zoominput').val())+0.1).toFixed(1)
		$('#zoominput').val(newfov);
		$("#sliderZoom").val(newfov);
	});
	$('#zoomMinBtn').click(function(){
		var newfov=(parseFloat($('#zoominput').val())-0.1).toFixed(1)
		$('#zoominput').val(newfov);
		$("#sliderZoom").val(newfov);
	});


	$('#continueBtn').click(function(){
		window.location.href="photo.php?photoId="+photo.id;
	});

	

	var instructionsContent = {
				instructionsHTMLContent : "<div class='p'>"+
				"<div class='step1'><span class='step-index'>1.- </span>1</div>"+
				"<div class='step2'><span class='step-index'>2.- </span>2</div>"+
				"<div class='step3'><span class='step-index'>3.- </span>3</div>"+
				"</div>"
			};

	var photoScaleFactor = fov * photo.auxRender.hSize / 360 / photo.hSize;
	var initialPosition = {"x": photo.auxRender.hSize / 2, "y": photo.auxRender.vSize / 2};
	if (photo.auxAlignment) {
		initialPosition.x = goodMod(photo.auxAlignment.centerAzimuth - photo.auxRender.centerAzimuth + 180, 360) * photo.auxRender.hSize / 360;
		initialPosition.y = goodMod(photo.auxRender.vSize / photo.auxRender.hSize * 360 / 2 - photo.auxAlignment.centerPitch + photo.auxRender.centerPitch, 360) * photo.auxRender.hSize / 360;
	}
			
	var data = {"urlRender": photo.auxRender.auxFileAbsUrl,
				"urlImage": "./php/image_proxy.php?url="+encodeURIComponent(photo.auxFileAbsUrlOriginal),
				"photoId": photo.id,
				"photoScaleFactor": photoScaleFactor,
				"idRender": photo.auxRender.id,
				"initialPosition": initialPosition,
				"hSizeRender":photo.auxRender.hSize,
				"hSizePhoto":photo.hSize,
				"originalPhotoScaleFactor": photoScaleFactor
				};

	var options = $.extend(data, instructionsContent);
	options = $.extend(data, {peaks: photo.auxRenderPeaks});

	$("#fine").append(options.urlImage);
	$(".warpingArea").warpingMatcher(options);
}