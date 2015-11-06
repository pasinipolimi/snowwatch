
$(document).ready(function() {

    //activate the nav bar upload tab 
    $("#uploadpage").addClass("active");


    $("#input-21").fileinput({
      showCaption: false,
      previewFileType: "image",
      browseClass: "btn btn-sw",
      browseLabel: " Pick Image",
      browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
      removeClass: "btn btn-danger",
      removeLabel: " Delete",
      removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
      uploadClass: "btn btn-info",
      uploadLabel: " Upload",
      uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
    });

    var $form = $('#form1');
    var $fileSelect = $('#input-21');
    $form.on( 'submit', function(event) {
              event.preventDefault();
              
              var $btn = $('.btn.btn-info').button('loading');
              var $btn2 = $('.btn.btn-danger').prop('disabled', true);;
              var $btn3 = $('.btn.btn-success').prop('disabled', true);;

              var url = engineHost;
       
              var files = $fileSelect[0].files;
              var formData = new FormData();
              formData.append('uploadFile', files[0]);
              var userId= $("#swp_user_id").val();
              var mediaId="SWP"+makeid();
            
              var posting = $.ajax( {
                  url: 'https://cors-anywhere.herokuapp.com/'+url+'addShot?mediaId='+mediaId+'&tsShot='+(new Date()).toJSON()+"&thumbnails="+encodeURIComponent(JSON.stringify(thumbnails)),
                  data: formData,
                  processData: false,
                  contentType: false,
                  type: 'POST'
              } )
              .then( function( ) {
                  if(arguments[0].status!="OK"){
                      alert(translate("UPLOAD_UNABLE"));
                      console.log(arguments[0].error);
                  } else {
                   var posting = $.ajax( {
                      url: 'https://cors-anywhere.herokuapp.com/'+url+'addMedia?id='+mediaId+'&userId='+userId+'&type=P&source=SWP&mainShotId='+arguments[0].result.id,
                      
                      data: formData,
                      processData: false,
                      contentType: false,
                      type: 'GET'
                  })
                  .then ( function(){
                       if(arguments[0].status!="OK"){
                        alert(translate("UPLOAD_UNABLE"));
                          console.log(arguments[0].error);
                        } else {
                             //window.location='photo.php?args='+encodeURIComponent(JSON.stringify(arguments[0].result));
                             window.location='photo.php?photoId='+mediaId;
                        }
                  }).fail( function(){
                      alert(translate("UPLOAD_UNABLE"));
                      console.log(arguments);
                  })  
                  }       
              } )
              .fail( function() {
                  alert(translate("UPLOAD_UNABLE"));
                  console.log(arguments);
              });
    } );

});

