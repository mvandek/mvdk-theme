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
	if( is_page( 5 /* type in the ID of your contact page here, 5 is an example */ ) )
	{
		$type = 'ContactPage';
	}
	elseif( is_page( 4 /* type in the ID of your about page here, 5 is an example */ ) )
	{
		$type = 'AboutPage';
	}
	elseif( is_singular( array( 'book', 'movie' ) /* add custom post types that describe a single item to this array */ )  )
	{
		$type = 'ItemPage';
	}
	elseif( is_author() )
	{
		$type = 'ProfilePage';
	}
	elseif( is_search() )
	{
		$type = 'SearchResultsPage';
	}
	else
	{
		$type = 'WebPage';
	}
	echo 'itemscope="itemscope" itemtype="' . $base . $type . '"';
}