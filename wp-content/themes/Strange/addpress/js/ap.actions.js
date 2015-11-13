jQuery(document).ready(function($) {

    /* trigger tabs */
    $('.ap-panel-tabs>ul>li>a').live('click', function(){
        $e = $(this);
        $.cookie('ap-active-tab', $e.attr('href') );
        $( '.ap-panel-tabcontent' ).removeClass('relative').addClass('absolute').fadeOut('slow');
        $( $e.attr('href') ).fadeIn('slow',function(){$(this).removeClass('absolute').addClass('relative')});
	$e.parents('ul').children('li').removeClass('active');
	$e.parent('li').addClass('active');
	return false;
    });

    /* trigger sections */
    $('.toggle').live('click', function(){
	var fs = ( $(this).next('div:first').css('display') == 'none' ) ? true : false;
	if( fs )
	    $(this).next('div:first').find('.selectset').addClass( 'hidden' );
	$(this).next('div:first').slideToggle(function(){
	    if( fs )
		$(this).find('.selectset').removeClass('hidden').apFancySelect();
	});
    });

    /* trigger infos */
    var inf=$.cookie('ap-infos')||1;
    if( inf == 0 ) $('.info, .comment, .info-arrow').addClass('hide');
    $('#ap-infobutton').click(function(){
	if( inf==1 ){
	    $('.info, .comment, .info-arrow').addClass('hide');
	    inf=0;
	    $.cookie('ap-infos',inf)
	}else{
	    $('.info, .comment, .info-arrow').removeClass('hide');
	    inf=1;
	    $.cookie('ap-infos',inf)
	}
    });

    /* trigger radio & checkbox */
    $('.radioset input[type="radio"], .checkset input[type="checkbox"]').each(function(){
	$e = $(this);
	if( $e.is(":checked") )
	    $e.next('label').addClass('checked');
	});
	$('.radioset input[type="radio"]').live('change', function(){
	$e = $(this);
	$e.parent('.radioset').children('label').removeClass('checked');
	$e.next('label').addClass('checked');
    });
    $('.checkset input[type="checkbox"]').live('change', function(){
	$e = $(this);
	if( $e.is(":checked") )
	    $e.next('label').addClass('checked');
	else
	    $e.next('label').removeClass('checked');
    });

    /* init color picker */
    $('.cp, .color').live('click', function(){
	$(this).ColorPicker({
	    color: '#FF0000',
	    onBeforeShow: function(){ elID = this; },
	    onShow: function (colpkr) { $(colpkr).fadeIn(500); return false; },
	    onHide: function (colpkr) { $(colpkr).fadeOut(500); return false; },
	    onChange: function (hsb, hex, rgb) {
		$(elID).parents('.option').find('.cp').css('backgroundColor', '#'+hex);
		$(elID).parents('.option').find('input').val('#'+hex.toUpperCase());
	    }
	}).live('keyup',function(){
	    $this = $(this);
	    if( $this.hasClass('color') )
		$this.ColorPickerSetColor( $this.val().replace('#','') ).parents('.option').find('.cp').css( 'background-color', $this.val() );
	}).click();
    });
    
    /* hide tabs & init fancy select */
    $('.ap-panel-tabcontent').removeClass('hidden');
    
    $('.ap-panel-tabcontent .content').addClass('hide');
    if( !$.cookie('ap-active-tab') ){
	$('.ap-panel-tabs ul').children('li').first().addClass('active');
	$('.ap-panel-tabcontent:not(.first-child)').hide();
	$( '.ap-panel-tabs' ).height( $($('.ap-panel-tabs').children( 'ul' ).find('a.first-child').attr('href') ).height() );
    }else{
	$('.ap-panel-tabs ul li a[href="'+$.cookie('ap-active-tab')+'"]').parent().addClass('active');
	$('.ap-panel-tabcontent:not('+$.cookie('ap-active-tab')+')').hide();
	$( '.ap-panel-tabs' ).height( $( $.cookie('ap-active-tab') ).height() );
    }

});