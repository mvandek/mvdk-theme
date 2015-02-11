<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package mvdk-theme
 * @since mvdk-theme v2
 */

if ( post_password_required() )
return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'Er is 1 reactie', '%1$s reacties', get_comments_number(), 'comments title', 'twentyfifteen' ),
					number_format_i18n( get_comments_number() ) );
			?>
		</h2>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav role="navigation" id="comments-nav-below" class="navigation">
<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'expound' ); ?></h2>
<div class="nav-previous"><?php previous_comments_link( __( '&larr; Oude reacties', 'esplanade' ) ); ?></div>
<div class="nav-next"><?php next_comments_link( __( 'Nieuwe reacties &rarr;', 'esplanade' ) ); ?></div>
</nav>
<?php endif; // Check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'callback'	=> 'esplanade_comment',
					'style'		=> 'ol',
					'short_ping'	=> true,
					'avatar_size'	=> 37,
				) );
			?>
		</ol><!-- .comment-list -->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav role="navigation" id="comments-nav-below" class="navigation">
<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'expound' ); ?></h2>
<div class="nav-previous"><?php previous_comments_link( __( '&larr; Oude reacties', 'esplanade' ) ); ?></div>
<div class="nav-next"><?php next_comments_link( __( 'Nieuwe reacties &rarr;', 'esplanade' ) ); ?></div>
</nav>
<?php endif; // Check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Reageren is uitgeschakeld', 'twentyfifteen' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->