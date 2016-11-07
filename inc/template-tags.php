<?php
/**
 * Custom template tags for mvdk-theme
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

/**
* Displays navigation to next/previous set of posts when applicable.
*
*
* @return void
*/
function mvdk_paging_nav() {
// Don't print empty markup if there's only one page.
if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
return;
}
?>
<nav class="navigation pagination">
<h2 class="screen-reader-text"><?php _e( 'Navigatie voor pagina\'s', 'mvdk' ); ?></h2>
<div class="nav-links">
<?php if ( get_previous_posts_link() ) { ?>
<div class="nav-previous"><?php previous_posts_link( __( 'Terug', 'mvdk' ) ); ?></div>
<?php } ?>
<?php if ( get_next_posts_link() ) { ?>
<div class="nav-next"><?php next_posts_link( __( 'Meer', 'mvdk' ) ); ?></div>
<?php } ?>
</div>
</nav>
<?php
}
/**
* Displays navigation to next/previous post when applicable.
*
*
* @return void
*/
/**
* Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own twentytwelve_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since Twenty Twelve 1.0
*/
function mvdk_comment( $comment, $args, $depth ) {
$GLOBALS['comment'] = $comment;

if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) : ?>

<li class="post pingback">
<div class="comment-body">
<?php _e( 'Pingback: ', 'mvdk' ); comment_author_link(); edit_comment_link( __( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</div>

<?php else : ?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>

<article id="div-comment-<?php comment_ID(); ?>" class="comment-body" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/Comment">

<header class="comment-meta">
<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>

<div class="comment-author comment-metadata vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
<?php printf( '<div class="fn" itemprop="name">%1$s</div>', get_comment_author_link() ); ?>

<a href="<?= esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<time datetime="<?= get_comment_date('c'); ?>">
<?php printf( __( '%1$s om %2$s', 'mvdk' ), get_comment_date(), get_comment_time() ); ?>
</time>
</a>

<?php if ( $comment->comment_approved === '0' ) { ?>
<p class="comment-awaiting-moderation"><?php _e( 'Je reactie wordt beoordeeld voor plaatsing.', 'mvdk' ); ?></p>
<?php } ?>

</div>
</header>

<div class="comment-content" itemprop="text">
<?php comment_text(); ?>
</div>

<?php edit_comment_link( __( 'Bewerken', 'mvdk' ), '<p class="edit-link">', '</p>' ); ?>

<footer class="reply">
<?php comment_reply_link( array_merge( $args, [ 'reply_text' => __( 'Reageer', 'mvdk' ),  'depth' => $depth ] ) ); ?>
</footer>

</article>
<?php
endif;
}
/*
 * Change the comment reply link to use 'Reply to [Author First Name]'
 */
function mvdk_author_comment_reply_link( $link, $args, $comment ) {
$comment = get_comment( $comment );

// If no comment author is blank, use 'Anoniem'
if ( ! empty( $comment->comment_author ) ) {
	$author = $comment->comment_author;
} else {
	if ( ! empty( $comment->user_id ) ) {
		$user   = get_userdata( $comment->user_id );
		$author = $user->user_login;
	} else {
		$author = __( 'Anoniem', 'independent-publisher' );
	}
}

// If the user provided more than a first name, use only first name
//	if ( strpos( $author, ' ' ) ) {
//		$author = substr( $author, 0, strpos( $author, ' ' ) );
//	}

// Replace Reply Link with "Reageer op <Author First Name>"
$reply_link_text = $args['reply_text'];
$link            = str_replace( $reply_link_text, esc_html__( 'Reageer op', 'mvdk' ) . ' ' . $author, $link );
return $link;
}
add_filter( 'comment_reply_link', 'mvdk_author_comment_reply_link', 420, 4 );

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 13-7-2013
 *
 * @return string The Link format URL.
 */
function mvdk_get_first_url() {
$has_url = get_url_in_content( get_the_content() );
return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

function mvdk_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( '<span class="posted-on">%1$s %2$s</span>',
		esc_html_x( 'Geschreven op', 'Wordt voor publicatiedatum geplaatst.', 'mvdk' ),
		$time_string
	);

printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span> <a class="url fn n" href="%2$s" itemscope="itemscope" itemtype="https://schema.org/Person" itemprop="author"><span itemprop="name">%3$s</span></a></span></span>',
	_x( 'Geschreven door', 'Wordt voor weergave schrijver geplaatst.', 'mvdk' ),
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_html( get_the_author() )
	);

//if( is_singular() ) {
//if ( 'post' === get_post_type() ) {
//	$categories_list = get_the_term_list( get_the_ID(), 'category', '', ', ' );
//} elseif ( 'portfolio' === get_post_type() ) {
//	$categories_list = get_the_term_list( get_the_ID(), 'portfolio-type' );
//} elseif ( in_array( get_post_type(), [ 'basiskennis', 'fotobewerking', 'praktijk', ] ) ) {
//	$categories_list = get_the_term_list( get_the_ID(), ['onderwerp', 'software',] ,'', ', ' );
//} elseif ( 'gastartikel' === get_post_type() ) {
//	$categories_list = get_the_term_list( get_the_ID(), 'gastartikel-type' );
//} elseif ( 'advertentie' === get_post_type() ) {
//	$categories_list = get_the_term_list( get_the_ID(), 'adverteerder' );
//}

// if ( $categories_list && mvdk_categorized_blog() ) {
//if ( $categories_list ) {
//	printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span><span itemprop="articleSection">%2$s</span></span>',
//		_x( 'Categorie', 'Wordt voor weergave categorie geplaatst.', 'mvdk' ),
//		$categories_list
//	);
//}
//} // Einde if( is_singular() )

if ( is_attachment() && wp_attachment_is_image() ) {
	// Retrieve attachment metadata.
	$metadata = wp_get_attachment_metadata();

	printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
		_x( 'Volledige grootte', 'Wordt gebruikt voor grote weergave bijlage.', 'mvdk' ),
		esc_url( wp_get_attachment_url() ),
		$metadata['width'],
		$metadata['height']
	);
}

