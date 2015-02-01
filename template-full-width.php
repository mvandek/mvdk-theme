<?php
/* 
* Template Name: Full Width
*/
get_header(); ?>
<main class="page-content" role="main" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
<?php while ( have_posts() ) : the_post();
get_template_part( 'content', 'page' );
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || get_comments_number() ) {
comments_template();
}
endwhile; ?>
</main>
<?php get_footer(); ?>