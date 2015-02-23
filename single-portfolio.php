<?php
/**
 * The template for displaying all single portfolios
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="workExample" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<div class="entry portfolio-single">
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<?php if( is_preview() ) : ?>
<div class="alert alert-info"><strong>Let op:</strong> Je bekijkt een preview, dit artikel is nog niet gepubliceerd!</div>
<?php endif; ?>
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
<footer class="entry-utility">
<?php
// echo get_the_term_list( get_the_ID(), 'portfolio-type', '<span class="cpt-links">', _x( ', ', 'Used between list items, there is a space after the comma.', 'harmonic' ), '</span>' );
// echo get_the_term_list( $post->ID, 'portfolio-tag', '<div class="entry-tags" itemprop="keywords">', ' ', '</div>' );
echo get_the_term_list( get_the_ID(), 'post_tag', '<div class="entry-tags" itemprop="keywords">', ' ', '</div>' );
?>
<div class="entry-related">
<div class="entry-related-module">
<h3 class="widget-title"><?php _e( 'Aanbevolen om te lezen', 'mvdk' ); ?></h3>
<?php
//$get_tags_from_post = get_the_terms( $post->ID, 'portfolio-tag' );
$get_tags_from_post = get_the_terms( $post->ID, 'post_tag' );
$get_tag_ids = wp_list_pluck( $get_tags_from_post, 'term_id' );
$args = array(
'tag__in' => $get_tag_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 5,
'no_found_rows' => true,
'cache_results' => false,
);
$tag_query = new WP_Query($args);
if( $tag_query->have_posts() ) { ?>
<ul>
<?php while ( $tag_query->have_posts() ) {
$tag_query->the_post();
printf( __( '<li><a href="%1$s" rel="bookmark" itemprop="relatedLink">%2$s</a></li>', 'mvdk' ), esc_url( get_permalink() ), get_the_title() );
}
?>
</ul>
<?php } else { ?>
<p><?php _e( 'Er zijn geen relevante aanbevelingen', 'mvdk' ); ?></p>
<?php }
wp_reset_postdata();
?>
</div>
<div class="entry-related-module">
<?php get_sidebar( 'single' ); ?>
</div>
</div>
</footer>
<?php mvdk_post_author(); ?>
<?php
the_post_navigation( array(
'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Volgend artikel &raquo;', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Volgend artikel:', 'mvdk' ) . '</span> ',
'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&laquo; Vorig artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Vorig artikel:', 'mvdk' ) . '</span> ',
) );
?>
<?php endwhile;?>
</div>
</article>
<?php
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || get_comments_number() ) {
comments_template();
}
?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>