if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
	echo '<span class="comments-link" itemprop="commentCount">';
	comments_popup_link( esc_html__( '0', 'mvdk' ), esc_html__( '1', 'mvdk' ), esc_html__( '%', 'mvdk' ) );
	echo '</span>';
}
}

/**
 * Returns true if a blog has more than 1 category
 *
 * @since 3-3-2013
 */
function mvdk_categorized_blog() {
if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
// Create an array of all the categories that are attached to posts.
$all_the_cool_cats = get_categories( [
'fields'     => 'ids',
'hide_empty' => 1,
// We only need to know if there is more than one category.
'number'     => 2,
] );
// Count the number of categories that are attached to the posts
$all_the_cool_cats = count( $all_the_cool_cats );
set_transient( 'all_the_cool_cats', $all_the_cool_cats );
}
return ( $all_the_cool_cats > 1 );
}
/**
 * Flush out the transients used in mvdk_categorized_blog
 *
 * @since 3-3-2013
 */
function mvdk_category_transient_flusher() {
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
return;
}
delete_transient( 'all_the_cool_cats' );
}
add_action( 'delete_category', 'mvdk_category_transient_flusher' );
add_action( 'save_post', 'mvdk_category_transient_flusher' );
add_action( 'delete_post', 'all_posts_archive_page_transient_flusher' );
/**
 * Retrieve all posts from database and store them for 24h in a transient for the archive page
 *
 * @since 9-3-2013
 */
function all_posts_archive_page() {
$all_posts_archive_page_transient = get_transient( 'all_posts_for_archive' );
if( ! empty( $all_posts_archive_page_transient) ) {
// The function will return here every time after the first time it is run, until the transient expires.
return $all_posts_archive_page_transient;
// Nope!  We gotta make a call.
} else {
$query = [
'post_type'		=> [ 'post', 'basiskennis', 'fotobewerking', 'praktijk', 'portfolio', 'gastartikel', 'advertentie' ],
'nopaging'		=> true,
'ignore_sticky_posts'	=> true,
'no_found_rows'		=> true,
'cache_results'		=> false,
];
$all_posts_for_archive = new WP_Query($query);
// transient set to last forever until another post is saved - all_posts_archive_page_transient_flusher takes care of the flush
set_transient( 'all_posts_for_archive', $all_posts_for_archive );
}
// do normal loop stuff
return $all_posts_for_archive;
}
/**
 * Flush out the transients used in mvdk_categorized_blog when a post is saved
 *
 * @since 11-3-2013
 */
