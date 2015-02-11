<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" role="main" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="entry index">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post();
get_template_part( 'content', get_post_format() );
endwhile;
esplanade_paging_nav();
else :
get_template_part( 'content', 'none' );
endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
