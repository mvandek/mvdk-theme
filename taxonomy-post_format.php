<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display archive-type pages for posts with a post format.
 * If you'd like to further customize these Post Format views, you may create a
 * new template file for each specific one.
 *
 * @todo https://core.trac.wordpress.org/ticket/23257: Add plural versions of Post Format strings
 * and remove plurals below.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/CollectionPage">
<div class="entry taxonomy">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<?php if ( have_posts() ) : ?>
<header class="entry-header">
<h1 class="entry-title" itemprop="headline"><?php printf( __( '%s archief', 'mvdk' ), '<span>' . get_post_format_string( get_post_format() ) . '</span>' ); ?></h1>
</header>
<?php while ( have_posts() ) : the_post(); 
get_template_part( 'content', get_post_format() );
endwhile; ?>
<?php mvdk_paging_nav();
else :
get_template_part( 'content', 'none' );
endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>