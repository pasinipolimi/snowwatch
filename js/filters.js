

$(function(){
//init

  //TYPE
  $('.btn-group').button();
  // $('.btn-group label').eq(0).button('toggle').find(':checkbox').prop('checked');
  // $('.btn-group label').eq(1).button('toggle').find(':checkbox').prop('checked');
  // $('#checkwc2lbl').button('toggle').find(':checkbox').prop('checked');
  // $('#checkp2lbl').button('toggle').find(':checkbox').prop('checked');

  // $('#checkwc2lbl').button('toggle').find(':checkbox').prop('checked', false);
  //$('#checkwc2lbl').button('toggle').find(':checkbox').removeProp('checked');
  //$('#checkp2lbl').button('toggle').find(':checkbox').removeProp('checked');


  // $(".btn-group").change(function (e) {
    
  //   if( $('#checkwc2').is(':checked')|| $('#checkp2').is(':checked') ) {
  //     reloadGallery(); 
  //   } else {
  //     debugger;
  //     //both unchecked: notify
  //     alert("Select at least one type"); 
  //     $(e.target).parent().button('toggle').find(':checkbox').toggleClass('checked');
  //   } 
  // });


  $('#selector label').click(function() {
    
    if( $(this).hasClass('active')){
      //lo voglio disattivare
        if( $($(this).siblings()[0]).hasClass('active') ){
          //the other one is active
          $(this).removeClass('active');
          reloadGallery(); 
        } else {
          alert("Select at least one type"); 
          
        }
    } else {
      $(this).addClass('active');
      reloadGallery(); 
    }
    
});


  //AUTHOR
  $(".filters input[name='author-checkbox']").bootstrapSwitch();
  $(".filters input[name='author-checkbox']").on('switchChange.bootstrapSwitch', function(event, state) {
       reloadGallery(); 
  });


  //ALTITUDE
  $('#sliderAlt').noUiSlider({
    start: [ 2.0, 4.0 ],
    step: 0.5, //di quanto posso saltare
    //margin: 20,
    connect: true,

    format: wNumb({
      mark: ',',
      decimals: 1
    }),
  
    behaviour: 'tap-drag',

    range: {
      'min': 0,
      'max': 5.0
    }
  });

  $('#sliderAlt').noUiSlider_pips({
    mode: 'steps',
    density: 0.1, //ogni quanto metto un trattino
    format: wNumb({
      mark: ',',
      decimals: 1
    }),
  });

  $("#sliderAlt").on({
    set: function(){
      reloadGallery();
    }
  });

  //$('#sliderAlt').attr('disabled', 'disabled');

  
  

  //DATA
  
    $('#daterange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: '01/01/2012',
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: moment(),
        dateLimit: { years: 100 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Last 6 Months': [moment().subtract(6, 'month').startOf('month'), moment().endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
      debugger;
        $('#daterange span').html((start._isValid ? start.format('MMM D, YYYY'):"") +" - "+ ( end._isValid ? end.format('MMM D, YYYY'):""));
        reloadGallery();
    });
    $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
        //$('#daterange').val('').daterangepicker('update');;
        $('#daterange').data('daterangepicker').setStartDate('01/01/2012');
        $('#daterange').data('daterangepicker').setEndDate(moment());
        $('#daterange span').html('');
        reloadGallery();
    });
    
   getPeaks();

    $('.collapseFilter').on('shown.bs.collapse', function() {
        $(this).prev().find('.glyphicon').addClass('glyphicon-chevron-up').removeClass('glyphicon-chevron-down');
        reloadGallery();
      });

    $('.collapseFilter').on('hidden.bs.collapse', function() {
        $(this).prev().find('.glyphicon').addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-up');
        reloadGallery();
    });


})  




function checkTypes(){
  
}





function getPeaks(){
    if (sessionStorage.peaks) {
        configPeaksTag(JSON.parse(sessionStorage.peaks));
    } else {
        $.ajax({
              url: engineHost+'getPeaks',
              dataType: 'jsonp',
              success: function(result) {
                  if(result.status == "OK"){
                      sessionStorage.peaks = JSON.stringify(result.result);
                      pl=result.result;
                      configPeaksTag(pl);
                  } else {
                      configPeaksTag([]);
                  }
              },
              error: function(){
                configPeaksTag([]);
              },
              async:   false
        });          
    }

  }


function configPeaksTag(list){
    

    var listMap = {};
    list.forEach( function( item ) {
      listMap[ item.name ] = item;
    } );

    var ItemManager = $.fn.textext.ItemManager;
    var myIM = ItemManager;

    myIM.prototype.itemToString = function( item ) {
      return item.name;
    };
    myIM.prototype.stringToItem = function( string ) {
      return listMap[ string ];
    }
    myIM.prototype.itemContains = function( item, needle ) {
      return this.itemToString(item).toLowerCase().indexOf(needle.toLowerCase()) > -1;
    }
    $('#peaksTA')
        .textext( {
          plugins : 'autocomplete tags filter',
          itemManager: myIM,
          ext: {
              tags: {
                  addTags: function(tags)
                  { 
                    
                    $.fn.textext.TextExtTags.prototype.addTags.apply(this, arguments);
                    if(tags!=null){
                        reloadGallery();
                    }
                      
                  },
                  removeTag: function(tag)
                  {
                      
                      $.fn.textext.TextExtTags.prototype.removeTag.apply(this, arguments);
                      reloadGallery();

                  },
                  isTagAllowed : function(tag) {
                      if(typeof tag == 'undefined'){
                          return false;
                      }
                      var tags = JSON.parse($('#peaksTA').textext()[0].hiddenInput().val());
                      for (var i = 0; i < tags.length; i++) {
                          var t= tags[i];
                          if(t.name==tag.name){
                              return false;
                          }
                      }
                      return $.fn.textext.TextExtTags.prototype.isTagAllowed.apply(this, arguments);;
                  }  

              }
          }
        })
          .bind('getSuggestions', function(e, data){
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || '';
                $(this).trigger(
                    'setSuggestions',
                    { result : textext.itemManager().filter(list, query) }
                );
          });

}




function computeFilterString(){
  
  
  var filters="";
  

  if(!($('#checkwc2').hasClass('active') && $('#checkp2').hasClass('active'))){
    if($('#checkwc2').hasClass('active')){
      filters+="types[]=W&";
    }
    if($('#checkp2').hasClass('active')){
      filters+="types[]=P&";
    }
  }

  

  if($('#datediv').hasClass('in')){
      if($('#daterange').data('daterangepicker').startDate._isValid){
        filters+="tsShotMin="+  $('#daterange').data('daterangepicker').startDate.toISOString()+"&";  
      }
      if($('#daterange').data('daterangepicker').endDate._isValid){
      filters+="tsShotMax=" + $('#daterange').data('daterangepicker').endDate.toISOString()+"&";  
      }  
  }

  
  
  if(! $('#switch-onText').bootstrapSwitch('state')){
   var userId= $("#swp_user_id").val();
   filters+="userIds[]="+userId+"&";   
  }

  if($('#sliderAltDiv').hasClass('in')){
      filters+="gpsAltMin="+parseFloat($("#sliderAlt").val()[0])*1000+"&";   
      filters+="gpsAltMax="+parseFloat($("#sliderAlt").val()[1])*1000+"&";
  }
  

  if($('#peaksdiv').hasClass('in')){
     var tags = JSON.parse($('#peaksTA').textext()[0].hiddenInput().val());
        for (var i = 0; i < tags.length; i++) {
            var t= tags[i];
            filters+="peakIds[]="+t.id+"&";   
        }
  }
 
  
  

  return filters;
}






