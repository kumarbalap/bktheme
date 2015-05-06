<?php
/**
 * bktheme functions and definitions
 *
 * @package bktheme
 */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function bktheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bktheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bktheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bktheme_scripts() {
	//wp_enqueue_style('google-sans', "http://fonts.googleapis.com/css?family=Open+Sans:400,600");
	wp_enqueue_style( 'bktheme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'my-style', get_template_directory_uri().'/lib/foundation/foundation.min.css', false, '', 'screen');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bktheme_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
				return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
				return array();
		}
}

/**
 * Remove jQuery migrate script
 */
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.2' );
    }
}