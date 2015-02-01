<?php
/*******************************************************************
* These are settings for the Theme Customizer in the admin panel.
*******************************************************************/
function esplanade_theme_customizer( $wp_customize ) {

/* social media option */
$wp_customize->add_section( 'esplanade_social_section' , array(
'title'       => __( 'Social Media', 'esplanade' ),
'priority'    => 110,
'description' => __( 'Voeg Social Media knoppen toe in de header van de website', 'esplanade' ),
) );

$wp_customize->add_setting( 'esplanade_facebook' );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'esplanade_facebook', array(
'label'    => __( 'URL van Facebook pagina', 'esplanade' ),
'section'  => 'esplanade_social_section',
'settings' => 'esplanade_facebook',
'sanitize_callback' => 'mvdk_sanitize_url',
'priority'    => 111,
) ) );

$wp_customize->add_setting( 'esplanade_twitter' );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'esplanade_twitter', array(
'label'    => __( 'URL van Twitter pagina', 'esplanade' ),
'section'  => 'esplanade_social_section',
'settings' => 'esplanade_twitter',
'sanitize_callback' => 'mvdk_sanitize_url',
'priority'    => 112,
) ) );

$wp_customize->add_setting( 'esplanade_500px' );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'esplanade_500px', array(
'label'    => __( 'URL van 500px.com pagina', 'esplanade' ),
'section'  => 'esplanade_social_section',
'settings' => 'esplanade_500px',
'sanitize_callback' => 'mvdk_sanitize_url',
'priority'    => 113,
) ) );

$wp_customize->add_setting( 'esplanade_linkedin' );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'esplanade_linkedin', array(
'label'    => __( 'URL van Linkedin pagina', 'esplanade' ),
'section'  => 'esplanade_social_section',
'settings' => 'esplanade_linkedin',
'sanitize_callback' => 'mvdk_sanitize_url',
'priority'    => 114,
) ) );

$wp_customize->add_setting( 'esplanade_flickr' );
$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'esplanade_flickr', array(
'label'    => __( 'URL van Flickr pagina', 'esplanade' ),
'section'  => 'esplanade_social_section',
'settings' => 'esplanade_flickr',
'sanitize_callback' => 'mvdk_sanitize_url',
'priority'    => 115,
) ) );

$wp_customize->add_section( 'esplanade_theme_options', array(
'title'             => __( 'Custom Post Type Page Options', 'esplanade' ),
'priority'          => 120,
) );

$wp_customize->add_setting( 'mvdk_hide_advertentie_page_content', array(
'default'           => '',
'sanitize_callback' => 'esplanade_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_advertentie_page_content', array(
'label'             => __( 'Hide title and content on Advertentie Page Template', 'esplanade' ),
'section'           => 'esplanade_theme_options',
'type'              => 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_gastartikel_page_content', array(
'default'           => '',
'sanitize_callback' => 'esplanade_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_gastartikel_page_content', array(
'label'             => __( 'Hide title and content on Gastartikel Page Template', 'esplanade' ),
'section'           => 'esplanade_theme_options',
'type'              => 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_portfolio_page_content', array(
'default'           => '',
'sanitize_callback' => 'esplanade_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_portfolio_page_content', array(
'label'             => __( 'Hide title and content on Portfolio Page Template', 'esplanade' ),
'section'           => 'esplanade_theme_options',
'type'              => 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_workshop_page_content', array(
'default'           => '',
'sanitize_callback' => 'esplanade_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_workshop_page_content', array(
'label'             => __( 'Hide title and content on Workshop Page Template', 'esplanade' ),
'section'           => 'esplanade_theme_options',
'type'              => 'checkbox',
) );

//Add Footer Section
$wp_customize->add_section( 'mvdk_footer_settings', array(
'title'          => __('Footer Settings','mvdk'),
'priority'       => 130,
) );
	
// Customize Footer Text
$wp_customize->add_setting( 'mvdk_custom_footer_text', array(
'default'        => ' ',
) );

$wp_customize->add_control( 'mvdk_custom_footer_text', array(
'label'   => __('Footer tekst','matt2015'),
'section' => 'mvdk_footer_settings',
'sanitize_callback' => 'mvdk_sanitize_text',
'type'    => 'text',
'transport' => 'refresh',
) );

}
add_action('customize_register', 'esplanade_theme_customizer');
/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean true if portfolio page template displays title and content.
 */
function esplanade_sanitize_checkbox( $input ) {
if ( 1 == $input ) {
return true;
} else {
return false;
}
}

function mvdk_sanitize_url( $input ) {
return esc_url( $input );
}

function mvdk_sanitize_text( $input ) {
return wp_kses_post( force_balance_tags( $input ) );
}