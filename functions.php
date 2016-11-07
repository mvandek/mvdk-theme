<?php
/**
 * mvdk-theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

/**
* Set up theme specific settings
*
* @uses add_theme_support() To add support for post thumbnails and automatic feed links.
* @uses register_nav_menus() To add support for navigation menus.
* @uses add_editor_style() To style the visual editor.
* @uses load_theme_textdomain() For translation/localization support.
* @uses add_image_size() To set custom image sizes.
*
* @since Esplanade 1.0
*/
function mvdk_theme_setup() {
/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on mvdk, use a find and replace
 * to change 'mvdk' to the name of your theme in all the template files
 */
// load_theme_textdomain( 'mvdk', get_template_directory() . '/languages' );

// Automatically add feed links to document head
// add_theme_support( 'automatic-feed-links' );

// Switches default core markup for search form to output valid HTML5.
add_theme_support( 'html5', [
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
] );

add_theme_support( 'social-links', [
'facebook',
'twitter',
'google_plus',
'linkedin',
] );

// This theme uses its own gallery styles.
add_filter( 'use_default_gallery_style', '__return_false' );

// Register Primary Navigation Menu
register_nav_menus( [
'primary' => __( 'Standaard Menu', 'mvdk' ),
'social' => __( 'Sociaal Menu', 'mvdk' ),
'footer' => __( 'Footer Menu', 'mvdk' ),
] );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );

// Add support for Post Formats
add_theme_support( 'post-formats', [ 'gallery', 'image', 'link', 'aside' ] );

// Add support for post thumbnails and custom image sizes specific to theme locations
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 270, 200, true );

// Add support for custom image sizes specific to theme locations
add_image_size( 'attachment-thumb', 700, 9999 ); // no crop flag, unlimited height

// Styles the post editor
add_editor_style( [ 'css/editor-style.css', 'css/font-style.css', 'genericons/genericons.css' ] );

/**
 * Set max width of full screen visual editor to match content width
 */
set_user_setting( 'dfw_width', 790 );
}
add_action( 'after_setup_theme', 'mvdk_theme_setup' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
add_filter( 'after_setup_theme', function() {
//if ( is_page_template( 'template-full-width.php' ) || is_page_template( 'template-archive.php' ) || is_page_template( 'template-contact-//page.php' ) || is_page_template( 'template-links.php' ) ) {
//$GLOBALS['content_width'] = 1056;
//} else {
$GLOBALS['content_width'] = apply_filters( 'mvdk_content_width', 790 );
//}
} );
/**
* Enqueue theme scripts
*
* @uses wp_enqueue_scripts() To enqueue scripts
*/
add_filter( 'wp_enqueue_scripts', function() {

// Load main stylesheet
wp_enqueue_style( 'mvdk-v2-stylesheet', get_stylesheet_uri() );

if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'subscriptions' ) ) {
$jetpack_subscription_css = "#subscribe-email input {width: 100%;} .comment-subscription-form .subscribe-label {display: inline !important;}";
wp_add_inline_style( 'mvdk-v2-stylesheet', $jetpack_subscription_css );
}

// Add Open Sans fonts, used in the main stylesheet.
// wp_enqueue_style( 'fonts-mvdk-v2-style', get_template_directory_uri() . '/css/font-style.css' );

// Add Genericons, check first for Jetpack Genericons, then the one delivered with this theme.
wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', [], '3.3' );

// Remove jQuery scripts
// wp_deregister_script( 'jquery' );
// wp_deregister_script('jquery-migrate');
// Device Pixels support

// This improves the resolution of gravatars and wordpress.com uploads on hi-res and zoomed browsers. We only have gravatars so we should be ok without it.
wp_deregister_script('devicepx');
wp_dequeue_script('devicepx');

// Disables l10n.js
wp_deregister_script('l10n');

// Load the html5 shiv.
wp_enqueue_script( 'mvdk-html5', get_template_directory_uri() . '/js/html5.js', [], '3.7.3' );
wp_script_add_data( 'mvdk-html5', 'conditional', 'lt IE 9' );

// Loads JavaScript files
wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', ['jquery'], false, true );
wp_enqueue_script( 'navigation-script', get_template_directory_uri() . '/js/navigation.js', ['jquery'], false, true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
} );
/**
* Adds several Custom Post Types to the loop, to display it between regular posts
*
* @since Esplanade 1.0
*/
add_action('pre_get_posts', function($query) {
if ( ( is_archive() && ! is_post_type_archive() ) && $query->is_main_query() ) {
set_query_var( 'post_type', [
'post',
'basiskennis',
'fotobewerking',
'portfolio',
'praktijk',
'gastartikel',
] );
return $query;
}
} );
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @Borrowed from Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
add_filter('get_search_form', function($html) {
return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
} );
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Widgets file.
 */
require get_template_directory() . '/inc/widgets.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Load Dev Code.
 */
require get_template_directory() . '/inc/dev.php';

require get_template_directory() . '/inc/vip-caching.php';
