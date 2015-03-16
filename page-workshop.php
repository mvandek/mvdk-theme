<?php
/**
 * Template Name: Workshop Page
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemscope="itemscope" itemtype="http://schema.org/Event">
<div class="entry page workshop">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<?php if ( ! get_theme_mod( 'mvdk_hide_workshop_page_content' ) ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="entry-content" itemprop="mainContentOfPage">
<?php the_content(); ?>
</div>
<?php
wp_link_pages( [
'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pagina\'s:', 'mvdk' ) . '</span>',
'after'       => '</div>',
'link_before' => '<span>',
'link_after'  => '</span>',
'pagelink'    => '<span class="screen-reader-text">' . __( 'Pagina', 'mvdk' ) . ' </span>%',
'separator'   => '<span class="screen-reader-text">, </span>',
] );
?>
<?php endwhile; // end of the loop. ?>
<?php endif; ?>
</article>
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$posts_per_page = get_option( 'mvdk_workshops_posts_per_page', '10' );
$args = [
'post_type'      => 'workshop',
'posts_per_page' => $posts_per_page,
'paged'          => $paged,
];
$project_query = new WP_Query ( $args );
if ( $project_query -> have_posts() ) :
?>
<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>
<?php get_template_part( 'content', 'workshop' ); ?>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>