<?php
/**
 * The functions on this page add extra functionality to the theme.
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

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

/**
* Output the breadcrumb trail
*
* @since Esplanade 1.0
*/
function mvdk_breadcrumbs($defaults) {
$defaults['show_on_front'] = false; // whether to show the breadcrumb on the front page
$defaults['show_browse'] = false; // whether to show the "browse" text
$defaults['separator'] = '&#187;'; // separator between items
$defaults['post_taxonomy']['post'] = 'category';
$defaults['labels']['error_404'] = esc_html__( '404 Niet gevonden' );
$defaults['labels']['archives'] = esc_html__( 'Archief' );
$defaults['labels']['search'] = esc_html__( 'Zoek resultaat voor %s' );
$defaults['labels']['paged'] = esc_html__( 'Pagina %s' );
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
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
/**
* Redirect to the post if the search result matches directly
*
* @since 2013
*/
function redirect_single_post() {
if (is_search()) {
global $wp_query;
if ($wp_query->post_count == 1) {
wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
}
}
}
add_action('template_redirect', 'redirect_single_post');
/**
* Alters the From name header for email sent by WordPress
*
* @since februari 2013
*/
function new_mail_from_name( $from_name) {
$from_name = 'Maarten van de Kamp';
return $from_name;
}
add_filter( 'wp_mail_from_name', 'new_mail_from_name' );
/**
* Alters the From email header for email sent by WordPress
*
* @since februari 2013
*/
function new_mail_from( $from_email ) {
$from_email = 'postmaster@maartenvandekamp.nl';
return $from_email;
}
add_filter( 'wp_mail_from', 'new_mail_from' );
/**
* Filters the author and email field to add a custom "required" message.
*
* @param array $fields
* @return array
*/
function mvdk_comment_fields( $fields ) {
$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );
$html_req  = ( $req ? " required='required'" : '' );

$fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Je naam', 'mvdk' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input type="text" id="author" name="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req  . ' /></p>';

$fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Je emailadres', 'mvdk' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input type="email" id="email" name="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>';

$fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Jouw website (Heb je een website, dan kun je die vermelden.)', 'mvdk' ) . '</label>' . '<input type="url" id="url" name="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . $html_req  . ' /></p>';

return $fields;

}
add_filter( 'comment_form_default_fields', 'mvdk_comment_fields' );
/**
 * Filters the defaults from the comment field to a custom option
 *
 * @param array $defaults.
 * @return array $defaults
 */
function mvdk_comment_defaults( $defaults ) {
$defaults['comment_field'] = '<p class="comment-form-comment">
<label for="comment">' . esc_html__( 'Je reactie', 'mvdk' ) . '</label>
<textarea id="comment" name="comment" cols="45" rows="8"></textarea></p>';
$defaults['comment_notes_before'] = '<p class="comment-notes">' . esc_html__( 'Leuk dat je een reactie wilt plaatsen! Vul daarvoor de onderstaande velden in. De velden met <span class="required">*</span> zijn verplicht.<br />Heb je een algemene vraag over fotografie? Dan kun je die op <a href="https://www.maartenvandekamp.nl/stel-een-vraag/">deze pagina</a> plaatsen.', 'mvdk' ) . '</p>';
$defaults['comment_notes_after'] = esc_html__('Je reactie wordt eerst gelezen voordat deze geplaatst wordt. Het emailadres wordt <strong>niet</strong> openbaar gemaakt.');
$defaults['title_reply'] = esc_html__( 'Schrijf een reactie' );
$defaults['title_reply_to'] = esc_html__( 'Reageer op %s' );
$defaults['cancel_reply_link'] = esc_html__( 'Annuleer mijn reactie' );
$defaults['label_submit'] = esc_html__( 'Plaats mijn reactie' );
return $defaults;
}
add_filter( 'comment_form_defaults', 'mvdk_comment_defaults' );

/**
* Change the number of words shown in excerps
*
* @since Esplanade 1.0
*/
function mvdk_excerpt_length( $length ) {
if( has_post_format( 'aside' ) ) {
return 36;
} else
return 50;
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
function mvdk_excerpt_more( $more ) {
    return sprintf( ' &mdash; <a href="%1$s">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        sprintf( esc_html__( 'Lees verder %s', 'mvdk' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span> <span class="meta-nav">&raquo;</span>' ) 
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
$fields['googleplus'] = esc_html__( 'Google+', 'mvdk' );
// Remove Yahoo IM
unset($fields['yim']);
unset($fields['aim']);
unset($fields['jabber']);
return $fields;
}
add_filter( 'user_contactmethods' , 'add_social_media_to_profile_contact_information' );