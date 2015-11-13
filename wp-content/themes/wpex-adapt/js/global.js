jQuery(function($){
	$(document).ready(function(){
		
		// Responsive videos
		$(".fitvids").fitVids();
		
		// Superfish dropdowns
		$("ul.sf-menu").superfish({
			cssArrows: false,
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			disableHI: true
		});
		
		// back to top
		$('a[href=#toplink]').click(function(){
			$('html, body').animate({scrollTop:0}, 200);
			return false;
		});
	
		// Comment scroll
		$("li.comments-scroll a").click(function(event){
			event.preventDefault();
			$('html,body').animate({ scrollTop:$(this.hash).offset().top}, 'normal' );
		});
		
		// Lightbox
		$(".prettyphoto-link").prettyPhoto({
			theme: 'pp_default',
			animation_speed:'fast',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			social_tools: false,
			autoplay_slideshow: false
		});
			
		$("a[rel^='prettyphoto']").prettyPhoto({
			theme: 'pp_default',
			animation_speed:'fast',
			allow_resize: true,
			keyboard_shortcuts: true,
			show_title: false,
			slideshow:3000,
			social_tools: false,
			autoplay_slideshow: false,
			overlay_gallery: true
		});
		
		// Mobile menu
		$("<select />").appendTo("#masternav");
		$("<option />", {
			"selected": "selected",
			"value" : "",
			"text" : wpexLocalize.responsiveMenuText
		}).appendTo("#masternav select");

		$("#masternav a").each(function() {
			var el = $(this);
			if(el.parents('.sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr("href"),
				 'text' : '- ' + el.text()
				}).appendTo("#masternav select");
			}
			else if(el.parents('.sub-menu .sub-menu').length >= 1) {
				$('<option />', {
				 'value' : el.attr('href'),
				 'text' : '-- ' + el.text()
				}).appendTo("#masternav select");
			}
			else {
				$('<option />', {
				 'value' : el.attr('href'),
				 'text' : el.text()
				}).appendTo("#masternav select");
			}
		});	
		$("#masternav select").change(function() {
			window.location = $(this).find("option:selected").val();
		});
		
		$("#masternav select").uniform();

	});
});