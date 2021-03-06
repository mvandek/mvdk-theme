<?php
/**
 * The template for displaying all single advertenties
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

<?php while ( have_posts() ) : the_post(); ?>
<?php if( is_preview() ) { ?>
<div class="alert alert-info"><strong>Let op:</strong> Je bekijkt een preview, dit artikel is nog niet gepubliceerd!</div>
<?php } ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
<div class="entry-meta">
<?php mvdk_entry_meta(); ?>
<?php edit_post_link( esc_html__( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</header>
<div class="entry-content" itemprop="articleBody">
<?php the_content(); ?>
</div>
<?php endwhile; ?>
<footer class="entry-utility">
<?php
$post_type = get_post_type();
foreach ( get_object_taxonomies( $post_type ) as $tax_name ) {
	$term_list = get_the_term_list( $post->ID, $tax_name, '', ' ', '' );
	if ( !empty( $term_list ) ) {
		$the_tax = get_taxonomy( $tax_name );
		?>
		<div class="taxonomy-<?php echo esc_attr( $tax_name ); ?> entry-terms">
			<?php echo wp_kses_post( $term_list ); ?>
		</div>
		<?php
	}
}
?>
<div class="entry-related">
<section class="entry-related-module">
<h3 class="widget-title"><?php echo esc_html( 'Relevante artikelen' ); ?></h3>
<?php
$get_onderwerp_terms_from_post = get_the_terms( $post->ID, 'onderwerp' );
if( $get_onderwerp_terms_from_post && ! is_wp_error( $get_onderwerp_terms_from_post ) ) {
	$onderwerp_ids = wp_list_pluck( $get_onderwerp_terms_from_post, 'term_id' );
}
$get_software_terms_from_post = get_the_terms( $post->ID, 'software' );
if( $get_software_terms_from_post && ! is_wp_error( $get_software_terms_from_post ) ) {
	$software_ids = wp_list_pluck( $get_software_terms_from_post, 'term_id' );
}
$term_args = [
'update_post_term_cache' => false,
'update_post_meta_cache' => false,
'no_found_rows' => true,
'orderby' => 'rand',
'post__not_in' => [$post->ID],
'posts_per_page'=> 5,
'tax_query' => [
'relation' => 'OR',
[
'taxonomy' => 'onderwerp',
'terms'    => $onderwerp_ids,
],
[
'taxonomy' => 'software',
'terms'    => $software_ids,
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
<p><?php echo esc_html( 'Er zijn geen relevante artikelen beschikbaar' ); ?></p>
<?php }
wp_reset_postdata();
?>
</section>
<section class="entry-related-module">
<?php get_sidebar( 'single' ); ?>
</section>
</div>

<?php if( is_active_sidebar( 'sidebar-search' ) ) : ?>
<div class="entry-search">
<?php dynamic_sidebar( 'sidebar-search' ) ; ?>
</div>
<?php endif; ?>

</footer>

</article>

<?php mvdk_post_author(); ?>

<?php
the_post_navigation( [
'prev_text' => '<div class="meta-nav">' . esc_html( 'Vorig artikel' ) . '</div> ',
'next_text' => '<div class="meta-nav">' . esc_html( 'Volgend artikel' ) . '</div> ',
] );
?>

<?php
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || get_comments_number() ) {
comments_template();
}
?>
</main>
<?php // get_sidebar(); ?>
<?php get_footer(); ?>