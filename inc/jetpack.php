<?php
/**
 * This adds Jetpack functionality to the theme
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

function mvdk_jetpack_setup() {

	// Add theme support for Social Menu.
	add_theme_support( 'jetpack-social-menu', 'svg' );
	
	// Support for Jetpack Responsive Videos
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'mvdk_jetpack_setup' );

// Will add a checkbox option to every new post of whether or not to email the post to subscribers.
add_filter( 'jetpack_allow_per_post_subscriptions', '__return_true' );

/**
 * Return early if Social Menu is not available.
 */
function mvdk_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		jetpack_social_menu();
	}
}

function remove_jetpack_social_menu_css() {
	// Dequeue Jetpack Social Menu CSS
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	} else {
		remove_action( 'wp_enqueue_scripts', 'jetpack_social_menu_style' );
	}
}
add_action( 'after_setup_theme', 'remove_jetpack_social_menu_css', 99 );