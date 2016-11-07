<?php
/**
 * The default template for displaying content for the custom post type fotoapparatuur
 *
 * Used for custom post type fotoapparatuur
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<article <?php post_class('padding-20px'); ?> id="post-<?php the_ID(); ?>">
<?php if ( has_post_thumbnail() ) : ?>
<a href="<?php the_permalink(); ?>" rel="bookmark"><span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<?php the_post_thumbnail('post-thumbnail', [ 'itemprop' => 'url' ] ); ?></span></a>
<?php endif;?>
<section class="entry-info">
<header class="entry-header">
<?php the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
</header>
<footer class="entry-footer">
<?php mvdk_entry_meta(); ?>
<?php edit_post_link( esc_html__( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</footer>
</section>
</article>
