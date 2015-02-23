<?php
/**
 * The template for displaying all single workshops
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<div class="entry workshop-single">
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
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
<?php
wp_link_pages( array(
'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pagina\'s:', 'mvdk' ) . '</span>',
'after'       => '</div>',
'link_before' => '<span>',
'link_after'  => '</span>',
'pagelink'    => '<span class="screen-reader-text">' . __( 'Pagina', 'mvdk' ) . ' </span>%',
'separator'   => '<span class="screen-reader-text">, </span>',
) );
?>
</div>
<footer class="entry-utility">
<?php
echo get_the_term_list( get_the_ID(), 'workshop-type', '<div class="cpt-links">', _x( ', ', 'Used between list items, there is a space after the comma.', 'harmonic' ), '</div>' );
echo get_the_term_list( $post->ID, 'workshop-tag', '<div class="entry-tags" itemprop="keywords">', ' ', '</div>' );
?>
<div class="entry-related">
<div class="entry-related-module">
<h3 class="widget-title"><?php _e( 'Aanbevolen om te lezen', 'mvdk' ); ?></h3>
<?php
$get_tags_from_post = get_the_terms( $post->ID, 'workshop-tag' );
$tag_ids = wp_list_pluck( $get_tags_from_post, 'term_id' );
$args = array(
'tag__in' => $tag_ids,
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
'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( '&laquo; Vorig artikel', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Vorig artikel:', 'mvdk' ) . '</span> ',
'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Volgend artikel &raquo;', 'mvdk' ) . '</span> ' .
'<span class="screen-reader-text">' . __( 'Volgend artikel:', 'mvdk' ) . '</span> ',
) );
?>
<?php endwhile; ?>
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