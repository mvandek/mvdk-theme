<?php

/**
 * This file is for dev testing
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

add_action( 'amp_post_template_footer', 'mvdk_amp_add_pixel' );
function mvdk_amp_add_pixel( $amp_template ) {
    $post_id = $amp_template->get( 'post_id' );
    ?>
<amp-pixel src="https://stat.mvandek.nl/piwik.php?idsite=1&rec=1&action_name=TITLE&urlref=DOCUMENT_REFERRER&url=CANONICAL_URL&dimension1=AMP&dimension2=AMP&rand=<?php echo wp_rand( 1000, 100000 ); ?>"></amp-pixel>
<?php
}

// Add style to embed links
add_action( 'embed_head', 'embed_top_style' );	
function embed_top_style(){ ?>
<style>
.wp-embed{color: initial}
.wp-embed .wp-embed-more{color:crimson}
</style>
<?php }