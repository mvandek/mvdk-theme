<?php
/**
 * Template Name: Front Page
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content" itemprop="mainContentOfPage">

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Blog">
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
	</header>
<?php while ( have_posts() ) : the_post(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
<?php endwhile; // end of the loop. ?>
</div>

<section class="grid">
	<div class="grid-row">
		<div class="grid__item">
			<a href="<?php echo get_post_type_archive_link( 'basiskennis' ); ?>">
				<h2 class="grid__item-title">Basiskennis Fotografie</h2>
			</a>

		<div class="grid__item-list">
<?php 
    // Check for transient. If none, then execute Query
    if ( false === ( $basiskennis_posts = get_transient( 'basiskennis_front_page_query' ) ) ) {

        $args = array(
		'posts_per_page'	=> 8,
		'post_type'		=> 'basiskennis',
        );

        $basiskennis_posts = get_posts( $args );

      // Put the results in a transient. Expire after 12 hours.
      set_transient( 'basiskennis_front_page_query', $basiskennis_posts, 12 * 60 * 60 );

    }

	echo '<ul>';
		foreach ( $basiskennis_posts as $post ) : ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php
		endforeach;
	echo '</ul>';

	wp_reset_postdata();
?>
		</div>

		<a href="<?php echo get_post_type_archive_link( 'basiskennis' ); ?>" class="grid__item-footer" >Klik hier om alles te lezen.</a>

		</div>

		<div class="grid__item">
			<a href="<?php echo get_post_type_archive_link( 'praktijk' ); ?>">
			<h2 class="grid__item-title">In de Praktijk</h2>
			</a>

		<div class="grid__item-list">
<?php 
    // Check for transient. If none, then execute Query
    if ( false === ( $praktijk_posts = get_transient( 'praktijk_front_page_query' ) ) ) {

        $args = array(
		'posts_per_page'	=> 8,
		'post_type'		=> 'praktijk',
        );

        $praktijk_posts = get_posts( $args );

      // Put the results in a transient. Expire after 12 hours.
      set_transient( 'praktijk_front_page_query', $praktijk_posts, 12 * 60 * 60 );

    }

	echo '<ul>';
		foreach ( $praktijk_posts as $post ) : ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php
		endforeach;
	echo '</ul>';

	wp_reset_postdata();
?>
		</div>

	<a href="<?php echo get_post_type_archive_link( 'praktijk' ); ?>" class="grid__item-footer" >Klik hier om alles te lezen.</a>
		</div>
	</div>


	<div class="grid-row">
		<div class="grid__item">
			<a href="<?php echo get_post_type_archive_link( 'post' ); ?>">
				<h2 class="grid__item-title">Blog</h2>
			</a>

		<div class="grid__item-list">
<?php 
    // Check for transient. If none, then execute Query
    if ( false === ( $blog_posts = get_transient( 'blog_front_page_query' ) ) ) {

        $args = array(
		'posts_per_page'	=> 8,
        );

        $blog_posts = get_posts( $args );

      // Put the results in a transient. Expire after 12 hours.
      set_transient( 'blog_front_page_query', $blog_posts, 12 * 60 * 60 );

    }

	echo '<ul>';
		foreach ( $blog_posts as $post ) : ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php
		endforeach;
	echo '</ul>';

	wp_reset_postdata();
?>
		</div>

	<a href="<?php echo get_post_type_archive_link( 'post' ); ?>" class="grid__item-footer" >Klik hier om alles te lezen.</a>

		</div>

		<div class="grid__item">
			<a href="<?php echo get_post_type_archive_link( 'fotobewerking' ); ?>">
			<h2 class="grid__item-title">Fotobewerking</h2>
			</a>

		<div class="grid__item-list">

<?php 
    // Check for transient. If none, then execute Query
    if ( false === ( $fotobewerking_posts = get_transient( 'fotobewerking_front_page_query' ) ) ) {

        $args = array(
		'posts_per_page'	=> 8,
		'post_type'		=> 'fotobewerking',
        );

        $fotobewerking_posts = get_posts( $args );

      // Put the results in a transient. Expire after 12 hours.
      set_transient( 'fotobewerking_front_page_query', $fotobewerking_posts, 12 * 60 * 60 );

    }

	echo '<ul>';
		foreach ( $fotobewerking_posts as $post ) : ?>
			<li><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php
		endforeach;
	echo '</ul>';

	wp_reset_postdata();
?>
		</div>

	<a href="<?php echo get_post_type_archive_link( 'fotobewerking' ); ?>" class="grid__item-footer" >Klik hier om alles te lezen.</a>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>