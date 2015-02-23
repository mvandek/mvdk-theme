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
<nav class="navigation pagination" role="navigation">
<h2 class="screen-reader-text"><?php _e( 'Pagina Navigatie', 'mvdk' ); ?></h2>
<div class="nav-links">
<?php if ( get_previous_posts_link() ) { ?>
<div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&laquo;</span> Terug', 'mvdk' ) ); ?></div>
<?php } ?>
<?php if ( get_next_posts_link() ) { ?>
<div class="nav-next"><?php next_posts_link( __( 'Meer <span class="meta-nav">&raquo;</span>', 'mvdk' ) ); ?></div>
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
function mvdk_post_nav() {
// Don't print empty markup if there's nowhere to navigate.
$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );
if ( ! $next && ! $previous ) {
return;
}
?>
<nav class="navigation post-navigation" role="navigation">
<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'mvdk' ); ?></h2>
<div class="nav-links">
<?php previous_post_link( '%link', _x( '<div class="nav-previous">&laquo; Vorig artikel</div>', 'Previous post link', 'mvdk' ) ); ?>
<?php next_post_link( '%link', _x( '<div class="nav-next">Volgend artikel &raquo;</div>', 'Next post link', 'mvdk' ) ); ?>
</div>
</nav>
<?php }

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

if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

<li class="post pingback">
<div class="comment-body">
<?php esc_html_e( 'Pingback: ', 'mvdk' ); comment_author_link(); edit_comment_link( __( ' ( Bewerk )', 'mvdk' ), '<span class="edit-link">', '</span>' ); ?>
</div>

<?php else : ?>

<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
<article id="div-comment-<?php comment_ID(); ?>" class="comment-body" itemprop="comment" itemscope="itemscope" itemtype="http://schema.org/UserComments">
<footer class="comment-meta">
<div class="comment-author vcard" itemprop="creator" itemscope="itemscope" itemtype="http://schema.org/Person">
<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); }
printf( '<div class="fn" itemprop="name">%1$s</div>', get_comment_author_link() ); ?>
<span class="says"><?php _e( 'schrijft:', 'mvdk' ); ?></span>
</div>

<div class="comment-metadata">
<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" itemprop="replyToUrl">
<time datetime="<?php echo get_comment_date('c'); ?>" itemprop="commentTime">
<?php printf( __( '%1$s om %2$s', 'mvdk' ), get_comment_date(), get_comment_time() ); ?>
</time>
</a>
<?php edit_comment_link( __( 'Bewerk', 'mvdk' ), '<p class="edit-link">', '</p>' );

if ( $comment->comment_approved == '0' ) { ?><p class="comment-awaiting-moderation"><?php _e( 'Je reactie wordt beoordeeld voor plaatsing.', 'mvdk' ); ?></p><?php } ?>
</div>
</footer>

<div class="comment-content" itemprop="commentText">
<?php comment_text(); ?>
</div>

<div class="reply">
<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reageer', 'mvdk' ),  'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div>

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
	if ( empty( $comment->comment_author ) ) {
		if ( ! empty( $comment->user_id ) ) {
			$user   = get_userdata( $comment->user_id );
			$author = $user->user_login;
		} else {
			$author = __( 'Anoniem', 'independent-publisher' );
		}
	} else {
		$author = $comment->comment_author;
	}

	// If the user provided more than a first name, use only first name
		if ( strpos( $author, ' ' ) ) {
			$author = substr( $author, 0, strpos( $author, ' ' ) );
		}

	// Replace Reply Link with "Reageer op <Author First Name>"
	$reply_link_text = $args['reply_text'];
	$link            = str_replace( $reply_link_text, __('Reageer op', 'mvdk') . ' ' . $author, $link );

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
/**
 * Displays first gallery from post content. Changes image size from thumbnail
 * to large, to display a larger first image.
 *
 * @since 20-02-2013
 *
 * @return void
 */
function mvdk_featured_gallery() {
$pattern = get_shortcode_regex();
if ( preg_match( "/$pattern/s", get_the_content(), $match ) ) {
if ( 'gallery' == $match[2] ) {
if ( ! strpos( $match[3], 'size' ) ) {
$match[3] .= ' size="medium"'; echo do_shortcode_tag( $match );
}
}
}
}

