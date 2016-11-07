<?php
/**
 * Template Name: Uitgelicht
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Blog">
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<?php if ( ! is_paged() ) { ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content">
<?php the_content(); ?>
</div>
<?php endwhile; // end of the loop. ?>
<?php } // End of checking function is_paged() ?>
</div>
<?php

// Uitgelicht Query
if ( get_query_var( 'paged' ) ) :
	$paged = get_query_var( 'paged' );
elseif ( get_query_var( 'page' ) ) :
	$paged = get_query_var( 'page' );
else :
	$paged = 1;
endif;

$args = array(
	'post_type'	 => array( 'basiskennis', 'fotobewerking', 'praktijk', ),
	'paged'          => $paged,
	'posts_per_page' => 5,
	'meta_query' => array(
		array(
			'key' => 'uitgelicht_maak-deze-post-uitgelicht',
			'value' => '1',
			'compare' => '=',
			'type'      => 'BINARY',
		)
	)
);
$wp_query = new WP_Query ( $args );

// Update the thumbnail cache
update_post_thumbnail_cache( $wp_query );

// Loop
if ( $wp_query -> have_posts() ) :
?>
<?php while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>
<?php
// Don't print empty markup if there's only one page.
if ( $wp_query->max_num_pages < 2 ) {
return;
}
?>
<nav class="navigation pagination">
<h2 class="screen-reader-text"><?php _e( 'Navigatie voor pagina\'s', 'mvdk' ); ?></h2>
<div class="nav-links">
<?php if ( get_previous_posts_link() ) { ?>
<div class="nav-previous"><?php previous_posts_link( __( 'Terug', 'mvdk' ) ); ?></div>
<?php } ?>
<?php if ( get_next_posts_link() ) { ?>
<div class="nav-next"><?php next_posts_link( __( 'Meer', 'mvdk' ) ); ?></div>
<?php } ?>
</div>
</nav>

<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>