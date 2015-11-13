<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php
        wp_head();
        ?>
    </head>
    <body  <?php body_class(); ?> style="<?php if (get_option('inkthemes_bodybg') != '') { ?>background:url(<?php echo get_option('inkthemes_bodybg'); ?>)<?php } else {
            
        } ?>" >
        <div class="wrapper">
            <!--Start Container-->
            <div class="container_24">
                <!--Start Header Wrapper-->
                <div class="grid_24 header_wrapper">
                    <!--Start Header-->
                    <div class="header">
                        <div class="grid_12 alpha">
                            <div class="logo">

<?php if (get_option('inkthemes_logo') != '') { ?>
                                    <a href="<?php echo home_url(); ?>">
                                        <img src="<?php echo get_option('inkthemes_logo'); ?>" alt="<?php bloginfo('name'); ?>" />
                                    </a>
                                <?php } else { ?>
                                    <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
                                    <p><?php bloginfo('description'); ?></p>
<?php } ?>

                            </div>
                        </div>
                        <div class="grid_12 omega">

                        </div>
                    </div>
                    <!--End Header-->
                </div>
                <!--End Header Wrapper-->
                <div class="clear"></div>