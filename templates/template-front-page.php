<?php
/**
 * Template Name: Homepage
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">
<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Blog">
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
</section>
<?php

// Uitgelicht Query
if ( get_query_var( 'paged' ) ) :
	$paged = get_query_var( 'paged' );
elseif ( get_query_var( 'page' ) ) :
	$paged = get_query_var( 'page' );
else :
	$paged = 1;
endif;

$args = [
	'post_type'		=> array( 'basiskennis', 'fotobewerking', 'praktijk', ),
	'paged'			=> $paged,
	'posts_per_page'	=> 5,
	'meta_key'		=> 'uitgelicht_maak-deze-post-uitgelicht',
	'meta_value_num'	=> '1',
];
$wp_query = new WP_Query( $args );

// Update the thumbnail cache
update_post_thumbnail_cache( $wp_query );

// Loop
if ( $wp_query -> have_posts() ) {
	while ( $wp_query -> have_posts() ) :
		$wp_query -> the_post();
			get_template_part( 'content', get_post_format() );
	endwhile;
wp_reset_postdata();
?>

<?php mvdk_paging_nav(); ?>

<?php
} else {
	get_template_part( 'content', 'none' );
}
?>
</main>

<?php
get_sidebar();
get_footer();
?>
