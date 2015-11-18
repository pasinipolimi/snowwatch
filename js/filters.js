var isResizing = false,
  lastDownX = 0;

$(function(){
//init


  $('.selector').click(function() {
    if($(this).hasClass('sw-active')){
      $(this).removeClass('sw-active');
      $(this).addClass('sw-inactive');
    } else {
      $(this).removeClass('sw-inactive');
      $(this).addClass('sw-active');
    }
    reloadGallery();
  });



  $('.switcher').click(function() {
    if($(this).hasClass('sw-active')){
      $(this).removeClass('sw-active');
      $(this).addClass('sw-inactive');
      $(this).siblings('.switcher').addClass('sw-active');
      $(this).siblings('.switcher').removeClass('sw-inactive');
    } else {
      $(this).removeClass('sw-inactive');
      $(this).addClass('sw-active');
      $(this).siblings('.switcher').addClass('sw-inactive');
      $(this).siblings('.switcher').removeClass('sw-active');
    }
    reloadGallery();
  });



  
  $('#alt_btn').on('click', function (e) {
    if($(this).hasClass('alt_btn_off')){
      //accendo
      $(this).removeClass('alt_btn_off');
      $(this).addClass('alt_btn_on');
      $(this).parent().removeClass('alt_lb_off');
      $('#right_panel').addClass('right_panel_on');
      $('#right_panel').removeClass('right_panel_off');
    } else {
      //spengo
      $(this).removeClass('alt_btn_on');
      $(this).addClass('alt_btn_off');
      $(this).parent().addClass('alt_lb_off');
      $('#right_panel').removeClass('right_panel_on');
      $('#right_panel').addClass('right_panel_off');
    }

    reloadGallery();
  });
  


  var container = $('#containeralt'),
      right = $('#right_panel'),
      handle = $('#drag');
      top_right = $('#top_panel'),
      top_handle = $('#top_drag');
      number_down= $('#number_down');
      number_up= $('#number_up');

  handle.on('mousedown', function (e) {
      isResizing = true;
      isResizing_down = true;
      lastDownX = e.clientX;
  });

  top_handle.on('mousedown', function (e) {
      isResizing = true;
      isResizing_top = true;
      lastDownX = e.clientX;
  });

  $(document).on('mousemove', function (e) {
      // we don't want to do anything if we aren't resizing.
      if (!isResizing) 
          return;
      
      var offsetRight = container.width() - (e.clientX - container.offset().left);

      var offLeft= 240-offsetRight;
      var x= (offLeft*5)/240;
      if(isResizing_down){
        if(offsetRight-top_right.width()<20){
      return;
        }
        if(offsetRight>240){
      return;
        }
        right.css('width', offsetRight);
        right.css('background-position', offsetRight);  
        number_down.css('right', offsetRight-8);
        number_down.html(x.toFixed(1));
      } else {
        if(right.width()-offsetRight<20){
      return;
        }
        if(offsetRight<0){
      return;
        }
        top_right.css('width', offsetRight);
        top_right.css('background-position', offsetRight);  
        number_up.css('right', offsetRight-8);
        number_up.html(x.toFixed(1));
      }
      
  }).on('mouseup', function (e) {
      // stop resizing
      if(isResizing){
        reloadGallery();
        isResizing = false;
        isResizing_down=false;
        isResizing_top=false;
      }
      
  });


  
  

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
    

    var peaks = new Bloodhound({
      datumTokenizer: function(d) {
              return Bloodhound.tokenizers.whitespace(d.name);
          },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: list
    });



    $('#tag2').tagsinput({
      itemValue: 'id',
      itemText: 'name',
      typeaheadjs: {
        name: 'peaks',
        displayKey: 'name',
        source: peaks.ttAdapter()
      }
    });

    $('#tag2').on('itemAdded', function(event) {
      
      reloadGallery();
    });

}




function computeFilterString(){
  
  
  var filters="";
  
  if($('#checkwc2').hasClass('sw-inactive') && $('#checkp2').hasClass('sw-inactive')){
    //both inactive, return;
    return "empty";
  }

  if(!($('#checkwc2').hasClass('sw-active') && $('#checkp2').hasClass('sw-active'))){
    if($('#checkwc2').hasClass('sw-active')){
      filters+="types[]=W&";
    }
    if($('#checkp2').hasClass('sw-active')){
      filters+="types[]=P&";
    }
  }

  

  /*if($('#datediv').hasClass('in')){
      if($('#daterange').data('daterangepicker').startDate._isValid){
        filters+="tsShotMin="+  $('#daterange').data('daterangepicker').startDate.toISOString()+"&";  
      }
      if($('#daterange').data('daterangepicker').endDate._isValid){
      filters+="tsShotMax=" + $('#daterange').data('daterangepicker').endDate.toISOString()+"&";  
      }  
  }*/

  
  if($('#mine').hasClass('sw-active')){
    var userId= $("#swp_user_id").val();
    filters+="userIds[]="+userId+"&"; 
  }


  if($('#alt_btn').hasClass('alt_btn_on')){
      filters+="gpsAltMin="+parseFloat($("#number_down").html())*1000+"&";   
      filters+="gpsAltMax="+parseFloat($("#number_up").html())*1000+"&";
  }
  

  var tags = $("#tag2").tagsinput('items');
  for (var i = 0; i < tags.length; i++) {
      var t= tags[i];
      filters+="peakIds[]="+t.id+"&";   
  }

 
  
  

  return filters;
}






