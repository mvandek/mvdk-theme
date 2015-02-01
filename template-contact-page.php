<?php
/* 
* Template Name: Contact Page
*/
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
wpcf7_enqueue_scripts();
}
if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
wpcf7_enqueue_styles();
}
/* 
* Nodig voor de contact formulieren van Contact Form 7, anders worden de css en js bestanden niet geladen.
*/
get_header(); ?>
<main class="page-content" role="main" itemscope="itemscope" itemtype="http://schema.org/ContactPage">
<?php while ( have_posts() ) : the_post();
get_template_part( 'content', 'contactpage' );
endwhile; ?>
</main>
<?php get_footer(); ?>