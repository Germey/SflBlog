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
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                <!--Start Content-->
                <div class="content single">
                    <!--Start Post-->
                    <div class="post">
                        <div class="post_content">                 
                            <h1 class="post_title"><?php the_title(); ?></h1>
                            <ul class="post_meta">
                                <li><?php echo get_the_time('F j, Y') ?></li>
                                <li><?php _e('Posted in', 'swiftray'); ?> <?php the_category(', '); ?></li>
                                <li><?php _e('By', 'swiftray'); ?> <?php the_author_posts_link(); ?></li>
                                <li><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                                <!--End Content-->
                        </div> </ul>
                        <?php the_content(); ?>
                        <div class="clear"></div>
                        <?php if (has_tag()) { ?>
                            <div class="tag">
                                <?php the_tags('Post Tagged with ', ', ', ''); ?>
                            </div>
                        <?php } ?>
                        <div class="clear"></div>
                    </div>          
                    <div class="clear"></div>
                    <div class="dt_line"></div>
                    <div class="clear"></div>
                    <!--Start Comment Section-->
                    <?php comments_template(); ?>
                    <!--End comment Section-->
                </div>

                <?php
                wp_link_pages(array(
                    'before' => '<div class="clear"></div><div class="page-link"><span>' . PAGES_COLON . '</span>',
                    'after' => '</div>'));
            endwhile;
        ?>
        <!--End Post-->
        <div class="clear"></div>
        <nav id="nav-single"> <span class="nav-previous">
                <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous Post ', 'swiftray')); ?>
            </span> <span class="nav-next">
                <?php next_post_link('%link', __('Next Post <span class="meta-nav">&rarr;</span>', 'swiftray')); ?>
            </span> </nav>
    </div>
    <!--End Content-->
    <!--Col Right-->

    <!--End Content-->
    <div class="grid_6 sidebar_wrapper omega">
        <!--Start Sidebar-->
        <?php get_sidebar(); ?>
        <!--End Sidebar-->
    </div>
</div>
<!--End Content Wrapper-->
<?php get_footer(); ?>