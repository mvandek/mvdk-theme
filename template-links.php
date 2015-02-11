<?php
/**
 * Template Name: Links page
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" role="main">
<article id="post-<?php the_ID(); ?>"<?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<div class="entry template-links">
<?php while ( have_posts() ) : the_post(); ?>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>
</header>
<div class="entry-content" itemprop="mainContentOfPage">
<?php the_content();
endwhile;
wp_reset_query();
$args = array(
'title_li' => false,
'title_before' => '<h2>',
'title_after' => '</h2>',
'category_before' => false,
'category_after' => false,
'categorize' => true,
'show_description' => true,
'between' => '<br />',
'show_images' => false,
'show_rating' => false,
);
wp_list_bookmarks( $args ); ?>
</div>
</div>
</article>
</main>
<?php get_footer(); ?>