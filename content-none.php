<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */
?>
<?php if ( is_search() ) { ?>
<article class="post hentry" id="post-0">
<h1 class="entry-title" itemprop="headline"><?php _e('Geen resultaat'); ?></h1>
<div class="entry-content" itemprop="description">
<p><?php _e('De zoekmachine heeft zijn best gedaan en we kunnen maar 1 ding zeggen: dit hebben we niet...'); ?></p>
</div>
</article>
<?php } else { ?>
<article class="post hentry" id="post-0">
<h1 class="entry-title" itemprop="headline"><?php _e('Geen content'); ?></h1>
<div class="entry-content" itemprop="description">
<p><?php _e('Momenteel is er geen content beschikbaar op deze pagina.'); ?></p>
<p><?php _e('Het kan zijn dat de content nog geschreven moet worden, niet publiekelijk toegankelijk is, verwijderd is, of dat je hier bent gekomen omdat je een typefout hebt gemaakt.'); ?></p>
</div>
</article>
<?php } ?>