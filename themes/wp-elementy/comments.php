<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area <?php echo (!have_comments()) ? 'post-not-comment' : ''; ?>">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php esc_html_e('Comments', 'wp-elementy'); ?>
			<small><?php comments_number('', '1', "%"); ?></small>
		</h3>
		<ol class="comment-list">
			<?php wp_list_comments( 'type=comment&callback=wp_elementy_comment' ); ?>
		</ol>
		<?php wp_elementy_comment_nav(); ?>
	<?php endif; // have_comments() ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name__mail' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
				'id_form'           => 'commentform',
				'id_submit'         => 'submit',
				'title_reply'       => esc_html__( 'Leave A Comment', 'wp-elementy'),
				'title_reply_to'    => esc_html__( 'Leave A Reply To %s','wp-elementy'),
				'cancel_reply_link' => esc_html__( 'Cancel Reply','wp-elementy'),
				'label_submit'      => esc_html__( 'SUBMIT COMMENT','wp-elementy'),
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => apply_filters( 'comment_form_default_fields', array(

						'author' =>
						'<div class="col-md-6 mb-30">'.
						'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"' . $aria_req . ' placeholder="'.esc_html__('Name', 'wp-elementy').'"/></div>',

						'email' =>
						'<div class="col-md-6 mb-30">'.
						'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30"' . $aria_req . ' placeholder="'.esc_html__('Email', 'wp-elementy').'"/></div>',
				)
				),
				'comment_field' =>  '<div class="col-md-12"><textarea name="comment" id="comment" class="form-control" placeholder="'.esc_html__('Message','wp-elementy').'" cols="45" rows="3" aria-required="true">' .
				'</textarea></div>',
		);
		comment_form($args);
	?>

</div><!-- .comments-area -->
