/* ------------------------------------------------
   UnitedThemes function for fancyCaptions
------------------------------------------------ */
 jQuery.fn.fancyCaption = function(settings) {
		settings = jQuery.extend({
		    slideTopBar: '.slide-top',	    // class for top bar caption. set to false to disable top bar slide
		    slideLeftBar: '.slide-left',    // class for top bar caption. set to false to disable top bar slide
		    slideBottomBar: '.slide-bottom',// class for bottom bar caption. set to false to disable bottom bar slide
		    slideRightBar: '.slide-right',  // class for bottom bar caption. set to false to disable bottom bar slide
		    slideTimeIn: 300,		    // time in ms to slide in top/bottom captions
		    slideEasingIn: 'swing',	    // slide in easing
		    slideTimeOut: 500,		    // time in ms to slide out top/bottom captions
		    slideEasingOut: 'swing',	    // slide out easing

		    fadeElement: '.fade',	    // class of the fade element
		    fadeTimeIn: 500,		    // time in ms to fade in overlay container
		    fadeEasingIn: 'swing',	    // fade in easing
		    fadeTimeOut: 500,		    // time in ms to fade out overlay container
		    fadeEasingOut: 'swing',	    // fade out easing
		    fadeFrom: 1,		    // final opacity the overlay container fades to (0=none, 1=full transparency)
		    fadeTo: 0.5			    // final opacity the overlay container fades to (0=none, 1=full transparency)
		}, settings);

		return this.each( function(){
		    if( settings.fadeElement ) jQuery(this).find(settings.fadeElement).stop().animate({ opacity: settings.fadeFrom }, 0 ).nextAll();

		    if( settings.slideTopBar ) jQuery(this).find(settings.slideTopBar).css('top', '-'+jQuery(this).find(settings.slideTopBar).outerHeight()+'px');
		    if( settings.slideRightBar ) jQuery(this).find(settings.slideRightBar).css('right', '-'+jQuery(this).find(settings.slideRightBar).outerWidth()+'px');
		    if( settings.slideBottomBar ) jQuery(this).find(settings.slideBottomBar).css('bottom', '-'+jQuery(this).find(settings.slideBottomBar).outerHeight()+'px');
		    if( settings.slideLeftBar ) jQuery(this).find(settings.slideLeftBar).css('left', '-'+jQuery(this).find(settings.slideLeftBar).outerWidth()+'px');

		    if( settings.slideBottomBar || settings.slideTopBar || settings.slideRightBar || settings.slideLeftBar || settings.fadeElement ){
			jQuery(this).hover(
			    function () {
				if( settings.fadeElement ) jQuery(this).find(settings.fadeElement).first().stop().animate({ opacity: settings.fadeTo }, settings.fadeTimeIn, settings.fadeEasingIn );
				if( settings.slideTopBar ) jQuery(this).find(settings.slideTopBar).stop().show().animate({ top: '-2px' }, settings.slideTimeIn, settings.slideEasingIn);
				if( settings.slideRightBar ) jQuery(this).find(settings.slideRightBar).stop().show().animate({ right: '0' }, settings.slideTimeIn, settings.slideEasingIn);
				if( settings.slideBottomBar ) jQuery(this).find(settings.slideBottomBar).stop().show().animate({ bottom: '0' }, settings.slideTimeIn, settings.slideEasingIn);
				if( settings.slideLeftBar ) jQuery(this).find(settings.slideLeftBar).stop().show().animate({ left: '0' }, settings.slideTimeIn, settings.slideEasingIn);
			    },
			    function () {
				if( settings.fadeElement ) jQuery(this).find(settings.fadeElement).first().stop().animate({ opacity: settings.fadeFrom }, settings.fadeTimeOut, settings.fadeEasingOut);
				if( settings.slideTopBar ) jQuery(this).find(settings.slideTopBar).stop().animate({ top: '-'+jQuery(this).find(settings.slideTopBar).outerHeight() }, settings.slideTimeOut, settings.slideEasingOut, function(){ jQuery(this).children(settings.slideTopBar).hide() });
				if( settings.slideRightBar ) jQuery(this).find(settings.slideRightBar).stop().show().animate({ right: '-'+jQuery(this).find(settings.slideRightBar).outerWidth() }, settings.slideTimeIn, settings.slideEasingOut);
				if( settings.slideBottomBar ) jQuery(this).find(settings.slideBottomBar).stop().animate({ bottom: '-'+jQuery(this).find(settings.slideBottomBar).outerHeight() }, settings.slideTimeOut, settings.slideEasingOut, function(){ jQuery(this).children(settings.slideBottomBar).hide() });
				if( settings.slideLeftBar ) jQuery(this).find(settings.slideLeftBar).stop().show().animate({ left: '-'+jQuery(this).find(settings.slideLeftBar).outerWidth() }, settings.slideTimeIn, settings.slideEasingOut);
			    }
			);
		    }
		});
	    };

/* ------------------------------------------------
   UnitedThemes image fade
------------------------------------------------ */
jQuery.fn.imageFade = function(settings) {
		settings = jQuery.extend({
		    fadeTimeIn: 500,		    // time in ms to fade in overlay container
		    fadeEasingIn: 'swing',	    // fade in easing
		    fadeTimeOut: 500,		    // time in ms to fade out overlay container
		    fadeEasingOut: 'swing',	    // fade out easing
		    fadeTo: 0.5			    // final opacity the overlay container fades to (0=none, 1=full transparency)
		}, settings);
		return this.each( function(){
		    jQuery(this).hover(function(){
			jQuery(this).stop().animate({opacity:settings.fadeTo},settings.fadeTimeIn,settings.fadeEasingIn);
		    },function(){
			jQuery(this).stop().animate({opacity:1},settings.fadeTimeOut,settings.fadeEasingOut);
		    });
		});
	    };

/* ------------------------------------------------
   function for simple hover effects
------------------------------------------------ */
jQuery.fn.opacity = function(settings) {
settings = jQuery.extend({
         startop: 0.5,
         midop: 0.8,
         endop: 1
			}, settings);
	jQuery(this).mouseenter(function () {

		jQuery(this).find('p').animate({opacity: settings.startop }, {queue:false, duration: 400});
		jQuery(this).find('a').show().animate({opacity: settings.endop }, {queue:false, duration: 400});


	}).mouseleave(function () {

		jQuery(this).find('p').animate({opacity: settings.endop }, {queue:false, duration: 400});
		jQuery(this).find('a').hide().animate({opacity: settings.startop }, {queue:false, duration: 400});

	});
};