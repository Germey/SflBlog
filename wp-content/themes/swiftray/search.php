<?php
/**
 * The template for displaying Search Results pages.
 *
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
            <?php if (have_posts()) : ?><h5><?php
                    printf(__('Search Results for: %s', 'swiftray'), '' . get_search_query() . '');
                    ?></h5>
                <!--Start Post-->
                <?php get_template_part('loop', 'search');
                ?>
                <!--End Post-->
            <?php else : ?>
                <article id="post-0" class="post no-results not-found">
                    <header class="entry-header">
                        <h1 class="entry-title">
                            <?php _e('Nothing Found', 'swiftray');
                            ?>
                        </h1>
                    </header>
                    <!-- .entry-header -->
                    <div class="entry-content">
                        <p>
                            <?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'swiftray');
                            ?>
                        </p>
                        <?php get_search_form(); ?>
                    </div>
                    <!-- .entry-content -->
                </article>
            <?php endif; ?>
            <div class="clear"></div>
            <nav id="nav-single"> <span class="nav-previous">
                    <?php next_posts_link(__('&larr; Older posts', 'swiftray'));
                    ?>
                </span> <span class="nav-next">
                    <?php previous_posts_link(__('Newer posts &rarr;', 'swiftray'));
                    ?>
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