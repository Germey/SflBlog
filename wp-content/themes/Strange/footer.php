<?php

/**
 * Template for footer
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */


$sb = get_option( UT_THEME_INITIAL.'general_footer_sidebar' );

if ( is_active_sidebar( UT_THEME_INITIAL.'sidebar_'.$sb ) ) :  ?>
<div id="footer_bg" class="fluid">
    <div id="footer">
	<div class="container_12 clearfix">
	    <?php dynamic_sidebar( UT_THEME_INITIAL.'sidebar_'.$sb ); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div id="sub_footer" class="fluid">
    <div class="container_12">
	<div class="grid_12">
	    <p><?php echo do_shortcode(get_option( UT_THEME_INITIAL.'general_footer_copyright' )); ?></p>
	    <?php if( get_option( UT_THEME_INITIAL.'social_options_footer' ) == 'y' ):
		$social_links = get_option( UT_THEME_INITIAL.'social_links_link' );
		$social_open = get_option( UT_THEME_INITIAL.'social_options_open' ); ?>
	    <ul class="social">
		<?php foreach( $social_links as $social_link ){ ?>
		<li><a href="<?php echo $social_link['link']; ?>" <?php if($social_open=='new') echo ' target="_blank"'; ?>><?php echo $social_link['name']; ?></a></li>
		<?php } ?>
	    </ul>
	    <?php endif; ?>
	</div>
    </div>
</div>

<?php wp_footer(); ?>

<?php echo (get_option( UT_THEME_INITIAL.'general_footer_googleanalytics' )) ?>

</body>
</html>
