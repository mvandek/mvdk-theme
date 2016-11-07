<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<article <?php post_class('padding-20px'); ?> id="post-<?php the_ID(); ?>" itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
<?php if ( has_post_thumbnail() ) : ?>
<a href="<?php the_permalink(); ?>" rel="bookmark"><span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
<?php the_post_thumbnail('post-thumbnail', [ 'itemprop' => 'url' ] ); ?></span></a>
<?php endif;?>
<section class="entry-info">
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
</section>
</article>