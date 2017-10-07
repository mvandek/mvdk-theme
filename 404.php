<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemprop="mainContentOfPage">
<section class="post hentry" id="post-404">
<header class="entry-header">
<h1 class="entry-title" itemprop="headline"><?php _e( 'Er is iets fout gegaan.', 'mvdk' ); ?></h1>
</header>
<div class="entry-content">
<p><?php _e( 'De link waarop je hebt geklikt is mogelijk buiten werking of de pagina is verwijderd.', 'mvdk' ); ?></p>
<p><?php _e( 'Gebruik de zoekfunctie om alsnog te vinden waar je naar op zoek bent. ', 'mvdk' ); ?></p>
<hr />
</div>
<div class="sidebar widget-area 404">
<?php dynamic_sidebar( 'page-404' ) ; ?>
</div>
</section>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>