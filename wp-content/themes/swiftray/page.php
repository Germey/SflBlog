<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 */
?>
<?php get_header(); ?>
<!--Start Content Wrapper-->
<div class="grid_24 content_wrapper">
    <div class="c_hd">
        <div class="d_line"></div>
    </div>
    <!--Col Left-->
    <div class="grid_18 omega">
        <!--Start Content-->
        <div class="content">            
            <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <h1 class="page_title"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="clear"></div><div class="page-link"><span>' . PAGES_COLON . '</span>',
                        'after' => '</div>'));
                    ?>
                <?php endwhile; ?>		   
        </div>
        <!--End Content-->
    </div>
    <!--Col Right-->

    <div class="grid_6 sidebar_wrapper omega">
        <!--Start Sidebar-->
        <?php get_sidebar(); ?>
        <!--End Sidebar-->
    </div>
</div>
<!--End Content Wrapper-->
<?php get_footer(); ?>