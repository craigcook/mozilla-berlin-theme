<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'mozilla_berlin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since mozilla_berlin 1.0
 */
function mozilla_berlin_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/mozilla_berlin
	 * If you're building a theme based on mozilla_berlin, use a find and replace
	 * to change 'mozilla_berlin' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mozilla_berlin' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails', array( 'post','people','stories' ) );
	set_post_thumbnail_size( 288, 175, true );
	//add_image_size('thumbnail-2x', 576, 350, true);
	add_image_size('2col-thumbnail', 595, 362, true);
	//add_image_size('2col-thumbnail-2x', 1190, 724, true);
	add_image_size('2col', 595, 9999, false);
	//add_image_size('2col-2x', 1190, 9999, true);
	add_image_size('contentcol', 803, 9999, false);
	add_image_size('3col-thumbnail', 387, 235, true);
	//add_image_size('3col-thumbnail-2x', 774, 470, true);
	add_image_size('featured-slider', 940, 578, true);
	add_image_size('newsletter', 100, 100, true);
	add_image_size('gallery-large', 1190, 9999, false);
	add_image_size('gallery', 377, 9999, false);
	add_image_size('expert', 283, 9999, false);
	//add_image_size('expert-2x', 595, 9999, true);
	//add_image_size('expert-3x', 850, 9999, true);
	add_image_size('intro', 1520, 9999, false);

	// This theme uses wp_nav_menu() in two locations.
	/*
	 * Register navigation menus
	 *
	 */

	register_nav_menus( array(
		'primary' 			=> __( 'Main-Navigation', 'mozilla_berlin' ),
		'footer_left' 		=> __( 'Footer-Left', 'mozilla_berlin' ),
		'footer_right'	 	=> __( 'Footer-Right', 'mozilla_berlin' ),
		'footer_meta'	 	=> __( 'Footer-Meta', 'mozilla_berlin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
//	) );
	
//	add_theme_support( 'custom-header', array(
//		'flex-width'    => true,
//		'width'         => 200,
//		'flex-height'    => true,
//		'height'        => 31,
//		'default-image' => get_template_directory_uri() . '/assets/img/mozilla-berlin_logo.svg',
//		'uploads'       => true,
//	) );

}
endif; // mozilla_berlin_setup
add_action( 'after_setup_theme', 'mozilla_berlin_setup' );


/*
 * Add svg support
 * https://css-tricks.com/snippets/wordpress/allow-svg-through-wordpress-media-uploader/
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function mozilla_berlin_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
    add_editor_style( get_stylesheet_uri() );
}
add_action( 'init', 'mozilla_berlin_add_editor_styles' );

function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="embed-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);