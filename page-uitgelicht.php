<?php
/**
 * Template Name: Uitgelicht
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<div class="entry page portfolio">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content" itemprop="mainContentOfPage">
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
<?php endwhile; // end of the loop. ?>
</article>
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
	'post_type'	 => array( 'post', 'basiskennis', 'portfolio'),
	'paged'          => $paged,
	'posts_per_page' => 5,
	'meta_query' => array(
		array(
			'key' => 'uitgelicht_selecteer_het_vinkje_om_dit_artikel_uitgelicht_te_maken',
			'value' => 'selecteer-het-vinkje-om-dit-artikel-uitgelicht-te-maken',
			'compare' => '='
		)
	)
);
$wp_query = new WP_Query ( $args );
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
<nav class="navigation pagination" role="navigation">
<h2 class="screen-reader-text"><?php esc_html_e( 'Navigatie voor pagina\'s', 'mvdk' ); ?></h2>
<div class="nav-links">
<?php if ( get_previous_posts_link() ) { ?>
<div class="nav-previous"><?php previous_posts_link( esc_html__( 'Terug', 'mvdk' ) ); ?></div>
<?php } ?>
<?php if ( get_next_posts_link() ) { ?>
<div class="nav-next"><?php next_posts_link( esc_html__( 'Meer', 'mvdk' ) ); ?></div>
<?php } ?>
</div>
</nav>

<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>