function mvdk_entry_meta() {

	if ( in_array( get_post_type(), array( 'post', 'attachment', 'portfolio', 'gastartikel', 'workshop', 'advertentie', ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Geplaatst op', 'Used before publish date.', 'mvdk' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
		// if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s" itemprop="name">%3$s</a></span></span>',
				_x( 'Schrijver', 'Used before post author name.', 'mvdk' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		// }
	

		if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'mvdk' ) );	
		} elseif ( 'portfolio' == get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'portfolio-type' );
		} elseif ( 'gastartikel' == get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'gastartikel-type' );
		} elseif ( 'workshop' == get_post_type() ) {
			$categories_list = get_the_term_list( get_the_ID(), 'workshop-type' );
		} elseif ( 'advertentie' == get_post_type() ) {
		$categories_list = get_the_term_list( get_the_ID(), 'adverteerder' );
		}
		
		// if ( $categories_list && mvdk_categorized_blog() ) {
		if ( $categories_list ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span><span itemprop="articleSection">%2$s</span></span>',
				_x( 'Categorie', 'Used before category names.', 'mvdk' ),
				$categories_list
			);
		}


	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'mvdk' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link" itemprop="interactionCount">';
		comments_popup_link( __( 'Reageer', 'mvdk' ), __( '1 reactie', 'mvdk' ), __( '% reacties', 'mvdk' ) );
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
$all_the_cool_cats = get_categories( array(
'fields'     => 'ids',
'hide_empty' => 1,
// We only need to know if there is more than one category.
'number'     => 2,
) );
// Count the number of categories that are attached to the posts
$all_the_cool_cats = count( $all_the_cool_cats );
set_transient( 'all_the_cool_cats', $all_the_cool_cats );
}
if ( $all_the_cool_cats > 1 ) {
// This blog has more than 1 category so mvdk_categorized_blog should return true
return true;
} else {
// This blog has only 1 category so mvdk_categorized_blog should return false
return false;
}
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
add_action( 'edit_category', 'mvdk_category_transient_flusher' );
add_action( 'save_post', 'mvdk_category_transient_flusher' );
/**
 * Retrieve all posts from database and store them for 24h in a transient for the archive page
 *
 * @since 9-3-2013
 */
function all_posts_archive_page() {
if ( false === ( $all_posts_for_archive = get_transient( 'all_posts_for_archive' ) ) ) {
$query = array(
'post_type'		=> array( 'post', 'portfolio', 'gastartikel', ),
'nopaging'		=> true,
'ignore_sticky_posts'	=> true,
'no_found_rows'		=> true,
'cache_results'		=> false,
);
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
/**
* Display author box
*
* @since Esplanade 1.0
*/
function mvdk_post_author() { ?>
<section class="entry-author" itemscope="itemscope" itemtype="http://schema.org/Person">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mvdk_author_bio_avatar_size', 96 ) ); ?>
<h3 class="author vcard"><span class="fn" itemprop="name"><?php the_author(); ?></span></h3>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<p class="author-bio" itemprop="description"><?php the_author_meta( 'description' ); ?></p>
<?php endif; ?>
<section class="author-meta">
<?php 
// Change language depending on number of posts
//$posts_posted = get_the_author_posts();
//if ( $posts_posted == 1) { printf(__( 'Eén artikel tot nu toe. ', 'mvdk' ) ); }
//else { printf(__( '%s artikelen tot nu toe. ', 'mvdk' ), the_author_posts() ); }
// Laat sociale media en andere links zien
printf( '<span class="external-link"><a class="url" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
esc_attr( sprintf( __( 'Bekijk het archief van %s', 'mvdk' ), get_the_author() ) ),
__( 'Mijn archief', 'mvdk' )
);
if ( get_theme_mod( 'mvdk_facebook' ) ) : ?>
<a href="<?php echo esc_url( get_theme_mod( 'mvdk_facebook' ) ); ?>" target="_blank" rel="external nofollow" class="external-link" title="<?php echo esc_url( get_theme_mod( 'mvdk_facebook' ) ); ?>" itemprop="sameAs"><?php esc_html_e('Facebook', 'mvdk') ?></a>
<?php endif;
if ( get_theme_mod( 'mvdk_twitter' ) ) : ?>
<a href="<?php echo esc_url( get_theme_mod( 'mvdk_twitter' ) ); ?>" target="_blank" rel="external nofollow" class="external-link" title="<?php echo esc_url( get_theme_mod( 'mvdk_twitter' ) ); ?>" itemprop="sameAs"><?php esc_html_e('Twitter', 'mvdk') ?></a>
<?php endif;
if ( get_theme_mod( 'mvdk_500px' ) ) : ?>
<a href="<?php echo esc_url( get_theme_mod( 'mvdk_500px' ) ); ?>" target="_blank" rel="external nofollow" class="external-link" title="<?php echo esc_url( get_theme_mod( 'mvdk_500px' ) ); ?>" itemprop="sameAs"><?php esc_html_e('500px.com', 'mvdk') ?></a>
<?php endif;
if ( get_theme_mod( 'mvdk_linkedin' ) ) : ?>
<a href="<?php echo esc_url( get_theme_mod( 'mvdk_linkedin' ) ); ?>" target="_blank" rel="external nofollow" class="external-link" title="<?php echo esc_url( get_theme_mod( 'mvdk_linkedin' ) ); ?>" itemprop="sameAs"><?php esc_html_e('Linkedin', 'mvdk') ?></a>
<?php endif;
if ( get_theme_mod( 'mvdk_flickr' ) ) : ?>
<a href="<?php echo esc_url( get_theme_mod( 'mvdk_flickr' ) ); ?>" target="_blank" rel="external nofollow" class="external-link" title="<?php echo esc_url( get_theme_mod( 'mvdk_flickr' ) ); ?>" itemprop="sameAs"><?php esc_html_e('Flickr', 'mvdk') ?></a>
<?php endif; ?>
</section>
</section>
<?php
}