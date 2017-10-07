<?php
/**
 * The functions on this page add extra functionality to the theme.
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

// First, make sure Jetpack doesn't concatenate all its CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

function mvdk_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter( 'wp_page_menu_args', 'mvdk_page_menu_args' );

/**
* Stop loading the JavaScript and CSS stylesheet on all pages for Contact Form 7
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Remove Color scheme picker from Profiles page
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/**
* Output the breadcrumb trail
*
* @since Esplanade 1.0
*/
function mvdk_breadcrumbs($defaults) {
$defaults['show_on_front'] = false; // whether to show the breadcrumb on the front page
$defaults['show_browse'] = false; // whether to show the "browse" text
// $defaults['separator'] = '&raquo;'; // separator between items
// $defaults['post_taxonomy']['post'] = 'category';
$defaults['labels']['error_404'] = esc_html( '404 Niet gevonden' );
$defaults['labels']['archives'] = esc_html( 'Archief' );
$defaults['labels']['search'] = esc_html( 'Zoekresultaat voor %s' );
$defaults['labels']['paged'] = esc_html( 'Pagina %s' );
return $defaults;
}
add_filter( 'breadcrumb_trail_args', 'mvdk_breadcrumbs' );

/**
 * Andere functie
 */
function mvdk_rel_attachment( $link ) {
  return str_replace( "<a ", "<a rel='attachment' ", $link );
}
add_filter( 'wp_get_attachment_link', 'mvdk_rel_attachment' );

/**
*
* Removes the ?ver= which prevent caching
*
**/
function remove_cssjs_ver( $src ) {
return esc_url( remove_query_arg( 'ver', $src ) );
}
add_filter( 'style_loader_src', 'remove_cssjs_ver' );
add_filter( 'script_loader_src', 'remove_cssjs_ver' );
/**
* Redirect to the post if the search result matches directly
*
* @since 2013
*/
function redirect_single_post() {
if (is_search()) {
global $wp_query;
if ($wp_query->post_count === 1) {
wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
}
}
}
add_action('template_redirect', 'redirect_single_post');

