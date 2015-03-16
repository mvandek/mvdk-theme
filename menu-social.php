<?php
/**
 * The Social nav menu, for displaying social icons.
 *
 * Thanks to Konstantin Kovshenin and Justin Tadlock for this idea.
 * http://kovshenin.com/2014/social-menus-in-wordpress-themes/
 * http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 *
 * @package Independent Publisher
 * @since   Independent Publisher 1.0
 */
if ( has_nav_menu( 'social' ) ) : ?>
<nav class="social-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<?php
// Social links navigation menu.
wp_nav_menu( [
'theme_location' => 'social',
'depth'          => 1,
'link_before'    => '<span class="screen-reader-text">',
'link_after'     => '</span>',
] );
?>
</nav><!-- .social-navigation -->
<?php endif;