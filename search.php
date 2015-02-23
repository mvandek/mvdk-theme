<?php
/**
 * The template for displaying the Search results pages
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage">
<div class="entry search">
<?php if( have_posts() ) : ?>
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<header class="entry-header">
<h2 class="entry-title" itemprop="headline"><?php printf( __( 'Uw zoekopdracht: %s', 'mvdk' ), get_search_query() ); ?></h2>
<?php get_search_form(); ?>
</header>
<?php while( have_posts() ) : the_post();
get_template_part( 'content', get_post_format() );
endwhile;
mvdk_paging_nav();
else :
get_template_part( 'content', 'none' );
endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>