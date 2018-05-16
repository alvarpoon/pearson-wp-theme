/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
	  //console.log('JS!');
	  function initMultipleDownload(){
		  $('.multiple_download').each(function(){
			$(this).find('.multiple_dl_header').click(function(){
				if(!$(this).parent().hasClass('opened')){
					$(this).parent().addClass('opened');	
				}
			});
		  });
		  
		  $(window).on('click touchend', function(event) {
			var target = $(event.target);
			if (target.parents('div.multiple_download').length) {
				console.log('it is in multiple_download');	
			}else{
				if($('.multiple_download').hasClass('opened')) {
					$('.multiple_download').removeClass('opened');
				}		
			}				
		  });
	  }
	  
	  $(document).ready(function(){
		initMultipleDownload();						 
	  });
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
	  function initSlider(){
		  if($('.home-slider').length > 0){
			  $('.home-slider').slick({
				dots: true,					  
			  });
		  }
	  }
	  
	  $(document).ready(function(){
		initSlider();						 
	  });
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
