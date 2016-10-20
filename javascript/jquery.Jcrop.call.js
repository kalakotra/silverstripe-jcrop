jQuery(document).ready(function($){

  var jcrop_api;
  

  if(jQuery('#Form_EditForm_jCropXY').val() != "") {
    $('#target').Jcrop({
      onChange:   showCoords,
      onSelect:   showCoords,
      onRelease:  clearCoords,
      setSelect: [jQuery("#x1_field").val(), jQuery("#y1_field").val(), jQuery("#x2_field").val(), jQuery("#y2_field").val()]
    },function(){
      jcrop_api = this;
    });
    
  } else {
    $('#target').Jcrop({
      onChange:   showCoords,
      onSelect:   showCoords,
      onRelease:  clearCoords
    },function(){
      jcrop_api = this;
    });
  }

  $('.dimensions a').click(function(e) {
    if ($(this).hasClass("active")) {
      $(this).removeClass();
      jcrop_api.setOptions({ aspectRatio: 0 });
      jcrop_api.focus();
    } else {
      $(".dimensions a").removeClass("active");
      $(this).addClass("active");
      var myWidth = $(this).attr("data-ref-width");
      var myHeight = $(this).attr("data-ref-height");
      jcrop_api.setOptions({ aspectRatio: myWidth/myHeight });
      jcrop_api.focus();
    }
    
  });

});

// Simple event handler, called from onChange and onSelect
// event handlers, as per the Jcrop invocation above
function showCoords(c)
{

  jQuery("#Form_EditForm_jCropXY").val(c.x+","+c.y+","+c.x2+","+c.y2+","+c.w+","+c.h);
};

function clearCoords()
{
  jQuery('#Form_EditForm_jCropXY').val('');
};