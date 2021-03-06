<?php
/**
 * The template for displaying image attachments.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
get_header(); ?>
<main class="content">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php while ( have_posts() ) : the_post(); ?>

<header class="entry-header">
<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
</header><!-- .entry-header -->

<?php mvdk_entry_meta(); ?>

<div class="entry-content" itemscope="itemscope" itemtype="http://schema.org/ImageObject">

						<div class="entry-attachment">
							<?php
								/**
								 * Filter the default Twenty Fifteen image attachment size.
								 *
								 * @since Twenty Fifteen 1.0
								 *
								 * @param string $image_size Image size. Default 'large'.
								 */
								$image_size = apply_filters( 'mvdk_attachment_size', 'large' );

								echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>

							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption" itemprop="caption">
									<?php the_excerpt(); ?>
								</div><!-- .entry-caption -->
							<?php endif; ?>

						</div><!-- .entry-attachment -->

						<?php
							the_content();
							wp_link_pages( [
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pagina\'s:', 'mvdk' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Pagina', 'mvdk' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							] );
						?>
					</div><!-- .entry-content -->

<footer class="entry-footer">
<?php edit_post_link( __( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</footer><!-- .entry-footer -->

<?php
// Previous/next post navigation.
					the_post_navigation( [
						'prev_text' => _x( '<span class="meta-nav">Terug naar </span><span class="post-title">%title</span>', 'Parent post link', 'mvdk' ),
					] );
?>

</article>

<?php endwhile; ?>

<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
?>
</main>
<?php get_footer(); ?>