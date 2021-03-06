jQuery(function($){
	$(document).ready(function(){

		/*commentscroll*/
		$(".comment-scroll a").click(function(event){
			event.preventDefault();
			$('html,body').animate({ scrollTop:$(this.hash).offset().top}, 'fast' );
		});
		
		/*scroll back to top */
		$("a.backtop").click(function(event){
			event.preventDefault();
			$('html,body').animate({ scrollTop:0 }, 'fast' );
		});

		// Mobile select menu
		$("<select />").appendTo("#navigation");
		$("<option />", {
			"selected": "selected",
			"value" : "",
			"text" : navLocalize.text
		}).appendTo("#navigation select");
		$("#navigation .dropdown-menu a").each(function() {
			var el = $(this);
			if(el.parents('.sub-menu').length >= 1) {
				$('<option />', {
					'value' : el.attr("href"),
					'text' : '- ' + el.text()
				}).appendTo("#navigation select");
			}
			else if(el.parents('.sub-menu .sub-menu').length >= 1) {
				$('<option />', {
					'value' : el.attr('href'),
					'text' : '-- ' + el.text()
				}).appendTo("#navigation select");
			}
			else {
				$('<option />', {
					'value' : el.attr('href'),
					'text' : el.text()
				}).appendTo("#navigation select");
			}
		});
		$("#navigation select").change(function() {
			window.location = $(this).find("option:selected").val();
		});
		$("#navigation select").uniform();

		// Responsive videos
		$(".fitvids").fitVids();
		
	});
});


