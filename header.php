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
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<link rel="pingback" href="https://www.maartenvandekamp.nl/xmlrpc.php">
<link rel="dns-prefetch" href="//staticcdn.nl/">
<link rel="dns-prefetch" href="//stat.maartenvandekamp.nl/">
<link rel="dns-prefetch" href="//secure.gravatar.com/">
<!--[if gte IE 9]>
<div class="browsehappy">Zoals je kunt zien wordt de website niet bepaald goed weergegeven. Dat komt omdat je een <strong>sterk verouderde</strong> browser gebruikt, waardoor de website niet goed wordt weergegeven. <a href="http://browsehappy.com/">Upgrade je browser</a> als dat mogelijk is om veilig te kunnen internetten en om deze website optimaal te kunnen gebruiken.</div>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<div class="site">
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Ga naar de inhoud van de website', 'mvdk' ); ?></a>
<header id="masthead" class="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WebPageElement">
<div class="site-branding" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<?php
if ( is_front_page() && is_home() ) : ?>
<h1 class="site-title" itemprop="name"><a href="<?= esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php else : ?>
<p class="site-title" itemprop="name"><a href="<?= esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></p>
<?php endif;
$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) { ?>
<p class="site-description" itemprop="description"><?= $description; ?></p>
<?php } ?>
<?php get_template_part( 'menu', 'social' ); ?>
</div>
<nav id="site-navigation" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php _e( 'Menu', 'mvdk' ); ?></button>
<?php
// Primary navigation menu.
wp_nav_menu( [
'menu_class'     => 'nav-menu',
'theme_location' => 'primary',
'container'      => false,
'menu_id' => 'primary-menu'
] );
?>
</nav><!-- .main-navigation -->
</header>
<div id="content" class="container">