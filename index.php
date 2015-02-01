<?php get_header(); ?>
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
