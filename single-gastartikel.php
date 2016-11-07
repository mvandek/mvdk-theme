<?php
/**
 * The template for displaying all single posts
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">
<article id="post-<?php the_ID(); ?>" itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<?php while ( have_posts() ) : the_post(); ?>
<?php if( is_preview() ) : ?>
<div class="alert alert-info"><strong>Let op:</strong> Je bekijkt een preview, dit artikel is nog niet gepubliceerd!</div>
<?php endif; ?>
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
<footer class="entry-utility">
<?php
$tags_list = get_the_tag_list( '', esc_html__( ' ', 'mvdk' ) );
if( $tags_list && ! is_wp_error( $tags_list ) ) {
printf( '<div class="entry-terms taxonomy-post-tag" itemprop="keywords">' . esc_html__( '%1$s', 'mvdk' ) . '</div>', $tags_list ); // WPCS: XSS OK.
}
?>
<div class="entry-related">
<section class="entry-related-module">
<h3 class="widget-title"><?php _e( 'Blijf ontdekken!', 'mvdk' ); ?></h3>
<?php
$get_terms_from_post = get_the_terms( $post->ID, 'post_tag' );
$term_ids = wp_list_pluck( $get_terms_from_post, 'term_id' );
$term_args = [
'tag__in' => $term_ids,
'post__not_in' => [$post->ID],
'posts_per_page'=> 5,
'no_found_rows' => true,
'cache_results' => false,
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
'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Vorig artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . esc_html__( 'Vorig artikel', 'mvdk' ) . '</span> ',
'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Volgend artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . esc_html__( 'Volgend artikel', 'mvdk' ) . '</span> ',
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