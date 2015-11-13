<div class="sidebar">
    <!--Start Menu-->
    <div id="menu-wrapper">
        <?php inkthemes_nav(); ?>
    </div>
    <!--End Menu-->
    <div class="clear"></div>
    <div class="clear"></div>  
    <div class="sidebar_widget">
        <?php if (!is_active_sidebar('primary-widget-area')) : ?>   
            <?php dynamic_sidebar('primary-widget-area'); ?>
        <?php endif; // end primary widget area ?>
        <?php
        // A second sidebar for widgets, just because.
        if (is_active_sidebar('secondary-widget-area')) :
            ?>
            <?php dynamic_sidebar('secondary-widget-area'); ?>
        <?php endif; ?>  
    </div>
</div>