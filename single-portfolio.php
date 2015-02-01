<?php get_header(); ?>
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<?php while ( have_posts() ) : the_post();
get_template_part( 'content', 'portfolio-single' );
// If comments are open or we have at least one comment, load up the comment template
if ( comments_open() || get_comments_number() ) {
comments_template();
}
endwhile; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>