<!DOCTYPE html>
<html dir="ltr" lang="NL">
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
<body <?php body_class() ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div class="hfeed site">
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Ga naar de inhoud van de website', 'esplanade' ); ?></a>
<header id="masthead" class="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<div class="site-branding">
<?php
if ( is_front_page() && is_home() ) : ?>
<h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php else : ?>
<p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url" rel="home"><?php bloginfo( 'name' ); ?></a></p>
<?php endif;
$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) { ?>
<p class="site-description" itemprop="description"><?php echo $description; ?></p>
<?php } ?>
<?php get_template_part( 'menu', 'social' ); ?>
</div>
<?php if ( has_nav_menu( 'primary_nav' ) ) : ?>
<nav id="site-navigation" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
<button class="menu-toggle" aria-controls="menu-hoofdmenu" aria-expanded="false"><?php _e( 'Menu', 'esplanade' ); ?></button>
<?php
// Primary navigation menu.
wp_nav_menu( array(
'menu_class'     => 'nav-menu',
'theme_location' => 'primary_nav',
) );
?>
</nav><!-- .main-navigation -->
<?php endif; ?>
</header>
<div id="content" class="container">