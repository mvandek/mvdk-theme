<?php
/**
 * The template for displaying posts with Locatie taxonomy
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
<main class="content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">
<?php 
$term_id = get_queried_object_id();
$geo_latitude = get_term_meta( $term_id, 'locatie_latitude', true );
$geo_longtitude = get_term_meta( $term_id, 'locatie_longtitude', true );
if( !empty( $geo_latitude ) && !empty( $geo_longtitude ) ) {
?>
<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
<meta itemprop="latitude" content="<?php echo $geo_latitude; ?>" />
<meta itemprop="longitude" content="<?php echo $geo_longtitude; ?>" />
</div>
<?php } ?>
<?php if ( have_posts() ) : ?>
<header class="entry-header">
<h1 class="entry-title" itemprop="headline">
<?php
if ( is_tax() ) {
$tax = get_taxonomy( get_queried_object()->taxonomy );
$title = sprintf( esc_html__( '%1$s: %2$s', 'mvdk' ), $tax->labels->singular_name, single_term_title( '', false ) );
}
if ( ! empty( $title ) ) { echo $title; }
?>
</h1>
</header>
<?php while ( have_posts() ) : the_post(); 
get_template_part( 'content', get_post_format() );
endwhile;
mvdk_paging_nav();
else :
get_template_part( 'content', 'none' );
endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>