/**
 * @package   Fixed Circular Navigation Menu
 * @author    Enrique Crespo Molera <contact@e-crespo.com>
 * @license   GPL-2.0+
 * @link      http://wordpress-fixed-circular-nav.e-crespo.com
 * @copyright 2014 Enrique Crespo Molera
 */

/**
 * Main javascript file
 * @package circular-nav.js
 * @author  Enrique Crespo Molera <contact@e-crespo.com>
 */
jQuery(document).ready(function($) {
        
        /* Click handling */
        
        $('#cn-wrapper').click(function(e){
		e.stopPropagation();
	});

	$('#cn-button').click(function(e){
		if (!e) var e = window.event;
		e.stopPropagation();

		if(!$('#cn-wrapper').hasClass('opened-nav')){
                    openCnNav();
	  	}
	 	else{
                    closeCnNav();
	  	}

	});

	function openCnNav(){
            changeCnBtnContent('open');
	    $('#cn-overlay').addClass('on-overlay');
	    $('#cn-wrapper').addClass('opened-nav');
	}

	function closeCnNav(){
            changeCnBtnContent('close');
            $('#cn-overlay').removeClass('on-overlay');
            $('#cn-wrapper').removeClass('opened-nav');
	}

	$('#cn-overlay').click(function(){
		closeCnNav();
	});
        
        
        /* User agent detections and adding some classes to the output */
        
        var nua = navigator.userAgent;
        if( (nua.match(/Trident.*rv:11\./)) || (nua.match(/MSIE 10/)) ) {
            $('#circular-nav').addClass('cn-ie');
        }
        var is_android_stock_browser = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));
        if (is_android_stock_browser){
            $('#circular-nav').addClass('cn-asb');
            
            $(window).scroll(function () {
                if ( $(this).scrollTop() > 30 ){
                    $('.cn-wrapper').addClass('top-position');
                    $('.cn-button').addClass('top-position');
                }else{
                    $('.cn-wrapper').removeClass('top-position');
                    $('.cn-button').removeClass('top-position');
                }
            });
        }
        
        var isOldAndroidStockBrowser = ( (/android [1-3]/i.test( nua )) && !(nua.indexOf('Chrome') > -1) );
        if (isOldAndroidStockBrowser) {
            $('#circular-nav').addClass('cn-old-asb');
        }else if ( nua.indexOf('Opera Mini') > -1 ){
            $('#circular-nav').addClass('cn-old-asb');
        }else if ( (nua.match(/MSIE 7/)) || (nua.match(/MSIE 8/)) ){
            $('#circular-nav').addClass('cn-old-ie');
        }else{
            $('#circular-nav').addClass('cn-modern');
        }
       
        
        /* Back-forward cache displacement bug fix */
        
        $.ajaxSetup ({
            cache: false
        });
        
        var loadUrl = CircularNav.pluginViewsDir + "cn-elements.html";
        var loadJsUrl = CircularNav.pluginJsDir + "jsload.js";
        
        $('#cn-wrapper').load(loadUrl);
        $.getScript(loadJsUrl);
       
        
        $(window).on("pageshow", function(eventsh){
              if (eventsh.originalEvent.persisted) {
                  $('#cn-wrapper').load(loadUrl);
                  $.getScript(loadJsUrl);
              }
	 });
         $(window).on("pagehide", function(eventhi){
              if (eventhi.originalEvent.persisted) {
                if($('#cn-wrapper').hasClass('opened-nav')){
                    closeCnNav();
	  	}
              }
	 });
                 
});