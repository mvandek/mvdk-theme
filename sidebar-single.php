<?php
/**
 * The Single Post sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-30' ) ) : ?>
<div class="widget-area" role="complementary">
<?php dynamic_sidebar( 'sidebar-30' ) ; ?>
</div>
<?php endif; ?>