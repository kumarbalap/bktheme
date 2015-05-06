<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bktheme
 */

if ( ! function_exists( 'bktheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function bktheme_posted_on() {

// <a href="' . esc_url( get_permalink() )

	echo "<time class='entry-time updated' itemprop='datePublished' datetime='".the_time('c')."'>".the_time('M')."<strong>".the_time('d')."</strong></time>";

	echo '<span class="commentsCount comments-link">';
				comments_popup_link( __( '0', 'bktheme' ), __( '1', 'bktheme' ), __( '%', 'bktheme' ) );
	echo '</span>';	

}
endif;

if ( ! function_exists( 'bktheme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bktheme_entry_footer() {
		// Hide category and tag text for pages.

		echo '<div class="row"><div class="columns large-9">';
		if ( 'post' == get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'bktheme' ) );
				if ( $categories_list && bktheme_categorized_blog() ) {
						echo '<span class="cat-links">' .$categories_list. '</span>';
				}

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'bktheme' ) );
				if ( $tags_list ) {
						echo '<span class="tags-links">' .$tags_list. '</span>';
				}
		}
		echo '</div>';
		echo '<div class="columns large-3">';
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link( __( 'Leave a comment', 'bktheme' ), __( '1 Comment', 'bktheme' ), __( '% Comments', 'bktheme' ) );
				echo '</span>';
		}
		echo '</div>';

		edit_post_link( __( 'Edit', 'bktheme' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bktheme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bktheme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bktheme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bktheme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bktheme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bktheme_categorized_blog.
 */
function bktheme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bktheme_categories' );
}
add_action( 'edit_category', 'bktheme_category_transient_flusher' );
add_action( 'save_post',     'bktheme_category_transient_flusher' );
