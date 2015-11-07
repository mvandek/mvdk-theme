<?php
/**
 * Template Name: Site Archive
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CollectionPage">
<?php while ( have_posts() ) : the_post(); ?>
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
<li><?= get_the_date(); ?> &mdash; <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php
endwhile;
endif;
wp_reset_postdata(); ?>
</ul>
</div>
</article>
</main>
<?php get_footer(); ?>