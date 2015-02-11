<?php
<?php
/**
 * Template Name: Site Archive Page
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" role="main">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<div class="entry template-archive">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<?php the_content(); 
endwhile;
wp_reset_postdata(); ?>
<ul>
<?php
$posts = all_posts_archive_page();
if( $posts->have_posts() ) : while ($posts->have_posts() ) : $posts->the_post(); ?>
<li><?php echo get_the_date(); ?> &mdash; <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php
endwhile;
endif;
wp_reset_postdata(); ?>
</ul>
</div>
</article>
</main>
<?php get_footer(); ?>