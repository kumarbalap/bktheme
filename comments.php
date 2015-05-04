<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package bktheme
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

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf(
					_nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'bktheme' ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bktheme' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'bktheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'bktheme' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bktheme' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'bktheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'bktheme' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bktheme' ); ?></p>
	<?php endif; ?>

	<?php
	if (comments_open()) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$custom_args = array(
			'title_reply' 			=> 'Leave a Reply',
			'title_reply_to' 		=> __('Leave a Reply to %s', 'bktheme'),
			'comment_notes_before' 	=> '<p class="comment-notes">' . __('Your email address will not be published.', 'bktheme') . '</p>',
			'comment_notes_after'  	=> '',
			'id_submit' 			=> 'comment-submit',
			'label_submit' 			=> __('Send Comment', 'bktheme'),
			'comment_field' 		=> '<textarea id="comment" name="comment" placeholder="' . __('Enter Message Here', 'bktheme') . '" class="comment-text-area" cols="45" rows="5" aria-required="true"></textarea></p>',
			'fields' 				=>
				apply_filters( 'comment_form_default_fields', array(
					'author'	=>
						'<div class="row"><div class="columns large-5">' .
						'<input type="text" id="author" name="author" placeholder="' . __('Name *', 'bktheme') . '" class="comment-name" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />' .
						'</div>',
					'email' 	=>
						'<div class="columns large-7">' .
						'<input type="text" id="email" name="email" placeholder="' . __('Email *', 'bktheme') . '" class="comment-email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />' .
						'</div></div>',
					//'url' 		=>	'<input type="text" id="url" name="url" placeholder="' . __('Enter URL', 'bktheme') . '" class="comment-url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />'
					)
				)
		);
		comment_form($custom_args);
	}
    ?>

</div><!-- #comments -->
