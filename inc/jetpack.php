<?php
/**
 * This adds Jetpack functionality to the theme
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

function mvdk_jetpack_setup() {

	// This theme supports Portfolios
	add_theme_support( 'portfolio' );

	// This theme supports Workshops
	add_theme_support( 'gastartikel' );

	// This theme supports Advertenties
	add_theme_support( 'advertentie' );
	
	// Support for Jetpack Responsive Videos
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'mvdk_jetpack_setup' );

// Will add a checkbox option to every new post of whether or not to email the post to subscribers.
add_filter( 'jetpack_allow_per_post_subscriptions', '__return_true' );