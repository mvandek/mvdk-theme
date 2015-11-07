<?php
/**
 * mvdk-theme Customizer functionality
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

/*******************************************************************
* These are settings for the Theme Customizer in the admin panel.
*******************************************************************/
function mvdk_theme_customizer( $wp_customize ) {

/* social media option */
$wp_customize->add_section( 'mvdk_social_section' , [
'title'				=> esc_html__( 'Social Media', 'mvdk' ),
'priority'			=> 110,
'description'			=> esc_html__( 'Voeg Social Media knoppen toe in de header van de website', 'mvdk' ),
] );

$wp_customize->add_setting( 'mvdk_facebook', [
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
] );

$wp_customize->add_control( 'mvdk_facebook', [
'label'				=> esc_html__( 'URL van Facebook pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_facebook',
'priority'			=> 111,
] );

$wp_customize->add_setting( 'mvdk_twitter', [
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
] );

$wp_customize->add_control( 'mvdk_twitter', [
'label'				=> esc_html__( 'URL van Twitter pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_twitter',
'priority'			=> 112,
] );

$wp_customize->add_setting( 'mvdk_500px', [
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
] );

$wp_customize->add_control( 'mvdk_500px', [
'label'				=> esc_html__( 'URL van 500px.com pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_500px',
'priority'			=> 113,
] );

$wp_customize->add_setting( 'mvdk_linkedin', [
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
] );

$wp_customize->add_control( 'mvdk_linkedin', [
'label'				=> esc_html__( 'URL van Linkedin pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_linkedin',
'priority'			=> 114,
] );

$wp_customize->add_setting( 'mvdk_flickr', [
'capability'			=> 'edit_theme_options',
'sanitize_callback'		=> 'mvdk_sanitize_url',
'default'			=> '',
] );

$wp_customize->add_control( 'mvdk_flickr', [
'label'				=> esc_html__( 'URL van Flickr pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_flickr',
'priority'			=> 115,
] );

$wp_customize->add_section( 'mvdk_theme_options', [
'title'				=> esc_html__( 'Custom Post Type pagina opties', 'mvdk' ),
'priority'			=> 120,
] );

$wp_customize->add_setting( 'mvdk_hide_advertentie_page_content', [
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
] );

$wp_customize->add_control( 'mvdk_hide_advertentie_page_content', [
'label'				=> esc_html__( 'Verberg titel en inhoud op Advertentie Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
] );

$wp_customize->add_setting( 'mvdk_hide_gastartikel_page_content', [
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
] );

$wp_customize->add_control( 'mvdk_hide_gastartikel_page_content', [
'label'				=> esc_html__( 'Verberg titel en inhoud op Gastartikel Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
] );

$wp_customize->add_setting( 'mvdk_hide_portfolio_page_content', [
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
] );

$wp_customize->add_control( 'mvdk_hide_portfolio_page_content', [
'label'				=> esc_html__( 'Verberg titel en inhoud op Portfolio Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
] );

$wp_customize->add_setting( 'mvdk_hide_workshop_page_content', [
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
] );

$wp_customize->add_control( 'mvdk_hide_workshop_page_content', [
'label'				=> esc_html__( 'Verberg titel en inhoud op Workshop Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
] );

//Add Footer Section
$wp_customize->add_section( 'mvdk_footer_settings', [
'title'				=> esc_html__('Instellingen footer website','mvdk'),
'priority'			=> 130,
] );
	
// Customize Footer Text
$wp_customize->add_setting( 'mvdk_custom_footer_text', [
'capability'			=> 'edit_theme_options',
'default'			=> esc_html( 'Tekst en fotografie - tenzij anders aangegeven - Maarten van de Kamp' ),
'sanitize_callback'		=> 'mvdk_sanitize_text',
] );

$wp_customize->add_control( 'mvdk_custom_footer_text', [
'label'				=> esc_html__('Footer tekst','mvdk'),
'section'			=> 'mvdk_footer_settings',
'type'				=> 'text',
'transport'			=> 'refresh',
] );

}
add_action('customize_register', 'mvdk_theme_customizer');
/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean true if portfolio page template displays title and content.
 */
function mvdk_sanitize_checkbox( $input ) {
if ( 1 === $input ) {
return true;
} else {
return false;
}
}

function mvdk_sanitize_url( $input ) {
return esc_url( $input );
}

function mvdk_sanitize_text( $input ) {
return esc_html( $input );
}
