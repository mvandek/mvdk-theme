<?php
/**
 * The Frontpage sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-10' ) ) : ?>
<div class="widget-area sidebar-front-page">
<?php dynamic_sidebar( 'sidebar-10' ) ; ?>
</div>
<?php endif; ?>
<?php if( is_active_sidebar( 'sidebar-15' ) && ! is_singular() ) : ?>
<div class="widget-area sidebar-front-page">
<?php dynamic_sidebar( 'sidebar-15' ) ; ?>
</div>
<?php endif; ?>