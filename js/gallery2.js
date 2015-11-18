

//$(function (slice, filters) {
function uploadGallery( slice, filters, linksid, excluding ){
 //   'use strict';
    // Load demo images from flickr:
    if(filters=="empty"){
        var linksContainer = $(linksid).empty();
        linksContainer.append(nomedia);
        return;
    }
    
    $.ajax({
        url: engineHost+'searchMedia?'+filters+'limitRows='+slice,
        dataType: 'jsonp'
    }).done(function (result) {
        var linksContainer = $(linksid).empty();
        var baseUrl;
        if(result.result.length==0){
            linksContainer.append(nomedia);
            return;
        }
        
        $.each(result.result.slice(0,slice), function (index, photo) {

            if($.inArray(photo.id, excluding) == -1){
                    baseUrl=retrieveUrl(photo, 0);
                    
                    var newnode=$('<div/>').append(
                        $('<a/>').append(
                            $('<img> ')
                            .prop('src', baseUrl)
                            .prop('style', "background: rgb(255, 255, 255);")
                            .attr('p_id', photo.id)
                            .attr('src_large',retrieveUrl(photo, 3))
                        ).prop('href', "#" ).addClass('ancore'))
                    .prop('class','preview_thumb_area' );

                    linksContainer.append(newnode);
            }

        });

        if(linksContainer.children().size()==0){
            linksContainer.append(nomedia);
            return;
        }

        
        $(".ancore").on("click", function() {
            var photoId = $(this).children('img').attr('p_id');
            window.location.href="photo.php?photoId="+photoId;
        }); 
    });

};
