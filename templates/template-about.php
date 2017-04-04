<?php
/**
 * Template Name: About
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemscope itemtype="http://schema.org/AboutPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainContentOfPage">
<?php while ( have_posts() ) : the_post(); ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content" itemprop="text">
<?php the_content(); ?>
</div>
<?php endwhile; ?>
</article>
</main>
<?php get_footer(); ?>
