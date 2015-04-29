<?php

/**
 * This file is for dev testing
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

function html_schema()
{
    $base = 'http://schema.org/';

    if( is_page( 'over' ) ) {
            $type = 'AboutPage';
    }
    elseif( is_page( 'contact' ) ) {
            $type = 'ContactPage';
    }
    elseif( is_page() ) {
            $type = 'WebPage';
    }
    elseif( is_single() ) {
            $type = 'BlogPost';
    }
    elseif( is_singular( array( 'gastartikel', 'portfolio', 'advertentie' ) /* add custom post types that describe a single item to this array */ )  ) {
            $type = 'ItemPage';
    }
    elseif( is_author() ) {
            $type = 'ProfilePage';
    }
    elseif( is_search() ) {
            $type = 'SearchResultsPage';
    }
    elseif( is_category() || is_tag() || is_archive() ) {
            $type = 'CollectionPage';
    }
    else {
                        $type = 'Blog';
        }
        _e( 'itemscope="itemscope" itemtype="' . $base . $type . '"' );
}