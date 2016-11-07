<?php
/**
 * The template for displaying all Praktijk posts
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">
<article id="post-<?php the_ID(); ?>" itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<?php while ( have_posts() ) : the_post(); ?>
<?php if( is_preview() ) { ?>
<div class="alert alert-info"><strong>Let op:</strong> Je bekijkt een preview, dit artikel is nog niet gepubliceerd!</div>
<?php } ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
<div class="entry-meta">
<?php mvdk_entry_meta(); ?>
<?php edit_post_link( __( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</header>
<div class="entry-content" itemprop="articleBody">
<?php the_content(); ?>
</div>
<footer class="entry-utility">
<?php
$tags_list = get_the_tag_list( '', esc_html__( ' ', 'mvdk' ) );
if( ! empty( $tags_list ) && ! is_wp_error( $tags_list ) ) {
printf( '<div class="entry-terms taxonomy-post-tag" itemprop="keywords">' . esc_html__( '%1$s', 'mvdk' ) . '</div>', $tags_list ); // WPCS: XSS OK.
}
?>
<?php
$terms = get_the_term_list( $post->ID, 'onderwerp' );
if( $terms ) {
printf( '<div class="entry-terms taxonomy-onderwerp" itemprop="articleSection">' . esc_html__( '%1$s', 'mvdk' ) . '</div>', $terms ); // WPCS: XSS OK.
}
?>
<?php
$terms = get_the_term_list( $post->ID, 'software' );
if( $terms ) {
printf( '<div class="entry-terms taxonomy-software" itemprop="articleSection">' . esc_html__( '%1$s', 'mvdk' ) . '</div>', $terms ); // WPCS: XSS OK.
}
?>
<?php
$terms = get_the_term_list( $post->ID, 'locatie' );
if( $terms ) {
printf( '<div class="entry-terms taxonomy-location" itemprop="articleSection">' . esc_html__( '%1$s', 'mvdk' ) . '</div>', $terms ); // WPCS: XSS OK.
}
?>
<div class="entry-related">
<section class="entry-related-module">
<h3 class="widget-title"><?php _e( 'Blijf ontdekken!', 'mvdk' ); ?></h3>
<?php
$get_post_tag_terms_from_post = get_the_terms( $post->ID, 'post_tag' );
if( $get_post_tag_terms_from_post ) {
	$post_tag_ids = wp_list_pluck( $get_post_tag_terms_from_post, 'term_id' );
}
$get_onderwerp_terms_from_post = get_the_terms( $post->ID, 'onderwerp' );
if( $get_onderwerp_terms_from_post ) {
	$onderwerp_ids = wp_list_pluck( $get_onderwerp_terms_from_post, 'term_id' );
}
$get_software_terms_from_post = get_the_terms( $post->ID, 'software' );
if( $get_software_terms_from_post ) {
	$software_ids = wp_list_pluck( $get_software_terms_from_post, 'term_id' );
}
$get_locatie_terms_from_post = get_the_terms( $post->ID, 'locatie' );
if( $get_locatie_terms_from_post ) {
	$locatie_ids = wp_list_pluck( $get_locatie_terms_from_post, 'term_id' );
}
$term_args = [
'cache_results' => false,
'no_found_rows' => true,
'post__not_in' => [$post->ID],
'posts_per_page'=> 5,
'tax_query' => [
'relation' => 'OR',
[
'taxonomy' => 'post_tag',
'terms'    => $post_tag_ids,
'include_children' => false,
],
[
'taxonomy' => 'onderwerp',
'terms'    => $onderwerp_ids,
],
[
'taxonomy' => 'software',
'terms'    => $software_ids,
'include_children' => false,
],
[
'taxonomy' => 'locatie',
'terms'    => $locatie_ids,
'include_children' => false,
],
],
];
$term_query = new WP_Query($term_args);
if( $term_query->have_posts() ) { ?>
<ul>
<?php while ( $term_query->have_posts() ) {
$term_query->the_post();
printf( '<li><a href="%1$s" rel="bookmark">%2$s</a></li>', esc_url( get_permalink() ), get_the_title() );
}
?>
</ul>
<?php } else { ?>
<p><?php _e( 'Er zijn nog geen relevante aanbevelingen', 'mvdk' ); ?></p>
<?php }
wp_reset_postdata();
?>
</section>

<section class="entry-related-module">
<?php get_sidebar( 'single' ); ?>
</section>
</div>

<?php if( is_active_sidebar( 'sidebar-search' ) ) : ?>
<div class="entry-related">
<?php dynamic_sidebar( 'sidebar-search' ) ; ?>
</div>
<?php endif; ?>

</footer>
<?php mvdk_post_author(); ?>
<?php
the_post_navigation( [
'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Vorig artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Vorig artikel', 'mvdk' ) . '</span> ',
'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Volgend artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Volgend artikel', 'mvdk' ) . '</span> ',
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
<?php // get_sidebar(); ?>
<?php get_footer(); ?>