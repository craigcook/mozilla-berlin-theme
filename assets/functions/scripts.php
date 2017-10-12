<?php
/**
 * Enqueue scripts and styles.
 *
 */
function mozilla_berlin_scripts() {

	// Load our main stylesheet.
	wp_enqueue_style( 'mozilla_berlin-zilla_slab', 'https://fonts.googleapis.com/css?family=Zilla+Slab:300i,400,400i,700' );
	
	wp_enqueue_style( 'mozilla_berlin-open_sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700' );
	
	wp_enqueue_style( 'mozilla_berlin-font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'mozilla_berlin-style', get_stylesheet_uri(), '', '20141022' );
	
	wp_enqueue_script( 'mozilla_berlin-main-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '2014100', true );
	
	wp_enqueue_script( 'mozilla_berlin-slick-script', get_template_directory_uri() . '/assets/js/vendor/slick.js', array( 'jquery' ), '20141010', true );
	
	wp_enqueue_script( 'mozilla_berlin-basket-script', get_template_directory_uri() . '/assets/js/vendor/basket-client.js', array( 'jquery' ), '20141012', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'mozilla_berlin_scripts' );
