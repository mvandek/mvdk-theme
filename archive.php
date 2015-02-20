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
<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/CollectionPage">
<div class="entry archive">
<?php if ( function_exists('breadcrumb_trail') ) {
breadcrumb_trail();
} ?>
<?php if( have_posts() ) : ?>
<header class="entry-header">
<h1 class="entry-title" itemprop="headline">
<?php
	if ( is_category() ) {
		$title = sprintf( __( '%s', '_s' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( '%s', '_s' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Het archief van %s', '_s' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Een overzicht van %s', '_s' ), get_the_date( _x( 'Y', 'yearly archives date format', '_s' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Een overzicht van %s', '_s' ), get_the_date( _x( 'F Y', 'monthly archives date format', '_s' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Alle posts op %s', '_s' ), get_the_date( _x( 'F j, Y', 'daily archives date format', '_s' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Afbeeldingen', 'post format archive title', '_s' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', '_s' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Overzicht van %s', '_s' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', '_s' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archief', '_s' );
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
<?php the_posts_navigation(); ?>
<?php else : ?>
<?php get_template_part( 'content', 'none' ); ?>
<?php endif; ?>
</div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>