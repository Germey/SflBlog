<?php
/**
 * The template for displaying Category pages.
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
            <?php if (have_posts()) : ?>
                <h1 class="page_title"><?php printf(__('Category Archives: %s', 'swiftray'), '' . single_cat_title('', false) . ''); ?></h1>
                <?php
                $category_description = category_description();
                if (!empty($category_description))
                    echo '' . $category_description . '';
                /* Run the loop for the category page to output the posts.
                 * If you want to overload this in a child theme then include a file
                 * called loop-category.php and that will be used instead.
                 */
                ?>
                <?php get_template_part('loop', 'category');
                ?>
                <div class="clear"></div>
                <nav id="nav-single"> <span class="nav-previous">
                        <?php next_posts_link(__('&larr; Older posts', 'swiftray')); ?>
                    </span> <span class="nav-next">
                        <?php previous_posts_link(__('Newer posts &rarr;', 'swiftray')); ?>
                    </span> </nav>
            <?php endif; ?>
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