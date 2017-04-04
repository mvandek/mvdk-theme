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
<div class="nav-next"><?php next_posts_link( __( 'Volgende pagina', 'mvdk' ) ); ?></div>
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
<?php esc_html_e( 'Pingback: ', 'mvdk' ); comment_author_link(); edit_comment_link( __( 'Bewerken', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</div>
</li>

<?php else : ?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

<article id="comment-<?php comment_ID(); ?>" class="comment" itemprop="comment" itemscope itemtype="http://schema.org/Comment">

<header class="comment-meta">
<div class="comment-author comment-metadata vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

<?php
$comment_author = get_comment_author_link();
if ( ! empty( $comment_author ) ) {
printf( '<div class="fn" itemprop="name">%1$s</div>', wp_kses_post( $comment_author ) );
} else {
$comment_author = 'Anoniem';
printf( '<div class="fn" itemprop="name">%1$s</div>', wp_kses_post( $comment_author ) );
}
?>

<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<time datetime="<?php comment_date( DATE_W3C ); ?>"><?php printf( __( '%1$s om %2$s', 'mvdk' ), get_comment_date(), get_comment_time() ); ?></time>
</a>

</div>
</header>

<div class="comment-content" itemprop="text">
<?php comment_text(); ?>
</div>

<?php if ( $comment->comment_approved === '0' ) { ?>
<div class="comment-awaiting-moderation"><?php esc_html_e( 'Je reactie wordt beoordeeld voor plaatsing.', 'mvdk' ); ?></div>
<?php } ?>

<?php edit_comment_link( __( 'Bewerken', 'mvdk' ), '<div class="edit-link">', '</div>' ); ?>

<footer class="reply">
<?php comment_reply_link( array_merge( $args, [ 'depth' => $depth ] ) ); ?>
</footer>

</article>
<?php
endif;
}
/*
 * Change the comment reply link to use 'Reply to [Author First Name]'
 */
function mvdk_author_comment_reply_link( $args, $comment ) {
$comment = get_comment( $comment_ID );

// If no comment author is blank, use 'Anoniem'
if ( $comment->comment_author ) {
	$author = $comment->comment_author;
} else {
	$author = 'Anoniem';
}
// Replace Reply Text with "Reply to <Author Name>"
$args['reply_text'] = __( 'Reageer op', 'independent-publisher' ) . ' ' . esc_html( $author );
return $args;
}
add_filter( 'comment_reply_link_args', 'mvdk_author_comment_reply_link', 10, 3 );

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
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	printf( '<span class="posted-on">%1$s %2$s</span>',
		esc_html_x( 'Geschreven op', 'Wordt voor publicatiedatum geplaatst.', 'mvdk' ),
		$time_string
	);

printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span><a class="url fn n" href="%2$s" itemscope itemtype="https://schema.org/Person" itemprop="author"><span itemprop="name">%3$s</span></a></span></span>',
	_x( 'Geschreven door', 'Wordt voor weergave schrijver geplaatst.', 'mvdk' ),
	esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	esc_html( get_the_author() )
	);

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

if ( ! post_password_required() && ( comments_open() || get_comments_number() ) && post_type_supports( get_post_type(), 'comments' ) ) {
	echo '<span class="comments-link">';
	comments_popup_link( esc_html__( '0', 'mvdk' ), esc_html__( '1 reactie', 'mvdk' ), esc_html__( '% reacties', 'mvdk' ) );
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

/**
* Display author box
*
* @since Esplanade 1.0
*/
function mvdk_post_author() { ?>
<div class="entry-author" itemscope itemtype="http://schema.org/Person">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mvdk_author_bio_avatar_size', 96 ) ); ?>
<section class="author-info">
<h3 class="author vcard"><span class="fn" itemprop="name"><?php the_author(); ?></span></h3>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<p class="author-bio" itemprop="description"><?php the_author_meta( 'description' ); ?></p>
<?php endif; ?>
</section>
</div>
<?php
}