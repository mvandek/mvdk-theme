<?php
/**
 * The template for displaying the header
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes">

<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>

<link rel="prefetch" href="https://www.maartenvandekamp.nl/wp-content/plugins/piwik-tracker/js/piwik.js">
<link rel="prefetch" href="https://www.maartenvandekamp.nl/wp-content/plugins/piwik-tracker/js/piwik-config.js">
<link rel="preconnect" href="http://stat.mvandek.nl/">
<link rel="dns-prefetch" href="//secure.gravatar.com/">
<link rel="dns-prefetch" href="//s0.wp.com/">

<?php wp_head(); ?>

</head>

<body <?php body_class() ?>>

<!--[if gte IE 9]>
<div class="browsehappy">Zoals je kunt zien wordt de website niet bepaald goed weergegeven. Dat komt omdat je een <strong>sterk verouderde</strong> browser gebruikt, waardoor de website niet goed wordt weergegeven. <a href="http://browsehappy.com/">Upgrade je browser</a> als dat mogelijk is om veilig te kunnen internetten en om deze website optimaal te kunnen gebruiken.</div>
<![endif]-->

<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Ga naar de inhoud van de website', 'mvdk' ); ?></a>
<header id="masthead" class="header" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
<div class="site-branding" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<?php
if ( is_front_page() && is_home() ) : ?>
<h1 class="site-title" itemprop="name"><a href="<?= esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php else : ?>
<p class="site-title" itemprop="name"><a href="<?= esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></p>
<?php endif; ?>

<?php $description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) { ?>
<p class="site-description" itemprop="description"><?= $description; ?></p>
<?php } ?>

<?php get_template_part( 'menu', 'social' ); ?>

</div>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
<nav id="site-navigation" class="main-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'mvdk' ); ?></button>
<?php
// Primary navigation menu.
wp_nav_menu( [
'menu_class'		=> 'nav-menu',
'theme_location'	=> 'primary',
'container'		=> false,
'menu_id'		=> 'primary-menu',
] );
?>
</nav><!-- .main-navigation -->
<?php endif; ?>
</header>

<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>

<div id="content" class="container">