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

$term_id = '850';
$term_args = [
'posts_per_page'=> 5,
'paged'         => $paged,
	'tax_query' => [
		[
		'taxonomy' => 'onderwerp',
		'terms'    => $term_id,
		'include_children' => false,
		],
	],
];
$wp_query = new WP_Query( $term_args );

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