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

<meta charset="<?php echo esc_attr_e( get_bloginfo( 'charset' ) ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect" href="https://stat.mvandek.nl/">
<link rel="prefetch" href="https://www.maartenvandekamp.nl/wp-content/plugins/piwik-tracker/js/piwik.js">

<?php wp_head(); ?>

</head>

<body <?php body_class() ?>>

<!--[if gte IE 9]>
<div class="browsehappy">Je ziet deze melding omdat je browser zo oud is dat het niet meer loont om de website daarvoor te optimaliseren. Tijd om te upgraden (als dat kan en mag, stel je werkt in een bedrijf met verouderde software en jij hebt er niets over te zeggen...) Ga naar <a href="http://browsehappy.com/">BrowseHappy.com</a> om een moderne browser te downloaden die wel functioneert.</div>
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
<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'mvdk' ); ?></button>
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

<?php
if ( function_exists('breadcrumb_trail') ) {
	breadcrumb_trail();
}
?>

<div id="content" class="container">