<?php


/*
 * Allow editors to see Appearance menu
 *
 */
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );
function hide_menu() {
 
    // Hide theme selection page
    remove_submenu_page( 'themes.php', 'themes.php' );
 
    // Hide widgets page
    remove_submenu_page( 'themes.php', 'widgets.php' );
 
    // Hide customize page
    global $submenu;
    unset($submenu['themes.php'][6]);
 
}
 
add_action('admin_head', 'hide_menu');

function remove_editor() {
  remove_post_type_support('page', 'editor');
//  remove_post_type_support('post', 'editor');
}
add_action('admin_init', 'remove_editor');


remove_action('wp_head', 'rsd_link'); // removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); // removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); // removes meta name generator.
remove_action('wp_head', 'rest_output_link_wp_head', 10 ); // removes json api link.
remove_action('wp_head', 'feed_links', 2 ); // removes feed links.
remove_action('wp_head', 'feed_links_extra', 3 );  // removes comments feed. 

/*
 * Remove tags support from posts
 *
 */
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');

/*
 * unregister widgets
 *
 */
function unregister_default_widgets() {     
	// unregister_widget('WP_Widget_Pages');
	// unregister_widget('WP_Widget_Search');
	// unregister_widget('WP_Widget_Text');
	// unregister_widget('WP_Widget_Categories');   
	// unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');   
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');   
 	unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_default_widgets', 11);


/*
 * remove embed javas-script
 * http://wordpress.stackexchange.com/questions/211701/what-does-wp-embed-min-js-do-in-wordpress-4-4
 */
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


/*
 * remove comment-reply javas-script
 * http://crunchify.com/try-to-deregister-remove-comment-reply-min-js-jquery-migrate-min-js-and-responsive-menu-js-from-wordpress-if-not-required/
 */
function crunchify_clean_header_hook(){
	wp_deregister_script( 'comment-reply' );
 }
add_action('init','crunchify_clean_header_hook');


/*
 * Remove URL field from Comments
 *
 */
function crunchify_disable_comment_url($fields) { 
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');


/*
 * Remove comments form from Media Attachments (image.php)
 *
 */
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );


/*
 * Remove Emoji Support and DNS prefatch
 *
 */
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
add_filter( 'emoji_svg_url', '__return_false' );


/*
 * Disable WordPress API
 *
 */
function DRA_only_allow_logged_in_rest_access( $access ) {
	
	if( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_cannot_access', __( 'Only authenticated users can access the REST API.', 'mozilla_berlin' ), array( 'status' => rest_authorization_required_code() ) );
    }
    return $access;
	
}
add_filter( 'rest_authentication_errors', 'DRA_only_allow_logged_in_rest_access' );
