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

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'bktheme' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'bktheme' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'bktheme' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'bktheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'bktheme' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'bktheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'bktheme' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'bktheme' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'bktheme' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'bktheme' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'bktheme' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'bktheme' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'bktheme' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'bktheme' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
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
