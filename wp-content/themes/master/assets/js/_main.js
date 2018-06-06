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
	  
	  function initNavbarToggle(){
		$('.navbar-toggle').click(function(){
			console.log('clicked');
			if($(this).hasClass('collapsed')){
				console.log('remove class');
				$(this).removeClass('collapsed');	
			}else{
				console.log('add class');
				$(this).addClass('collapsed');		
			}
		});  
	  }
	  
	  $(document).ready(function(){
		initMultipleDownload();			
		initNavbarToggle();
		
		$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault(); 
			event.stopPropagation(); 
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
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
				arrows: false
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
  },
  page_template_template_resource:{
	init: function() {
		$('document').ready(function(){
			initAudioSetup();
			createZip();
		});
	}
  },
  page_template_template_resource_list:{
	init: function() {
		$('document').ready(function(){
			initAudioSetup();
		});
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

function createZip(){
	$('.createzip').click(function(){
		console.log('in createZip');
		var ajaxurl = '/wp-admin/admin-ajax.php';
		
		var filepath = $(this).attr('data-file');
		var filename = $(this).attr('data-filename');
		
		var data = {
			filepathdata: filepath,
			filenamedata: filename,
			action: 'create-zip'
		};
		
		$.post(ajaxurl, data, function(response) {
			
	    }).done(function(response){
			console.log('createzip done');
			console.log(response);
			//window.location = response;
	    }).fail(function(response){
			console.log('createzip fail');
	    });
		
	});
}

function initAudioSetup(){
	function stopAllAudio(obj){
		$('.audio_playback').each(function(){
			if($(obj) !== $(this)){
				var audio = $(this).find('.player audio').get(0);
			
				audio.pause();
				
				$(this).find(".playtoggle").removeClass('playing');
			}
		});
	}
	
	function initAudioPlayer(obj, source){	
		var supportsAudio = !!document.createElement('audio').canPlayType,
				audio,
				loadingIndicator,
				positionIndicator,
				timeleft,
				loaded = false,
				manualSeek = false;
	
		if (supportsAudio) {
			
			//var episodeTitle = $('body')[0].id;
			
			var player = '<p class="player">';
			player += '<span class="playtoggle"><a href="javascript:;">Listen</a></span>';
			player += '<span class="gutter">';
			player += '<span class="loading" />';
			player += '<span class="handle ui-slider-handle" />';
			player += '</span>';
			player += '<span class="timeleft" />';
			player += '<audio preload="metadata">';
			player += '<source src="' + source + '" type="audio/wav"></source>';
			player += '</audio>';
			player += '</p>';
			
			$(player).appendTo(obj);
			
			/*audio = $('.player audio').get(0);
			loadingIndicator = $('.player .loading');
			positionIndicator = $('.player .handle');
			timeleft = $('.player .timeleft');*/
			
			audio = $(obj).find('.player audio').get(0);
			loadingIndicator = $(obj).find('.player .loading');
			positionIndicator = $(obj).find('.player .handle');
			timeleft = $(obj).find('.player .timeleft');
			
			
			//timeleft.text('-' + mins + ':' + (secs < 10 ? '0' + secs : secs) + '/' + fl_mins + ':' + (fl_secs < 10 ? '0' + fl_secs : fl_secs));
			
			if ((audio.buffered !== undefined) && (audio.buffered.length !== 0)) {
				$(audio).bind('progress', function() {
					var loaded = parseInt(((audio.buffered.end(0) / audio.duration) * 100), 10);
					loadingIndicator.css({width: loaded + '%'});
				});
			}
			else {
				loadingIndicator.remove();
			}
			
			$(audio).bind('timeupdate', function() {
				
				var rem = parseInt(audio.duration - audio.currentTime, 10),
						pos = (audio.currentTime / audio.duration) * 100,
						mins = Math.floor(rem/60,10),
						secs = rem - mins*60;
						
				var full_length = audio.duration,
					fl_mins = Math.floor(full_length/60,10),
					fl_secs = Math.floor(full_length-fl_mins*60,10);
				
				timeleft.text('-' + mins + ':' + (secs < 10 ? '0' + secs : secs) + '/' + fl_mins + ':' + (fl_secs < 10 ? '0' + fl_secs : fl_secs));
				if (!manualSeek) { positionIndicator.css({left: pos + '%'}); }
				if (!loaded) {
					loaded = true;
					
					$('.player .gutter').slider({
							value: 0,
							step: 0.01,
							orientation: "horizontal",
							range: "min",
							max: audio.duration,
							animate: true,					
							slide: function(){							
								manualSeek = true;
							},
							stop:function(e,ui){
								manualSeek = false;	
								audio.currentTime = ui.value;
							}
						});
				}
				
			}).bind('play',function(){
				$(obj).find(".playtoggle").addClass('playing');		
			}).bind('pause ended', function() {
				$(obj).find(".playtoggle").removeClass('playing');		
			});		
			
			$(obj).find(".playtoggle").click(function() {
				if (audio.paused) {
					stopAllAudio(obj);
					audio.play();
				} 
				else { 
					audio.pause();
				}	
			});
		}
	}
	
	$('.audio_playback').each(function(){
		var source = $(this).attr('data-source');
		//console.log(source);
		initAudioPlayer($(this), source);
	});
}

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
