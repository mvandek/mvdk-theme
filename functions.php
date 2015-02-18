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
 * Set default content width based on the theme's layout. This affects the width of post images and embedded media.
 */
if ( ! isset( $content_width ) )
$content_width = 715;
/**
 * Set the content width based on the theme's design and stylesheet.
 */
function mvdk_content_width() {
if ( is_page_template( 'template-full-width.php' ) || is_page_template( 'template-archive.php' ) || is_page_template( 'template-contact-page.php' ) || is_page_template( 'template-links.php' ) )
$GLOBALS['content_width'] = 980;
}
add_action( 'template_redirect', 'mvdk_content_width' );
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
load_theme_textdomain( 'mvdk', get_template_directory() . '/languages' );
// Automatically add feed links to document head
add_theme_support( 'automatic-feed-links' );
// Switches default core markup for search form to output valid HTML5.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support( 'social-links', array( 'facebook', 'twitter', 'google_plus' ) );
// This theme uses its own gallery styles.
add_filter( 'use_default_gallery_style', '__return_false' );
// Register Primary Navigation Menu
register_nav_menus( array(
'primary_nav' => __( 'Primary Menu', 'mvdk' ),
'social' => __( 'Social Menu', 'mvdk' ),
) );
/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support( 'title-tag' );
// Add support for Post Formats
add_theme_support( 'post-formats', array( 'gallery', 'image', 'link', 'aside' ) );
// Add support for post thumbnails and custom image sizes specific to theme locations
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 270, 200, true );
// Add support for custom image sizes specific to theme locations
add_image_size( 'attachment-thumb', 700, 9999 ); // no crop flag, unlimited height
// Styles the post editor
add_editor_style( array( 'css/editor-style.css', 'css/font-style.css', 'genericons/genericons.css' ) );

/**
 * Set max width of full screen visual editor to match content width
 */
set_user_setting( 'dfw_width', 715 );
}
add_action( 'after_setup_theme', 'mvdk_theme_setup' );
/**
* Enqueue theme scripts
*
* @uses wp_enqueue_scripts() To enqueue scripts
*/
function mvdk_enqueue_scripts() {
// Disables l10n.js
wp_deregister_script('l10n');
// Add Open Sans fonts, used in the main stylesheet.
wp_enqueue_style( 'fonts-mvdk-v2-style', get_stylesheet_directory_uri() . '/css/font-style.css', array() );
// Add Genericons, check first for Jetpack Genericons, then the one delivered with this theme.
if ( wp_style_is( 'genericons', 'registered' ) ) {
wp_enqueue_style( 'genericons' );
} else {
wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3' );
}
// Load main stylesheet
wp_enqueue_style( 'site-mvdk-v2-style', get_stylesheet_uri() );
// Enable jQuery.
wp_enqueue_script( 'jquery' );
// Loads JavaScript files
wp_enqueue_script( 'responsive-menu-script', get_template_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '20150101', true );
wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20150218', true );
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'mvdk_enqueue_scripts' );
/**
* Adds the jetpack-portfolio CPT to the loop, to display it between regular posts
*
* @since Esplanade 1.0
*/
function add_custom_post_type_to_loop( $query ) {
if ( ( is_home() || is_tag() || is_category() || is_author() || is_archive() && !is_post_type_archive( array ( 'advertentie', 'gastartikel', 'portfolio', 'workshop' ) ) ) && $query->is_main_query() || is_feed() ) {
$query->set( 'post_type', array( 'post', 'portfolio', 'gastartikel', 'advertentie', ) );
return $query;
}
}
add_action( 'pre_get_posts', 'add_custom_post_type_to_loop' );
/**
 * Outputs the html5.js script with IE conditionals
 *
 * @since MaartenvandeKamp 1.10 - 28-1-2013
 */
function mvdk_html5_shiv() { ?>
<!--[if lt IE 9]><script src="https://www.staticcdn.nl/html5.js" type="text/javascript"></script><![endif]-->
<?php } // endif;
add_action( 'wp_print_scripts', 'mvdk_html5_shiv' );
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @Borrowed from Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function mvdk_search_form_modify( $html ) {
return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'mvdk_search_form_modify' );
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';
/**
 * Load Widgets file.
 */
require get_template_directory() . '/includes/widgets.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';
/**
 * Load Piwik Tracking Code.
 */
require get_template_directory() . '/includes/piwik.php';