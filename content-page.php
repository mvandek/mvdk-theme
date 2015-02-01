<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<div class="entry page">
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
wp_link_pages( array(
'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pagina\'s:', 'twentyfifteen' ) . '</span>',
'after'       => '</div>',
'link_before' => '<span>',
'link_after'  => '</span>',
'pagelink'    => '<span class="screen-reader-text">' . __( 'Pagina', 'twentyfifteen' ) . ' </span>%',
'separator'   => '<span class="screen-reader-text">, </span>',
) );
?>
</div>
</article>