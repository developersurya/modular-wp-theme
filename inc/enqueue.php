<?php
// ### jQuery, Condiitonizr, and Modernizr are loaded in the <head>.
// ### Everything else should load at the end of the page, use TRUE for the 5th parameter of wp_register_script().
// function lds_travel_scripts(){
// 	if (!is_admin()) {
// 	### Core
// 		// Deregister WordPress jQuery and register Google's
// 		wp_deregister_script('jquery');
// 		wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false);
// 		wp_enqueue_script('diplo-fonts', '//fast.fonts.net/jsapi/d41d7a41-beb9-4d15-bfea-af2aaca0f1c6.js', array(), '2.0', false);
// 		wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/639c56af83.js', array(), '1.0', false);

// 		// Conditionizr
// 		//wp_enqueue_script('conditionizr', JSDIR.'/conditionizr.min.js', array(), '2.1.1', false);

// 		// Modernizr
// 		//wp_enqueue_script('modernizr', JSDIR.'/modernizr.custom.2.8.1.js', array(), '2.8.1', false);

// 		// Bootstrap
// 		wp_enqueue_script('bootstrap__scripts', STYLEDIR.'/bootstrap/javascripts/bootstrap.min.js', array('jquery'), '1.0', true);

// 		// Main Stylsheet
// 		wp_enqueue_style('css', STYLEDIR.'/style.css', false, time());

// 		// Main Scripts (this file is concatenated from the files inside of js/development/ )
// 		wp_enqueue_script('scripts', JSDIR.'/scripts.min.js', array('jquery'), time(), true);
//         wp_localize_script( 'scripts', 'localized', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'siteurl' => get_site_url()));

//         ### Modules
// 		// moduleName
// 		// wp_register_script('template-default-js', MODDIR.'moduleName/js/moduleName.js', array('jquery'), '1.0', true);



// 	### Templates
// 		// Template Name
// 		// wp_register_script('template-default-js', JSDIR.'/template-default.js', array('jquery'), '1.0', true);



// 	}
// }
// add_action('wp_enqueue_scripts','lds_travel_scripts');




// /**
//  * Enqueue scripts
//  * Front area css
//  */
// function sm_front_theme_style(){
		
// 	wp_enqueue_script( 'sm-front-style', get_template_directory_uri().'/bootstrap/bootstrap.css' );
		
// }
// //add_action( 'wp_enqueue_scripts', 'sm_front_theme_style' );


// ### Admin area stuff
// function lds_travel_admin_theme_style() {
// 	// CSS for admin
//     wp_enqueue_style('admin-theme', STYLEDIR.'/css/admin/style-admin.min.css');
// }
// add_action('admin_enqueue_scripts', 'lds_travel_admin_theme_style');

// ### Login screen stuff
// function lds_travel_login_stylesheet() {
// 	// CSS for login screen
// 	wp_enqueue_style('login-theme', STYLEDIR.'/css/admin/style-login.min.css');
// }
// add_action( 'login_enqueue_scripts', 'lds_travel_login_stylesheet' );

// ### Post content editor (TinyMCE)
// function lds_travel_tinymce_style() {
// 	// CSS for admin
//     add_editor_style( STYLEDIR.'/css/admin/style-tinymce.min.css' );
// }
// add_action('admin_init', 'lds_travel_tinymce_style');

function acethehimalaya_scripts() {
	
	wp_localize_script(
		'scripts', 'ajax_object',
		array(
			'ajax_url' => admin_url('admin-ajax.php'),
		)
	);
}

add_action('wp_enqueue_scripts', 'acethehimalaya_scripts');

/**
 * Enqueue scripts and styles.
 */
function lds_travel_scripts() {
	wp_enqueue_style('wpb-google-fonts', '///fonts.googleapis.com/css?family=Domine:400,700|Open+Sans:400,600,700', false);
	//wƒp_enqueue_style('fonts', get_stylesheet_directory_uri() . '/lib/css/fonts.css', array(), true);
	wp_enqueue_style('acethehimalaya-style', get_stylesheet_uri());
	wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/style1.css', array());
	wp_enqueue_style('bootstrap-min-css', get_stylesheet_directory_uri() . '/lib/css/bootstrap.css', array());
	wp_enqueue_style('compile', get_stylesheet_directory_uri() . '/lib/css/compile.css', array());
	wp_enqueue_style('fancybox', get_stylesheet_directory_uri() . '/lib/css/jquery.fancybox.css', array());
	wp_enqueue_style('slick-min', get_stylesheet_directory_uri() . '/lib/css/slick-min.css', array());
	wp_enqueue_style('mCustomScrollbar', get_stylesheet_directory_uri() . '/lib/css/jquery.mCustomScrollbar.min.css', array());
	wp_enqueue_script('scripts', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11', false);
	wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.6', false);
	wp_enqueue_script('cookie-js', get_template_directory_uri() . '/lib/js/jquery.cookie.js', array(), '1.4.1', false);
	wp_enqueue_script('acethehimalaya-script', get_template_directory_uri() . '/lib/js/plugins.js', array());
	wp_enqueue_script('acethehimalaya-main', get_template_directory_uri() . '/lib/js/main.js', array());
	wp_enqueue_script('ace-bootstrap-select', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js', array());
	wp_enqueue_style('ace-bootstrap-select-css', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css');
	wp_enqueue_style('jquery-ui-css', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action( 'wp_enqueue_scripts', 'lds_travel_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function lds_travel_admin_scripts() {
    
    wp_enqueue_script('lds-travel-admin-script', get_template_directory_uri() . '/js/admin/lds-travel-admin-script.js', array('jquery'), true);

    
}
add_action('admin_enqueue_scripts', 'lds_travel_admin_scripts');
