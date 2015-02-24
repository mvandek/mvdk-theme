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
$wp_customize->add_section( 'mvdk_social_section' , array(
'title'				=> __( 'Social Media', 'mvdk' ),
'priority'			=> 110,
'description'			=> __( 'Voeg Social Media knoppen toe in de header van de website', 'mvdk' ),
) );

$wp_customize->add_setting( 'mvdk_facebook', array(
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
) );

$wp_customize->add_control( 'mvdk_facebook', array(
'label'				=> __( 'URL van Facebook pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_facebook',
'priority'			=> 111,
) );

$wp_customize->add_setting( 'mvdk_twitter', array(
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
) );

$wp_customize->add_control( 'mvdk_twitter', array(
'label'				=> __( 'URL van Twitter pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_twitter',
'priority'			=> 112,
) );

$wp_customize->add_setting( 'mvdk_500px', array(
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
) );

$wp_customize->add_control( 'mvdk_500px', array(
'label'				=> __( 'URL van 500px.com pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_500px',
'priority'			=> 113,
) );

$wp_customize->add_setting( 'mvdk_linkedin', array(
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_url',
) );

$wp_customize->add_control( 'mvdk_linkedin', array(
'label'				=> __( 'URL van Linkedin pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_linkedin',
'priority'			=> 114,
) );

$wp_customize->add_setting( 'mvdk_flickr', array(
'capability'			=> 'edit_theme_options',
'sanitize_callback'		=> 'mvdk_sanitize_url',
'default'			=> '',
) );

$wp_customize->add_control( 'mvdk_flickr', array(
'label'				=> __( 'URL van Flickr pagina', 'mvdk' ),
'section'			=> 'mvdk_social_section',
'settings'			=> 'mvdk_flickr',
'priority'			=> 115,
) );

$wp_customize->add_section( 'mvdk_theme_options', array(
'title'				=> __( 'Custom Post Type pagina opties', 'mvdk' ),
'priority'			=> 120,
) );

$wp_customize->add_setting( 'mvdk_hide_advertentie_page_content', array(
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_advertentie_page_content', array(
'label'				=> __( 'Verberg titel en inhoud op Advertentie Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_gastartikel_page_content', array(
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_gastartikel_page_content', array(
'label'				=> __( 'Verberg titel en inhoud op Gastartikel Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_portfolio_page_content', array(
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_portfolio_page_content', array(
'label'				=> __( 'Verberg titel en inhoud op Portfolio Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
) );

$wp_customize->add_setting( 'mvdk_hide_workshop_page_content', array(
'capability'			=> 'edit_theme_options',
'default'			=> '',
'sanitize_callback'		=> 'mvdk_sanitize_checkbox',
) );

$wp_customize->add_control( 'mvdk_hide_workshop_page_content', array(
'label'				=> __( 'Verberg titel en inhoud op Workshop Page Template', 'mvdk' ),
'section'			=> 'mvdk_theme_options',
'type'				=> 'checkbox',
) );

//Add Footer Section
$wp_customize->add_section( 'mvdk_footer_settings', array(
'title'				=> __('Instellingen footer website','mvdk'),
'priority'			=> 130,
) );
	
// Add Piwik Site ID
$wp_customize->add_setting( 'mvdk_piwik_site_id', array(
'capability'			=> 'edit_theme_options',
'default'			=> '1',
'sanitize_callback'		=> 'esc_html',
) );

$wp_customize->add_control( 'mvdk_piwik_site_id', array(
'label'				=> __('Piwik Site ID','mvdk'),
'section'			=> 'mvdk_footer_settings',
'type'				=> 'number',
'transport'			=> 'refresh',
) );

// Customize Footer Text
$wp_customize->add_setting( 'mvdk_custom_footer_text', array(
'capability'			=> 'edit_theme_options',
'default'			=> 'Tekst en fotografie - tenzij anders aangegeven - Maarten van de Kamp',
'sanitize_callback'		=> 'mvdk_sanitize_text',
) );

$wp_customize->add_control( 'mvdk_custom_footer_text', array(
'label'				=> __('Footer tekst','mvdk'),
'section'			=> 'mvdk_footer_settings',
'type'				=> 'text',
'transport'			=> 'refresh',
) );

}
add_action('customize_register', 'mvdk_theme_customizer');
/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean true if portfolio page template displays title and content.
 */
function mvdk_sanitize_checkbox( $input ) {
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
return esc_html( $input );
}