<?php 
/**
 *Default hook is not available for removing description from taxonomy,category. Using tradition JS method.
 * ref:https://wordpress.stackexchange.com/questions/288381/remove-description-in-custom-taxonomy-edit-screen
 */
function debugger($data, $is_die = false){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if($is_die){
        exit;
    }
}
add_action( 'admin_footer-edit-tags.php', 'lds_travel_remove_cat_tag_description' );

function lds_travel_remove_cat_tag_description(){
    global $current_screen;
    switch ( $current_screen->id ) 
    {
        case 'edit-category':
            // WE ARE AT /wp-admin/edit-tags.php?taxonomy=category
            // OR AT /wp-admin/edit-tags.php?action=edit&taxonomy=category&tag_ID=1&post_type=post
            break;
        case 'edit-post_tag':
            // WE ARE AT /wp-admin/edit-tags.php?taxonomy=post_tag
            // OR AT /wp-admin/edit-tags.php?action=edit&taxonomy=post_tag&tag_ID=3&post_type=post
            break;
    }
    ?>
    <script type="text/javascript">
    jQuery(document).ready( function($) {
        $('#tag-description').parent().remove();
    });
    </script>
    <?php
}

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

//// Register Navigation Menus
function custom_navigation_menus() {

	$locations = array(
		'primary_menu' => __('Primary Menu', 'acethehimalaya'),
		'secondary_menu' => __('Secondary Menu', 'acethehimalaya'),
	);
	register_nav_menus($locations);

}

add_action('init', 'custom_navigation_menus');

/**
 * This code register the theme option.
 */

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' => 'Ace Options',
		'menu_title' => 'Ace Options',
		'menu_slug' => 'ace-options',
		'capability' => 'edit_posts',
		'redirect' => false,
	));
}
// Remove theme customizer
add_action('after_setup_theme', 'remove_custom_wpoption', 20);

function remove_custom_wpoption() {
    remove_theme_support( 'custom-background' );
    remove_theme_support( 'custom-header' );
}

//for shortcode support in widget
add_filter('widget_text', 'do_shortcode');


/**
 * [lds_travel_custom_menu_order 
 * @param $menu_ord  
 * @return //?
 */
function lds_travel_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'edit.php?post_type=trip',
        'edit.php?post_type=departure-dates',
        'edit.php?post_type=activity-info',
        'edit.php?post_type=faqs',
        'separator1', // First separator
        'upload.php', // Media
        'edit.php', // Posts
        'link-manager.php', // Links
        'edit-comments.php', // Comments
        'edit.php?post_type=page', // Pages
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'lds_travel_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'lds_travel_custom_menu_order', 10, 1 );


/**
 * Define the action and give functionality to the action.
 */
 function lds_travel_include_module() {
   //do_action( 'include_module',$module_name);
   //do_action( 'wp_enqueue_scripts','lds_travel_enqueue_module_scripts');
 }
 
 /**
  * Register the action with WordPress.
  */
add_action( 'lds_travel_include_module', 'lds_travel_include_module_func',10,2 );
function lds_travel_include_module_func($module_name,$tpl_name,$function_file = false) {
  
        $module_files = lds_travel_get_stylesheet_path().'/modules/'.$module_name.'/'.$module_name.'.php';
        $module_content = lds_travel_get_stylesheet_path().'/modules/content/layouts/'.$module_name.'.php';

        if( file_exists($module_files) && file_exists($module_files) ):
            include_once $module_files; //allow include one time only
            include_once $module_content;
        endif;
        if($function_file == true){
            echo "aaaaaa";
            $module_js = lds_travel_get_stylesheet_path().'/modules/'.$module_name.'/'.$module_name.'-functions.php';
            if( file_exists($module_js) ):
                include $module_js;
            endif;
        }

}

/**
 * add action for calling Module . IMPORTANT if we are calling same module multiple time.
 */
add_action( 'lds_travel_include_module_multiple', 'lds_travel_include_module_tpl_func',10,2 );
function lds_travel_include_module_tpl_func($module_name,$tpl_name) {

    $module_files = lds_travel_get_stylesheet_path().'/modules/'.$module_name.'/'.$module_name.'.php';
    $module_content = lds_travel_get_stylesheet_path().'/modules/content/layouts/'.$module_name.'.php';

    if( file_exists($module_files) && file_exists($module_files) ):
        include $module_content; //allow include multiple times
        include $module_files;
    endif;

}

/**
 * Load functional modules (e.g. date-generator)
 * IMPORTANT: Use it if we do not have or no need tpl file.
 */
$functional_module = array(
     'date-generator',
      'hbl-payment',
      'hbl-direct-payment',
      'testimonial',
     // 'certificate',
     //'load-more',
     
    
);
foreach($functional_module as $module_name){
    $module_file = lds_travel_get_stylesheet_path().'/modules/'.$module_name.'/'.$module_name.'.php';
    $module_content = lds_travel_get_stylesheet_path().'/modules/content/layouts/'.$module_name.'.php';
 
    if( file_exists($module_file) ):
        include $module_file;
    endif;
    if( file_exists($module_content) ):
        include $module_content;
    endif;
}


/**
 * Enqueue scripts for modules.
 * #Add exact name of modules in array.
 * #Can be use to add module-functions.php
 * @var string
 */

$module_with_js = array(

    'hero',
    // 'featured-trip',
    'date-generator',
    'departure-dates',
    'trip-forms',
    'representative',
    'hbl-payment',
    'hbl-direct-payment',
    'testimonial',
    'certificate',
    'load-more',
    'print'

);
foreach($module_with_js as $module_name){
    $module_js = lds_travel_get_stylesheet_path().'/modules/'.$module_name.'/'.$module_name.'-functions.php';
    if( file_exists($module_js) ):
        include $module_js;
    endif;
}

/**
 * Discounted price with round number 
 * @param  String $original_price 
 * @param  String $discount      
 * @return float String                
 */
function lds_travel_discounted_price($original_price,$discount){

    $discounted_cost = (int)$original_price-(((int)$original_price * (int)$discount)/100);
    
    return round($discounted_cost);

}