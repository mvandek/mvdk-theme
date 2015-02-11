<?php
/**
 * The Frontpage sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-1' ) ) : ?>
<div class="widget-area sidebar-front-page" role="complementary">
<?php dynamic_sidebar( 'sidebar-1' ) ; ?>
</div>
<?php endif; ?>