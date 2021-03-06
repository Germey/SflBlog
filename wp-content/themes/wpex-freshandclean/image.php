<?php
/**
 * Image.php is used for your image attachment pages
 *
 * @package Fresh & Clean WordPress Theme
 * @since 1.0
 */

get_header(); ?>

<div id="page-heading">
	<h1><?php the_title(); ?></h1>	
</div><!-- #page-heading -->

<div id="image-attachment-page" class="clr">

    <?php
	// Display attachment
    $portimg = wp_get_attachment_image( $post->ID, 'full' );
	echo preg_replace('#(width|height)="\d+"#','',$portimg); ?>
    
    <div id="image-attach-page-content">
        <?php the_content(); ?>
    </div><!-- #image-attach-page-content -->
    
</div><!-- #image-attachment-page -->

<?php
get_footer(); // Loads the footer.php file