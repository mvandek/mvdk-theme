<?php
/**
 * The Single Post sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-3' ) ) : ?>
<div class="widget-area" role="complementary">
<?php dynamic_sidebar( 'sidebar-3' ) ; ?>
</div>
<?php endif; ?>
