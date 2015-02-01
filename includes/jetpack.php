<?php
function maartenvandekamp_jetpack_setup() {

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
add_action( 'after_setup_theme', 'maartenvandekamp_jetpack_setup' );
