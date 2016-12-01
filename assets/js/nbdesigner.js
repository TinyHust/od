jQuery(document).ready(function () {
    
    var width = jQuery(window).innerWidth();
    var height = jQuery(window).height();
    var w = -width;
    var h = -height;
    jQuery('#container-online-designer').css({'width': width, 'height': height, 'top': h, 'opacity': 0, 'bottom': 0});
    jQuery('#triggerDesign').on('click', function () {
        jQuery('#container-online-designer').addClass('show');
        jQuery('#container-online-designer').stop().animate({
            top: 0,
            opacity: 1,
            bottom: 0
        }, 500);
    });
    jQuery('#closeFrameDesign').on('click', function () {
        hideDesignFrame();
    });
    hideDesignFrame = function (mes) {
        var _h = -jQuery(window).height();
        jQuery('#container-online-designer').stop().animate({
            top: _h,
            opacity: 0
        }, 500);
        if (mes != null) {
            setTimeout(function () {
                alert(mes);
            }, 700);
        }
    };
});
jQuery(window).on('resize', function () {
    var width = jQuery(window).width(),
            height = jQuery(window).height();
    jQuery('#container-online-designer').css({'width': width, 'height': height});
});
var NBDESIGNERPRODUCT = {
    insert_customer_design: function (data) {

    },
    hide_iframe_design: function () {
        console.log('something');
        var height = -jQuery(window).height();
        jQuery('#container-online-designer').removeClass('show');
        jQuery('#container-online-designer').stop().animate({
            top: height,
            opacity: 0
        }, 500);
    },
    show_design_thumbnail: function (arr) {
        var html = '<h4>Preview your design</h4>';
        jQuery.each(arr, function (key, val) {
            html += '<img style="width: 60px; height: 60px; display: inline-block;" src="' + val + '" />'
        });
        jQuery('#nbdesigner_frontend_area').html('');
        jQuery('#nbdesigner_frontend_area').append(html);
    },
    nbdesigner_ready: function(){
        jQuery('.nbdesign-button').removeClass('nbdesigner-disable');
        jQuery('.nbdesign-button-loading').addClass('nbdesigner-disable');
    }
};