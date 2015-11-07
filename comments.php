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

<footer id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf(
					esc_html( _nx( 'Er is 1 reactie', '%1$s reacties', get_comments_number(), 'comments title', 'mvdk' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( [
					'callback'	=> 'mvdk_comment',
					'short_ping'	=> true,
					'avatar_size'	=> 40,
				] );
			?>
		</ol><!-- .comment-list -->

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav class="navigation comment-navigation">
<h2 class="screen-reader-text"><?php _e( 'Navigatie voor reacties', 'mvdk' ); ?></h2>
<div class="nav-previous"><?php previous_comments_link( __( 'Oude reacties', 'mvdk' ) ); ?></div>
<div class="nav-next"><?php next_comments_link( __( 'Nieuwe reacties', 'mvdk' ) ); ?></div>
</nav>
<?php endif; // Check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Reageren is uitgeschakeld', 'mvdk' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
		'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Reactie', 'mvdk' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>',
		'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Leuk dat je een reactie wilt plaatsen! Vul daarvoor de onderstaande velden in. De velden met <span class="required">*</span> zijn verplicht.<br />Heb je een algemene vraag over fotografie? Dan kun je die op <a href="https://www.maartenvandekamp.nl/stel-een-vraag/">deze pagina</a> plaatsen.', 'mvdk' ) . '</span></p>',
		'comment_notes_after' => '<p>Je reactie wordt eerst gelezen voordat deze geplaatst wordt. Het emailadres wordt <strong>niet</strong> openbaar gemaakt.</p>',
		'title_reply' => __( 'Schrijf een reactie' ),
		'title_reply_to' => __( 'Reageer op %s' ),
		'title_reply_before'   => '<h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h2>',
		'cancel_reply_link' => __( 'Annuleer mijn reactie' ),
		'label_submit' => __( 'Plaats mijn reactie' ),
		'format' => 'html5',
		) ); ?>

</footer><!-- .comments-area -->