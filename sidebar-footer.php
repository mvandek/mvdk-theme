<?php
/**
 * The Footer sidebar
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if( is_active_sidebar( 'sidebar-2' ) ) { ?>
<aside class="footer-area widget-area" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside>
<?php } ?>