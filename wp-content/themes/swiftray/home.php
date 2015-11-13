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
            <div class="slider_wrapper">
                <!--Start Slider-->
                <div id="slides">
                    <div class="slide slides_container">
                        <div>
                            <?php if (get_option('inkthemes_slideimage1') != '') { ?>
                                <img src="<?php echo get_option('inkthemes_slideimage1'); ?>" alt=""/>
                            <?php } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/image-fet.jpg" alt="">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!--End Slider-->
            </div>
            <div class="dt_line"></div>
            <div class="home_content">
                <?php get_template_part('loop'); ?>
                <div class="clear"></div>
                <nav id="nav-single"> 
                    <span class="nav-previous">
                        <?php next_posts_link(__('&larr; Older posts', 'swiftray')); ?>
                    </span> 
                    <span class="nav-next">
                        <?php previous_posts_link(__('Newer posts &rarr;', 'swiftray')); ?>
                    </span> 
                </nav>
            </div>
        </div>
        <!--End Content-->
    </div>
    <div class="grid_6 sidebar_wrapper omega">
        <!--Start Sidebar-->
        <?php get_sidebar(); ?>
        <!--End Sidebar-->
    </div>

</div>
<!--End Content Wrapper-->
<?php get_footer(); ?>