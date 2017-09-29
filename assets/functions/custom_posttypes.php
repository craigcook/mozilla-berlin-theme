<?php

/*
 * Custom Post Type People of Mozilla
 *
 */

// Our custom post type function
function create_posttype_people() {

	register_post_type( 'people',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'People of Mozilla' ),
				'singular_name' => __( 'Person' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'people'),
            'menu_icon' => 'dashicons-nametag',
            'supports' => array( 'title', 'thumbnail','excerpt')
		)
	);
	
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_people' );


/*
 * Custom Post Type Stories
 *
 */

// Our custom post type function
function create_posttype_stories() {

	register_post_type( 'stories',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Stories' ),
				'singular_name' => __( 'Story' )
			),
			'menu_position' => 5,
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'stories'),
            'menu_icon' => 'dashicons-welcome-write-blog',
            'supports' => array( 'title', 'thumbnail','excerpt'),
			'taxonomies' => array( 'category' )
		)
	);
	
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_stories' );