/**
* Filters the author and email field to add a custom "required" message.
*
* @param array $fields
* @return array
*/
function mvdk_comment_fields( $fields ) {
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$html_req = ( $req ? " required='required'" : '' );

$fields   =  array(
	'author' => '<div class="comment-form-author">' . '<label for="author">' . __( 'Naam' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',

	'email' => '<div class="comment-form-email"><label for="email">' . __( 'Emailadres' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',

	'url' => '<div class="comment-form-url"><label for="url">' . __( 'Website (<em>optioneel</em>)' ) . '</label> ' . '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
);

return $fields;

}
add_filter( 'comment_form_default_fields', 'mvdk_comment_fields' );
/**
* Change the number of words shown in excerps
*
* @since Esplanade 1.0
*/
function mvdk_excerpt_length( $length ) {
return 36;
}
add_filter( 'excerpt_length', 'mvdk_excerpt_length' );
/**
* Changes the default excerpt trailing content
*
* Replaces the default [...] trailing text from excerpts
* to a »
*
* @since 25-10-2014
*/
function mvdk_excerpt_more() {
return sprintf( ' &mdash; <a href="%1$s">%2$s</a>',
esc_url( get_permalink( get_the_ID() ) ),
sprintf( esc_html_x( 'Lees het hele artikel %s', 'mvdk' ), '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span> <span class="meta-nav">&raquo;</span>' ) 
);
}
add_filter( 'excerpt_more', 'mvdk_excerpt_more' );
/**
 * Removes some widgets from the Dashboard
 *
 * @Since 5-5-2013
 */
function mvdk_remove_dashboard_widgets(){
global$wp_meta_boxes;
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
}
add_action( 'wp_dashboard_setup', 'mvdk_remove_dashboard_widgets', 11 );

// Change the failed login message for extra WordPress Security
function failed_login() {
return esc_html__( 'Oeps, je hebt een verkeerde gebruikersnaam of wachtwoord ingevoerd.', 'mvdk' );
}
add_filter('login_errors', 'failed_login');
/**
 * Removes category from the rel= tag for W3C validity check
 *
 * @Since 1-8-2013
 */
function mvdk_w3c_valid_rel( $text ) {
$text = str_replace('rel="category tag"', 'rel="tag"', $text);
return $text; 
}
add_filter( 'the_category', 'mvdk_w3c_valid_rel' );
/**
 * Remove the WordPress version from RSS feeds
 */
add_filter('the_generator', '__return_false');
/**
 * Remove unnecessary self-closing tags
 */
function roots_remove_self_closing_tags($input) {
return str_replace(' />', '>', $input);
}
add_filter('get_avatar',          'roots_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'roots_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'roots_remove_self_closing_tags'); // <img />

function login_failed_403() {
status_header( 403 );
}
add_action( 'wp_login_failed', 'login_failed_403' );
/**
 * Sets default comment and ping status
 * to off for "Page" post types
 *
 */
function poststatus_change_comment_status() {
add_filter( 'option_default_comment_status', '__return_false' );
add_filter( 'option_default_ping_status', '__return_false' );
}
add_action( 'load-page-new.php', 'poststatus_change_comment_status' );
/**
* Add Twitter and Facebook to Profile Fields and remove Yahoo! IM, AIM and Jabber
*
* @since Esplanade 1.0
*/
function add_social_media_to_profile_contact_information( $fields) {
// Add Twitter
$fields['twitter'] = esc_html__( 'Twitter', 'mvdk' );
$fields['facebook'] = esc_html__( 'Facebook', 'mvdk' );
$fields['linkedin'] = esc_html__( 'LinkedIn', 'mvdk' );
// Remove Yahoo IM
unset($fields['yim']);
unset($fields['aim']);
unset($fields['jabber']);
return $fields;
}
add_filter( 'user_contactmethods' , 'add_social_media_to_profile_contact_information' );

/**
* Instead of an extra file that has to be loaded, whilst very small, is still one download to much.
* This filter replaces the extra file with an base64 encoded 1x1 gif file.
*
*/
//add_filter( 'lazyload_images_placeholder_image', function( $placeholder_image ) {
//return 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';
//});

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mvdk_pingback_header() {
if ( is_singular() && pings_open() ) {
	echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mvdk_pingback_header' );

function cr2_raw_allowed_upload_mime( $existing_mimes ) {
	// add cr2 to the list of mime types
	$existing_mimes['cr2'] = 'image/x-canon-cr2';
	// return the array back to the function with our added mime type
	return $existing_mimes;
}
add_filter( 'mime_types', 'cr2_raw_allowed_upload_mime' );

/**
 * Adds custom classes to the array of body classes.
 */
function mvdk_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( ! is_singular()
	|| is_page_template( 'page-uitgelicht.php')
	|| is_page_template( 'page-locatie.php')
 	|| is_page_template( 'page-onderwerp.php')
	|| is_page_template( 'templates/template-front-page.php')
	) {
		$classes[] = 'has-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'mvdk_body_classes' );

// Don't log IP addresses of comment authors.
add_filter( 'pre_comment_user_ip', '__return_empty_string' );

// Don't log User Agents of comment authors.
add_filter( 'pre_comment_user_agent', '__return_empty_string' );

/**
 * Add schema microdata to nav urls
 */
function mvdk_add_menu_atts( $atts, $item, $args ) {
    $atts['itemprop'] = 'url';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'mvdk_add_menu_atts', 10, 3 );

/**
 * Improve perfomance of the `_WP_Editors::wp_link_query` method
 *
 * The WordPress core is currently not setting `no_found_rows` inside the `_WP_Editors::wp_link_query`
 * See https://core.trac.wordpress.org/ticket/38784
 * 
 * Since the `_WP_Editors::wp_link_query` method is not using the `found_posts` nor `max_num_pages`
 * properties of `WP_Query` class, the `SQL_CALC_FOUND_ROWS` in produced SQL query is extra and
 * useless.
 *
 */
function wpcom_vip_wp_link_query_args( $query ) {
	//Since the WP_Query is not checking the $found_posts nor $max_num_pages properties
	//we don't need to know the total number of matching posts in the database
	$query['no_found_rows'] = true;
	return $query;
}
add_filter( 'wp_link_query_args', 'wpcom_vip_wp_link_query_args', 10, 1 );

/**
 * Fix a race condition in alloptions caching
 *
 * See https://core.trac.wordpress.org/ticket/31245
 */
function _wpcom_vip_maybe_clear_alloptions_cache( $option ) {
	if ( ! wp_installing() ) {
		$alloptions = wp_load_alloptions(); //alloptions should be cached at this point
		if ( isset( $alloptions[ $option ] ) ) { //only if option is among alloptions
			wp_cache_delete( 'alloptions', 'options' );
		}
	}
}
add_action( 'added_option',   '_wpcom_vip_maybe_clear_alloptions_cache' );
add_action( 'updated_option', '_wpcom_vip_maybe_clear_alloptions_cache' );
add_action( 'deleted_option', '_wpcom_vip_maybe_clear_alloptions_cache' );

add_filter( 'enable_post_by_email_configuration', '__return_false' );

// Cleaner permalink options
add_filter( 'got_url_rewrite', '__return_true' );

// Disable custom fields meta box dropdown (very slow)
add_filter( 'postmeta_form_keys', '__return_false' );

add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not authorized.', array( 'status' => 401 ) );
    }
    return $result;
});

function add_attribute_to_current_menu_item( $atts, $item, $args ) {
	if( in_array( 'current-menu-item', $item->classes ) ) {
		$atts['aria-current'] = 'page';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_attribute_to_current_menu_item', 10, 3 );

// Add style to embed links
add_action( 'embed_head', 'embed_top_style' );	
function embed_top_style(){ ?>
<style>
.wp-embed{color: initial}
.wp-embed .wp-embed-more{color:crimson}
</style>
<?php }