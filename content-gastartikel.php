<?php
/**
 * The default template for displaying content for the custom post type gastartikel
 *
 * Used for custom post type gastartikel.
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<article <?php post_class('padding-20px'); ?> id="post-<?php the_ID(); ?>" itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<?php if ( has_post_thumbnail() ) : ?>
<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('post-thumbnail', [ 'itemprop' => 'image' ] ); ?></a>
<?php endif;?>
<header class="entry-header">
<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
</header>
<div class="entry-summary" itemprop="description">
<?php the_excerpt(); ?>
</div>
<footer class="entry-footer">
<?php mvdk_entry_meta(); ?>
<?php edit_post_link( esc_html__( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</footer>
</article>