/*global jQuery */
/*! 
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/

/*global jQuery */
/*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/
(function(e){e.fn.fitVids=function(t){var n={customSelector:null};var r=document.createElement("div"),i=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];r.className="fit-vids-style";r.innerHTML="&shy;<style> .fluid-width-video-wrapper { width: 100%; position: relative; padding: 0; } .fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; } </style>";i.parentNode.insertBefore(r,i);if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.kickstarter.com']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=e(this).find(t.join(","));r.each(function(){var t=e(this);if(this.tagName.toLowerCase()=="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}var n=this.tagName.toLowerCase()=="object"?t.attr("height"):t.height(),r=n/t.width();if(!t.attr("id")){var i="fitvid"+Math.floor(Math.random()*999999);t.attr("id",i)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",r*100+"%");t.removeAttr("height").removeAttr("width")})})}})(jQuery);

/*

Uniform v1.7.5
Copyright © 2009 Josh Pyles / Pixelmatrix Design LLC
http://pixelmatrixdesign.com

Requires jQuery 1.4 or newer

Much thanks to Thomas Reynolds and Buck Wilson for their help and advice on this

Disabling text selection is made possible by Mathias Bynens <http://mathiasbynens.be/>
and his noSelect plugin. <http://github.com/mathiasbynens/noSelect-jQuery-Plugin>

Also, thanks to David Kaneda and Eugene Bond for their contributions to the plugin

License:
MIT License - http://www.opensource.org/licenses/mit-license.php

Enjoy!

*/
(function(e){e.uniform={options:{selectClass:"selector",radioClass:"radio",checkboxClass:"checker",fileClass:"uploader",filenameClass:"filename",fileBtnClass:"action",fileDefaultText:"No file selected",fileBtnText:"Choose File",checkedClass:"checked",focusClass:"focus",disabledClass:"disabled",buttonClass:"button",activeClass:"active",hoverClass:"hover",useID:true,idPrefix:"uniform",resetSelector:false,autoHide:true},elements:[]};if(e.browser.msie&&e.browser.version<7){e.support.selectOpacity=false}else{e.support.selectOpacity=true}e.fn.uniform=function(t){function r(t){$el=e(t);$el.addClass($el.attr("type"));l(t)}function i(t){e(t).addClass("uniform");l(t)}function s(n){var r=e(n);var i=e("<div>"),s=e("<span>");i.addClass(t.buttonClass);if(t.useID&&r.attr("id")!="")i.attr("id",t.idPrefix+"-"+r.attr("id"));var o;if(r.is("a")||r.is("button")){o=r.text()}else if(r.is(":submit")||r.is(":reset")||r.is("input[type=button]")){o=r.attr("value")}o=o==""?r.is(":reset")?"Reset":"Submit":o;s.html(o);r.css("opacity",0);r.wrap(i);r.wrap(s);i=r.closest("div");s=r.closest("span");if(r.is(":disabled"))i.addClass(t.disabledClass);i.bind({"mouseenter.uniform":function(){i.addClass(t.hoverClass)},"mouseleave.uniform":function(){i.removeClass(t.hoverClass);i.removeClass(t.activeClass)},"mousedown.uniform touchbegin.uniform":function(){i.addClass(t.activeClass)},"mouseup.uniform touchend.uniform":function(){i.removeClass(t.activeClass)},"click.uniform touchend.uniform":function(t){if(e(t.target).is("span")||e(t.target).is("div")){if(n[0].dispatchEvent){var r=document.createEvent("MouseEvents");r.initEvent("click",true,true);n[0].dispatchEvent(r)}else{n[0].click()}}}});n.bind({"focus.uniform":function(){i.addClass(t.focusClass)},"blur.uniform":function(){i.removeClass(t.focusClass)}});e.uniform.noSelect(i);l(n)}function o(n){var r=e(n);var i=e("<div />"),s=e("<span />");if(!r.css("display")=="none"&&t.autoHide){i.hide()}i.addClass(t.selectClass);if(t.useID&&n.attr("id")!=""){i.attr("id",t.idPrefix+"-"+n.attr("id"))}var o=n.find(":selected:first");if(o.length==0){o=n.find("option:first")}s.html(o.html());n.css("opacity",0);n.wrap(i);n.before(s);i=n.parent("div");s=n.siblings("span");n.bind({"change.uniform":function(){s.text(n.find(":selected").html());i.removeClass(t.activeClass)},"focus.uniform":function(){i.addClass(t.focusClass)},"blur.uniform":function(){i.removeClass(t.focusClass);i.removeClass(t.activeClass)},"mousedown.uniform touchbegin.uniform":function(){i.addClass(t.activeClass)},"mouseup.uniform touchend.uniform":function(){i.removeClass(t.activeClass)},"click.uniform touchend.uniform":function(){i.removeClass(t.activeClass)},"mouseenter.uniform":function(){i.addClass(t.hoverClass)},"mouseleave.uniform":function(){i.removeClass(t.hoverClass);i.removeClass(t.activeClass)},"keyup.uniform":function(){s.text(n.find(":selected").html())}});if(e(n).attr("disabled")){i.addClass(t.disabledClass)}e.uniform.noSelect(s);l(n)}function u(n){var r=e(n);var i=e("<div />"),s=e("<span />");if(!r.css("display")=="none"&&t.autoHide){i.hide()}i.addClass(t.checkboxClass);if(t.useID&&n.attr("id")!=""){i.attr("id",t.idPrefix+"-"+n.attr("id"))}e(n).wrap(i);e(n).wrap(s);s=n.parent();i=s.parent();e(n).css("opacity",0).bind({"focus.uniform":function(){i.addClass(t.focusClass)},"blur.uniform":function(){i.removeClass(t.focusClass)},"click.uniform touchend.uniform":function(){if(!e(n).attr("checked")){s.removeClass(t.checkedClass)}else{s.addClass(t.checkedClass)}},"mousedown.uniform touchbegin.uniform":function(){i.addClass(t.activeClass)},"mouseup.uniform touchend.uniform":function(){i.removeClass(t.activeClass)},"mouseenter.uniform":function(){i.addClass(t.hoverClass)},"mouseleave.uniform":function(){i.removeClass(t.hoverClass);i.removeClass(t.activeClass)}});if(e(n).attr("checked")){s.addClass(t.checkedClass)}if(e(n).attr("disabled")){i.addClass(t.disabledClass)}l(n)}function a(n){var r=e(n);var i=e("<div />"),s=e("<span />");if(!r.css("display")=="none"&&t.autoHide){i.hide()}i.addClass(t.radioClass);if(t.useID&&n.attr("id")!=""){i.attr("id",t.idPrefix+"-"+n.attr("id"))}e(n).wrap(i);e(n).wrap(s);s=n.parent();i=s.parent();e(n).css("opacity",0).bind({"focus.uniform":function(){i.addClass(t.focusClass)},"blur.uniform":function(){i.removeClass(t.focusClass)},"click.uniform touchend.uniform":function(){if(!e(n).attr("checked")){s.removeClass(t.checkedClass)}else{var r=t.radioClass.split(" ")[0];e("."+r+" span."+t.checkedClass+":has([name='"+e(n).attr("name")+"'])").removeClass(t.checkedClass);s.addClass(t.checkedClass)}},"mousedown.uniform touchend.uniform":function(){if(!e(n).is(":disabled")){i.addClass(t.activeClass)}},"mouseup.uniform touchbegin.uniform":function(){i.removeClass(t.activeClass)},"mouseenter.uniform touchend.uniform":function(){i.addClass(t.hoverClass)},"mouseleave.uniform":function(){i.removeClass(t.hoverClass);i.removeClass(t.activeClass)}});if(e(n).attr("checked")){s.addClass(t.checkedClass)}if(e(n).attr("disabled")){i.addClass(t.disabledClass)}l(n)}function f(n){var r=e(n);var i=e("<div />"),s=e("<span>"+t.fileDefaultText+"</span>"),o=e("<span>"+t.fileBtnText+"</span>");if(!r.css("display")=="none"&&t.autoHide){i.hide()}i.addClass(t.fileClass);s.addClass(t.filenameClass);o.addClass(t.fileBtnClass);if(t.useID&&r.attr("id")!=""){i.attr("id",t.idPrefix+"-"+r.attr("id"))}r.wrap(i);r.after(o);r.after(s);i=r.closest("div");s=r.siblings("."+t.filenameClass);o=r.siblings("."+t.fileBtnClass);if(!r.attr("size")){var u=i.width();r.attr("size",u/10)}var a=function(){var e=r.val();if(e===""){e=t.fileDefaultText}else{e=e.split(/[\/\\]+/);e=e[e.length-1]}s.text(e)};a();r.css("opacity",0).bind({"focus.uniform":function(){i.addClass(t.focusClass)},"blur.uniform":function(){i.removeClass(t.focusClass)},"mousedown.uniform":function(){if(!e(n).is(":disabled")){i.addClass(t.activeClass)}},"mouseup.uniform":function(){i.removeClass(t.activeClass)},"mouseenter.uniform":function(){i.addClass(t.hoverClass)},"mouseleave.uniform":function(){i.removeClass(t.hoverClass);i.removeClass(t.activeClass)}});if(e.browser.msie){r.bind("click.uniform.ie7",function(){setTimeout(a,0)})}else{r.bind("change.uniform",a)}if(r.attr("disabled")){i.addClass(t.disabledClass)}e.uniform.noSelect(s);e.uniform.noSelect(o);l(n)}function l(t){t=e(t).get();if(t.length>1){e.each(t,function(t,n){e.uniform.elements.push(n)})}else{e.uniform.elements.push(t)}}t=e.extend(e.uniform.options,t);var n=this;if(t.resetSelector!=false){e(t.resetSelector).mouseup(function(){function t(){e.uniform.update(n)}setTimeout(t,10)})}e.uniform.restore=function(t){if(t==undefined){t=e(e.uniform.elements)}e(t).each(function(){if(e(this).is(":checkbox")){e(this).unwrap().unwrap()}else if(e(this).is("select")){e(this).siblings("span").remove();e(this).unwrap()}else if(e(this).is(":radio")){e(this).unwrap().unwrap()}else if(e(this).is(":file")){e(this).siblings("span").remove();e(this).unwrap()}else if(e(this).is("button, :submit, :reset, a, input[type='button']")){e(this).unwrap().unwrap()}e(this).unbind(".uniform");e(this).css("opacity","1");var n=e.inArray(e(t),e.uniform.elements);e.uniform.elements.splice(n,1)})};e.uniform.noSelect=function(t){function n(){return false}e(t).each(function(){this.onselectstart=this.ondragstart=n;e(this).mousedown(n).css({MozUserSelect:"none"})})};e.uniform.update=function(n){if(n==undefined){n=e(e.uniform.elements)}n=e(n);n.each(function(){var r=e(this);if(r.is("select")){var i=r.siblings("span");var s=r.parent("div");s.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass);i.html(r.find(":selected").html());if(r.is(":disabled")){s.addClass(t.disabledClass)}else{s.removeClass(t.disabledClass)}}else if(r.is(":checkbox")){var i=r.closest("span");var s=r.closest("div");s.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass);i.removeClass(t.checkedClass);if(r.is(":checked")){i.addClass(t.checkedClass)}if(r.is(":disabled")){s.addClass(t.disabledClass)}else{s.removeClass(t.disabledClass)}}else if(r.is(":radio")){var i=r.closest("span");var s=r.closest("div");s.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass);i.removeClass(t.checkedClass);if(r.is(":checked")){i.addClass(t.checkedClass)}if(r.is(":disabled")){s.addClass(t.disabledClass)}else{s.removeClass(t.disabledClass)}}else if(r.is(":file")){var s=r.parent("div");var o=r.siblings(t.filenameClass);btnTag=r.siblings(t.fileBtnClass);s.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass);o.text(r.val());if(r.is(":disabled")){s.addClass(t.disabledClass)}else{s.removeClass(t.disabledClass)}}else if(r.is(":submit")||r.is(":reset")||r.is("button")||r.is("a")||n.is("input[type=button]")){var s=r.closest("div");s.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass);if(r.is(":disabled")){s.addClass(t.disabledClass)}else{s.removeClass(t.disabledClass)}}})};return this.each(function(){if(e.support.selectOpacity){var t=e(this);if(t.is("select")){if(t.attr("multiple")!=true){if(t.attr("size")==undefined||t.attr("size")<=1){o(t)}}}else if(t.is(":checkbox")){u(t)}else if(t.is(":radio")){a(t)}else if(t.is(":file")){f(t)}else if(t.is(":text, :password, input[type='email']")){r(t)}else if(t.is("textarea")){i(t)}else if(t.is("a")||t.is(":submit")||t.is(":reset")||t.is("button")||t.is("input[type=button]")){s(t)}}})}})(jQuery);