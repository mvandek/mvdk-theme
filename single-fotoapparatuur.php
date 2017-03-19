<?php
/**
 * Template Name: Fotoapparatuur
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemprop="mainContentOfPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/ItemPage">
<?php while ( have_posts() ) : the_post(); ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<?php the_content(); ?>
</div>
<footer>
<p>Laatst bijgewerkt: <span itemprop="lastReviewed"><?php the_modified_date(); ?></span></p>
</footer>
<?php endwhile; ?>
</article>
<?php
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || get_comments_number() ) {
comments_template();
}
?>
</main>
<?php get_footer(); ?>