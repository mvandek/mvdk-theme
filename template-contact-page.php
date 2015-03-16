<?php
/**
 * Template Name: Contact Page
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
wpcf7_enqueue_scripts();
}
if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
wpcf7_enqueue_styles();
}
/* 
* Nodig voor de contact formulieren van Contact Form 7, anders worden de css en js bestanden niet geladen.
*/
get_header(); ?>
<main class="page-content" role="main" itemscope="itemscope" itemtype="http://schema.org/ContactPage">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<div class="entry page">
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
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
<?php endwhile; ?>
</div>
</article>
</main>
<?php get_footer(); ?>