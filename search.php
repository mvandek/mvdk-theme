<?php
/**
 * The template for displaying the Search results pages
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/SearchResultsPage">
<?php if( have_posts() ) : ?>
<header class="entry-header">
<h2 class="entry-title" itemprop="headline"><?php printf( __( 'Uw zoekopdracht: %s', 'mvdk' ), get_search_query() ); ?></h2>
</header>
<?php while( have_posts() ) : the_post();
get_template_part( 'content', get_post_format() );
endwhile;
mvdk_paging_nav();
else :
get_template_part( 'content', 'none' );
endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>