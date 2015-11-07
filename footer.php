<?php
/**
 * The template for displaying the footer
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
</div>
<footer class="footer">

<?php get_sidebar( 'footer' ); ?>

<?php if ( get_theme_mod( 'mvdk_custom_footer_text' ) ) { ?>
<div class="copyright"><?= '© ' . date( 'Y' ) . ' ' . esc_html( get_theme_mod( 'mvdk_custom_footer_text' ) ); ?></div>
<?php } ?>

<?php if ( has_nav_menu( 'footer' ) ) : ?>
<!-- .footer-navigation -->
<nav class="footer-navigation" aria-label="<?php _e( 'Footer Menu', 'mvdk' ); ?>" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<?php
// Social links navigation menu.
wp_nav_menu( [
'theme_location' => 'footer',
'container'      => false,
'depth'          => 1,
] );
?>
</nav>
<!-- .footer-navigation -->
<?php endif; ?>

</footer>

<?php wp_footer(); ?>

</body>
</html>