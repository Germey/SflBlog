<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
            <!--Start Post-->
            <?php get_template_part('loop', 'index'); ?>
            <!--End Post-->
            <div class="clear"></div>
            <nav id="nav-single"> <span class="nav-previous">
                    <?php next_posts_link(__('&larr; Older posts', 'swiftray')); ?>
                </span> <span class="nav-next">
                    <?php previous_posts_link(__('Newer posts &rarr;', 'swiftray')); ?>
                </span> </nav>
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