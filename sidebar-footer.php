<?php
/**
 * The Footer sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-20' ) ) { ?>
<div class="footer-area widget-area" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
<?php dynamic_sidebar( 'sidebar-20' ); ?>
</div>
<?php } ?>