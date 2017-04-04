<?php
/**
 * Template Name: Full Width
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemscope itemtype="http://schema.org/ItemPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainContentOfPage">
<?php while ( have_posts() ) : the_post(); ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content" itemprop="text">
<?php the_content(); ?>
</div>
<?php
wp_link_pages( [
'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pagina\'s:', 'mvdk' ) . '</span>',
'after'       => '</div>',
'link_before' => '<span>',
'link_after'  => '</span>',
'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Pagina', 'mvdk' ) . ' </span>%',
'separator'   => '<span class="screen-reader-text">, </span>',
] );
?>
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