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

        // This theme supports Jetpack Testimonials
	// add_theme_support( 'jetpack-testimonial' );

	// This theme supports Workshops
	add_theme_support( 'workshop' );

	// This theme supports Workshops
	add_theme_support( 'gastartikel' );

	// This theme supports Advertenties
	add_theme_support( 'advertentie' );

}
add_action( 'after_setup_theme', 'mvdk_jetpack_setup' );
