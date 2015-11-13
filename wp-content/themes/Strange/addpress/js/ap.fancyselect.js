(function($){

    $.fn.apFancySelect = function( settings ){

	settings = $.extend({
         ltPlaceholder: '%(%',
         gtPlaceholder: '%)%'
        }, settings);

	var _z = 0;
	
	this.each(function(){
	    var $e = $(this);
	    $e.find('.ap-fancyselect').remove();
	    var $s = $e.children('select'),
		$f = $('<div class="ap-fancyselect" />'),
		$p = $('<div class="ap-fancyselect-options" />'),
		w = h = 0;
	    $s.show();
	    $f.appendTo( $e );
	    $p.appendTo( $f );

	    $s.children('option').each(function(){
	        $_o = $(this);
	        $o = $('<div class="ap-fancyselect-option'+($_o.is(":selected")?' selected':'')+'" />').html( $_o.text().replace(/%\(%/g,'<').replace(/%\)%/g,'>') ).data( 'value', $_o.val() ).appendTo( $p );
	        var _w = $p.outerWidth();
	        h+=$p.outerHeight()
	        w=_w>w?_w:w;
	    });
	    $p.hide().children('.selected').clone().removeClass('ap-fancyselect-option').addClass('ap-fancyselect-show').show().prependTo( $f );

	    $p.width( w+30 );
	    $f.width( w+1 );
	    var z = $f.css('z-index');
	    $f.data( 'z-index', z );
	    _z=(z>_z)?z:_z;

	    $s.hide();
	
	});
	
	$( '.ap-fancyselect-option' ).live('click', function( event ){
	    event.stopPropagation();
	    $e = $(this);
	    $e.parent('.ap-fancyselect-options').slideUp('fast').children('.ap-fancyselect-option').removeClass('selected');
	    $e.addClass('selected').parent('.ap-fancyselect-options').prev('.ap-fancyselect-show').remove();
	    $e.parent('.ap-fancyselect-options').children('.ap-fancyselect-option.selected').clone().removeClass('ap-fancyselect-option').addClass('ap-fancyselect-show').show().prependTo( $e.parents('.ap-fancyselect') )
	    $e.parents('.selectset').children('select').children('option[value="'+$e.data('value')+'"]').attr('selected', true);
	});
	$( '.ap-fancyselect' ).live('click', function( event ){
	    event.stopPropagation();
	    var $e = $(this);
	    $('.selectset .ap-fancyselect').each(function(){
	        var $e = $(this);
	        $e.css('z-index', $e.data('z-index') );
	    });
	    $('.ap-fancyselect-options').hide();
	    $e.css('z-index', _z+1).children('.ap-fancyselect-options').slideDown('fast');
	});
	$('body').live('click', function( event ){
	    event.stopPropagation();
	    $('.selectset .ap-fancyselect').each(function(){
	        var $e = $(this);
	        $e.css('z-index', $e.data('z-index') );
	    });
	    $( '.ap-fancyselect-options' ).slideUp('fast');
	});

	return;
	
    }

})(jQuery);
