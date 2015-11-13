// recupera il primo url disponibile a partire da quello ottimo
function retrieveUrl(photo1, index){
	var urls = new Array();
	urls[0]=photo1.auxFileAbsUrlSmall;
	urls[1]=photo1.auxFileAbsUrlMedium;
	urls[2]=photo1.auxFileAbsUrlLarge;
	urls[3]=photo1.auxFileAbsUrlOriginal;
    var i = index;	
	while (! urls[i] && i<urls.length) {
    	i++;
	}
	return urls[i];
}


function goodMod(number, n) {
    return ((number%n)+n)%n;
}



function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for( var i=0; i < 5; i++ )
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}


function readQueryString(){
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
}

function cleanPage(msg){
	$('.swcontainer').html("<h4>Photo not exists</h4>");
    console.log(msg );
    $("#alert-msg").html(' <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '+msg);
    $("#alert-msg").addClass('alert-danger');
    $("#alert-msg").show();
    $('#alignment').hide();
}

function loadPhoto(queryString, callback){
	var photo;
	if(queryString.photoId){
		$("#alert-msg").html(' <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>' +translate("LOADING_MESSAGE"));
		$("#alert-msg").show();

	    $.ajax( {
	        //url: 'https://cors-anywhere.herokuapp.com/'+engineHost+'searchMedia?ids[]='+queryString.photoId,
	        url: engineHost+'searchMedia?detailLevel=full&ids[]='+queryString.photoId,
	        dataType: 'jsonp',
	        
	    })
	    .then ( function(){
	        if(arguments[0].status=="OK"){
	        	
	            if(arguments[0].result[0]){
	                photo=arguments[0].result[0];
	                $("#alert-msg").hide();
	                $('#alignment').show();
	                $('warpingArea').show();
	                callback( photo );
	            } else {
	            	cleanPage(translate("PHOTO_INVALID_ID"));
	            }
	        } else{
                cleanPage(translate("PHOTO_ERROR_READING"));
	        }
	    })
	    .fail(function(){
	        cleanPage(translate("PHOTO_ERROR_READING"));
	    });
	} else {
	    photo=decodeURIComponent(queryString.args);
	}   
	return photo;
}