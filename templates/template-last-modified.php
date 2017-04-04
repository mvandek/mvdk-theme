<?php
/**
 * Template Name: Last Modified
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemscope itemtype="http://schema.org/CollectionPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="mainContentOfPage">
<?php while ( have_posts() ) : the_post(); ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content">
<?php the_content(); 
endwhile;
wp_reset_postdata(); ?>

<?php
$query = [
'post_type'		=> [ 'post', 'basiskennis', 'fotobewerking', 'praktijk', ],
'orderby'		=> 'modified',
'nopaging'		=> true,
'ignore_sticky_posts'	=> true,
'no_found_rows'		=> true,
'cache_results'		=> false,
];
$posts = new WP_Query($query);
if( $posts->have_posts() ) : ?>
<ul>
<?php while ($posts->have_posts() ) : $posts->the_post(); ?>
<li>Bijgewerkt op <?php the_modified_date(); ?> &mdash; <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></span></li>
<?php endwhile;
wp_reset_postdata(); ?>
</ul>
<?php endif; ?>
</div>
</article>
</main>
<?php get_footer(); ?>