<?php
/**
 * The template for displaying the footer
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
</div>
<footer class="footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
<?php get_sidebar( 'footer' ); ?>
<?php if ( get_theme_mod( 'mvdk_custom_footer_text' ) ) { ?>
<div class="copyright"><?= '© ' . date( 'Y' ) . ' ' . esc_html( get_theme_mod( 'mvdk_custom_footer_text' ) ); ?></div>
<?php } ?>
<div class="legal-info"><a href="https://www.maartenvandekamp.nl/over/privacy/" rel="nofollow">Privacy</a> en <a href="https://www.maartenvandekamp.nl/over/privacy/cookies/" rel="nofollow">cookies</a> | <a href="https://www.maartenvandekamp.nl/over/auteursrecht/" rel="nofollow">Auteursrechterlijk beschermd</a></div>
</footer>
</div>
<?php if( !is_user_logged_in() ) { piwiktracker(); } ?>
<?php wp_footer(); ?>
</body>
</html>