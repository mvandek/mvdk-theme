<?php
/**
 * The template for displaying the footer
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
</div>
<footer id="footer" class="footer">

<?php get_sidebar( 'footer' ); ?>

<?php if ( get_theme_mod( 'mvdk_custom_footer_text' ) ) { ?>
<div class="copyright"><?php echo '©' . ' ' . date( 'Y' ) . ' ' . esc_html( get_theme_mod( 'mvdk_custom_footer_text' ) ); ?></div>
<?php } ?>

<?php if ( has_nav_menu( 'footer' ) ) : ?>
<!-- .footer-navigation -->
<nav class="footer-navigation" aria-label="<?php esc_html_e( 'Footer Menu', 'mvdk' ); ?>" itemscope itemtype="http://schema.org/SiteNavigationElement">
<?php
// Social links navigation menu.
wp_nav_menu( [
'theme_location'	=> 'footer',
'container'		=> false,
'depth'			=> 1,
'link_before'		=> '<span itemprop="name">', 
'link_after'		=> '</span>'
] );
?>
</nav>
<!-- .footer-navigation -->
<?php endif; ?>

</footer>

<?php wp_footer(); ?>

<!-- <?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconden. -->

<script>
$(document).on("click", '[target="_blank"]', function (e) {
    var w = window.open();
    e.stopPropagation;
    e.preventDefault();
    w.opener = null;
    w.location = this.href;
});
</script>

</body>
</html>