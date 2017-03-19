<?php
/**
 * The template for displaying page content
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
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
</article>