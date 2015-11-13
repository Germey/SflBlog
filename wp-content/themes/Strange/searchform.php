<?php

/**
 * Template for widget searchform
 *
 * @package WordPress
 * @subpackage ut-strange
 * @since Strange 1.0
 */

?>

<form action="<?php echo home_url(); ?>" method="get" class="searchform">
    <div>
        <input type="text" name="s" class="s fancyinput" value="<?php the_search_query(); ?>" />
        <input class="searchsubmit" value="Search" type="submit">
    </div>
</form>