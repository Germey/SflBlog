<!-- Start the Loop. -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post_content"> 
                <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                    <?php inkthemes_get_thumbnail(146, 168); ?>
                <?php } else { ?>
                    <?php inkthemes_get_image(146, 168); ?> 
                    <?php
                }
                ?>	
                <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <ul class="post_meta">
                    <li><?php echo get_the_time('F j, Y') ?></li>
                    <li><?php _e('Posted in', 'swiftray'); ?> <?php the_category(', '); ?></li>
                    <li><?php _e('By','swiftray'); ?> <?php the_author_posts_link(); ?></li>
                    <li><?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                </ul>
                <?php the_excerpt(); ?>
                <div class="clear"></div>
                <?php if (has_tag()) { ?>
                    <div class="tag">
                        <?php the_tags('Post Tagged with ', ', ', ''); ?>
                    </div>
                <?php } ?>
                <div class="clear"></div>
            </div>
            <a class="read-more" href="<?php the_permalink() ?>"><?php _e('Read More','swiftray'); ?></a>
            <div class="clear"></div>
            <div class="dt_line"></div>
        </div>
    <?php endwhile;
else:
    ?>
    <div class="post">
        <p>
    <?php _e('Sorry, no posts matched your criteria.', 'swiftray'); ?>
        </p>
    </div>
<?php endif; ?>
<!--End Loop-->