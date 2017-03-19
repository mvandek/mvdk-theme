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

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Ga naar de inhoud van de website', 'mvdk' ); ?></a>
<header id="masthead" class="header" itemscope itemtype="http://schema.org/WebPageElement">
<div class="site-branding" itemscope itemtype="http://schema.org/WPHeader">
<?php
$home = get_home_url();
$name = get_bloginfo( 'name' );
if ( !is_front_page() && is_home() ) { ?>
<h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( $home ); ?>" itemprop="url" rel="home"><?php echo esc_html( $name ); ?></a></h1>
<?php } else { ?>
<div class="site-title" itemprop="name"><a href="<?php echo esc_url( $home ); ?>" itemprop="url" rel="home"><?php echo esc_html( $name ); ?></a></div>
<?php } ?>

<?php $description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) { ?>
<div class="site-description" itemprop="description"><?php echo esc_html( $description ); ?></div>
<?php } ?>

<?php mvdk_social_menu(); // get_template_part( 'menu', 'social' ); ?>

</div>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
<nav id="site-navigation" class="main-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'mvdk' ); ?></button>
<?php
// Primary navigation menu.
wp_nav_menu( [
'menu_class'		=> 'nav-menu',
'theme_location'	=> 'primary',
'container'		=> false,
'menu_id'		=> 'primary-menu',
'link_before'		=> '<span itemprop="name">', 
'link_after'		=> '</span>'
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