function all_posts_archive_page_transient_flusher() {
delete_transient( 'all_posts_for_archive' );
}
add_action( 'save_post', 'all_posts_archive_page_transient_flusher' );
add_action( 'delete_post', 'all_posts_archive_page_transient_flusher' );
/**
* Display author box
*
* @since Esplanade 1.0
*/
function mvdk_post_author() { ?>
<section class="entry-author" itemscope="itemscope" itemtype="http://schema.org/Person">
<?= get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mvdk_author_bio_avatar_size', 96 ) ); ?>
<div class="author-info">
<h3 class="author vcard"><span class="fn" itemprop="name"><?php the_author(); ?></span></h3>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<p class="author-bio" itemprop="description"><?php the_author_meta( 'description' ); ?></p>
<?php endif; ?>
<div class="author-meta">
<?php 
// Change language depending on number of posts
//$posts_posted = get_the_author_posts();
//if ( $posts_posted == 1) { printf(__( 'Eén artikel tot nu toe. ', 'mvdk' ) ); }
//else { printf(__( '%s artikelen tot nu toe. ', 'mvdk' ), the_author_posts() ); }
// Laat sociale media en andere links zien
//printf( '<span class="external-link"><a class="url" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
//esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
//esc_attr( sprintf( __( 'Bekijk het archief van %s', 'mvdk' ), get_the_author() ) ),
//__( 'Mijn archief', 'mvdk' )
//);
?>
</div>
</div>
</section>
<?php
}

function basiskennis_posts_for_front_page() {
$basiskennis_posts_for_front_page_transient = get_transient( 'basiskennis_posts_for_front_page' );
if( ! empty( $basiskennis_posts_for_front_page_transient) ) {
// The function will return here every time after the first time it is run, until the transient expires.
return $basiskennis_posts_for_front_page_transient;
// Nope!  We gotta make a call.
} else {
$query = [
'post_type'             => 'basiskennis',
'ignore_sticky_posts'   => true,
'posts_per_page'        => 8,
'no_found_rows'         => true,
'cache_results'         => false,
];
$retrieve_8_basiskennis_posts = new WP_Query($query);
// transient set to last forever until another post is saved - all_posts_archive_page_transient_flusher takes care of the flush
set_transient( 'basiskennis_posts_for_front_page', $retrieve_8_basiskennis_posts );
}
// do normal loop stuff
return $retrieve_8_basiskennis_posts;
}

function praktijk_posts_for_front_page() {
$praktijk_posts_for_front_page_transient = get_transient( 'praktijk_posts_for_front_page' );
if( ! empty( $praktijk_posts_for_front_page_transient) ) {
// The function will return here every time after the first time it is run, until the transient expires.
return $praktijk_posts_for_front_page_transient;
// Nope!  We gotta make a call.
} else {
$query = [
'post_type'             => 'praktijk',
'ignore_sticky_posts'   => true,
'posts_per_page'        => 8,
'no_found_rows'         => true,
'cache_results'         => false,
];
$retrieve_8_praktijk_posts = new WP_Query($query);
// transient set to last forever until another post is saved - all_posts_archive_page_transient_flusher takes care of the flush
set_transient( 'praktijk_posts_for_front_page', $retrieve_8_praktijk_posts );
}
// do normal loop stuff
return $retrieve_8_praktijk_posts;
}

function fotobewerking_posts_for_front_page() {
$fotobewerking_posts_for_front_page_transient = get_transient( 'fotobewerking_posts_for_front_page' );
if( ! empty( $fotobewerking_posts_for_front_page_transient) ) {
// The function will return here every time after the first time it is run, until the transient expires.
return $fotobewerking_posts_for_front_page_transient;
// Nope!  We gotta make a call.
} else {
$query = [
'post_type'             => 'fotobewerking',
'ignore_sticky_posts'   => true,
'posts_per_page'        => 8,
'no_found_rows'         => true,
'cache_results'         => false,
];
$retrieve_8_fotobewerking_posts = new WP_Query($query);
// transient set to last forever until another post is saved - all_posts_archive_page_transient_flusher takes care of the flush
set_transient( 'fotobewerking_posts_for_front_page', $retrieve_8_fotobewerking_posts );
}
// do normal loop stuff
return $retrieve_8_fotobewerking_posts;
}

function blog_posts_for_front_page() {
$blog_posts_for_front_page_transient = get_transient( 'blog_posts_for_front_page' );
if( ! empty( $blog_posts_for_front_page_transient) ) {
// The function will return here every time after the first time it is run, until the transient expires.
return $blog_posts_for_front_page_transient;
// Nope!  We gotta make a call.
} else {
$query = [
'post_type'             => 'post',
'ignore_sticky_posts'   => true,
'posts_per_page'        => 8,
'no_found_rows'         => true,
'cache_results'         => false,
];
$retrieve_8_blog_posts = new WP_Query($query);
// transient set to last forever until another post is saved - all_posts_archive_page_transient_flusher takes care of the flush
set_transient( 'blog_posts_for_front_page', $retrieve_8_blog_posts );
}
// do normal loop stuff
return $retrieve_8_blog_posts;
}