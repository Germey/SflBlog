<div class="footer">
    <div class="one_third">
        <?php if (is_active_sidebar('first-footer-widget-area')) : ?>
            <?php dynamic_sidebar('first-footer-widget-area'); ?>
        <?php endif; ?>
    </div>
    <div class="one_third">
        <?php if (is_active_sidebar('second-footer-widget-area')) : ?>
            <?php dynamic_sidebar('second-footer-widget-area'); ?>
        <?php endif; ?>
    </div>
    <div class="one_third last">
        <?php if (is_active_sidebar('third-footer-widget-area')) : ?>
            <?php dynamic_sidebar('third-footer-widget-area'); ?>
        <?php endif; ?>

    </div>
</div>