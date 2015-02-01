<?php
/*
* Template Name: Workshops
*/
get_header(); ?>
<main class="page-content" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<div class="entry page">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<?php
$loop = new WP_Query( array( 'post_type' => 'mvdk-workshop' ) );
while ( $loop->have_posts() ) : $loop->the_post();
get_template_part( 'content', 'workshop' );
endwhile; // end of the Menu Item Loop
wp_reset_postdata();
?>
</div>
<?php wp_link_pages( array( 'before' => '<footer class="entry-utility"><p class="post-pagination">' . __( 'Pagina:', 'esplanade' ), 'after' => '</p></footer>' ) ); ?>
</div>
</article>
</main>
<?php get_footer(); ?>