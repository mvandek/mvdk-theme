<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" role="main" itemprop="mainContentOfPage">
<div class="entry 404">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<article class="post hentry" id="post-0">
<header class="entry-header">
<h1 class="entry-title" itemprop="headline"><?php _e( '404: Bestaat niet (meer)', 'mvdk' ); ?></h1>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<p><?php _e( 'Deze pagina zorgt ervoor dat je geen ingewikkelde foutmelding krijgt. Deze pagina zie je omdat de pagina die je wil bezoeken niet meer bestaat, of een andere naam heeft gekregen.', 'mvdk' ); ?></p>
<p><?php _e( 'Geef het nog niet op. Je hebt hieronder de zoekfunctie en een lijstje met meest handige links tot je beschikking om je weg terug te vinden op deze website!', 'mvdk' ); ?></p>
<p>
<?php if( is_active_sidebar( '404' ) ) { ?>
<div class="widget-area 404" role="complementary">
<?php dynamic_sidebar( '404' ) ; ?>
</div>
<?php } ?>
</p>
</div>
</article>
</div>
</main>
<?php get_footer(); ?>