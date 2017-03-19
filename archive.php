<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="page-content" itemscope itemtype="http://schema.org/Blog">
<?php if( have_posts() ) : ?>
<header class="entry-header">
<h1 class="entry-title" itemprop="headline">
<?php
	if ( is_category() ) {
		$title = sprintf( esc_html__( '%s', 'mvdk' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( esc_html__( '%s', 'mvdk' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( esc_html__( 'Het archief van %s', 'mvdk' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( esc_html__( 'Een overzicht van %s', 'mvdk' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'mvdk' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( esc_html__( 'Een overzicht van %s', 'mvdk' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'mvdk' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( esc_html__( 'Alle posts op %s', 'mvdk' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'mvdk' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = esc_html_x( 'Asides', 'post format archive title', 'mvdk' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = esc_html_x( 'Galleries', 'post format archive title', 'mvdk' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = esc_html_x( 'Afbeeldingen', 'post format archive title', 'mvdk' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = esc_html_x( 'Links', 'post format archive title', 'mvdk' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( '%s', 'mvdk' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'mvdk' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archief', 'mvdk' );
	}

if ( ! empty( $title ) ) {
		echo $title;
	}

?>
</h1>
</header>
<?php the_archive_description( '<div class="archive-meta" itemprop="description">', '</div>' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php
get_template_part( 'content', get_post_format() );
?>
<?php endwhile; ?>

<?php mvdk_paging_nav(); ?>

<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>