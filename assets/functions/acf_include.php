<?php

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_stylesheet_directory() . '/assets/plugins/acf/';
    
    // return
    return $path;
    
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/assets/plugins/acf/';
    
    // return
    return $dir;
    
}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Include ACF
include_once( get_stylesheet_directory() . '/assets/plugins/acf/acf.php' );

// Hide ACF field group menu item
function remove_acf_menu(){
  global $current_user;
  if ($current_user->roles[0]!='administrator'){
    remove_menu_page( 'edit.php?post_type=acf' );
  }
}
add_action( 'admin_menu', 'remove_acf_menu', 100 );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
//	acf_add_options_sub_page('Header');
	acf_add_options_sub_page('Footer');
	
}