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

if ( post_password_required() ) {
return;
}
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

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
		<p class="no-comments"><?php esc_html_e( 'Reageren is uitgeschakeld', 'mvdk' ); ?></p>
	<?php } ?>

<?php
// These arguments change the default arguments as defined in /wp-includes/comment-template.php
$comment_args = [
'comment_field' => '<div class="comment-form-comment"><label for="comment">' . _x( 'Reactie', 'mvdk' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></div>',

'comment_notes_before' => '<p class="comment-notes">' . __( 'Ben je nieuwsgierig geworden, wil je bijdragen aan de discussie, of heb je een aanvulling? <strong>Deel je mening!</strong> Voor algemene vragen is er de <a href="https://www.maartenvandekamp.nl/stel-een-vraag/">Vraagbaak</a>.', 'mvdk' ) . '</p>',

'comment_notes_after' => '<p id="email-notes"><strong>Opmerking:</strong> de reactie wordt eerst gelezen (en indien nodig geredigeerd), voordat deze wordt geplaatst. Het emailadres blijft privé.</p>',

'title_reply' => __( 'Schrijf een reactie' ),
'title_reply_to' => __( 'Reageer op %s' ),
'title_reply_before'   => '<h2 id="reply-title" class="comment-reply-title">',
'title_reply_after'    => '</h2>',
'cancel_reply_link' => __( 'Annuleer mijn reactie' ),
'label_submit' => __( 'Plaats mijn reactie' ),
];

comment_form( $comment_args ); // Apply all the custom args with the default and output the customized comment form.
?>

</footer><!-- .comments-area -->