<?php
### Remove some default widgets, including some from Jetpack, Constant Contact, and others.
function unregister_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	//unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('Twenty_Eleven_Ephemera_Widget');
	unregister_widget( 'Jetpack_Subscriptions_Widget' );
	unregister_widget( 'WPCOM_Widget_Facebook_LikeBox' );
	unregister_widget( 'Jetpack_Gallery_Widget' );
	unregister_widget( 'Jetpack_Gravatar_Profile_Widget' );
	unregister_widget( 'Jetpack_Image_Widget' );
	unregister_widget( 'Jetpack_Readmill_Widget' );
	unregister_widget('Jetpack_RSS_Links_Widget');
	unregister_widget( 'Jetpack_Top_Posts_Widget' );
	unregister_widget( 'Jetpack_Twitter_Timeline_Widget' );
	unregister_widget( 'Jetpack_Display_Posts_Widget' );
	unregister_widget( 'constant_contact_form_widget' );
	unregister_widget( 'constant_contact_events_widget' );
	unregister_widget( 'constant_contact_api_widget' );
	unregister_widget( 'bcn_widget' );
}
add_action('widgets_init', 'unregister_default_widgets', 11);



function lds_travel_theme_setup(){

	### Theme support stuff
	add_theme_support( 'menus' ); // Navigation Menus
	add_theme_support( 'post-thumbnails' ); // Post Thumnbails
	add_theme_support( 'html5' ); // HTML5 in WP Generated Elemements

}
add_action( 'after_setup_theme', 'lds_travel_theme_setup' );



### Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
//add_action('init', 'myprefix_unregister_tags');



### Make image links default to "none"
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);



### Remove dashboard menus
function remove_menus(){
	global $submenu;

	// Theme customize
	unset($submenu['themes.php'][6]);

	// Theme editor
	unset($submenu['themes.php'][11]);

	// Plugin Editor
	unset($submenu['plugins.php'][15]);

	//echo '<pre>'; print_r($submenu); echo '</pre>';
}
//add_action('admin_init', 'remove_menus');



### Media - set default image link location to 'None'
update_option('image_default_link_type','none');



### Edit other TinyMCE stuff
function lds_travel_tiny_mce_edits( $args ) {
	// Always show kitchen sink in WYSIWYG Editor.
	$args['wordpress_adv_hidden'] = false;

	// Set the block formats.
	$args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';

	return $args;
}
add_filter( 'tiny_mce_before_init', 'lds_travel_tiny_mce_edits' );



### Move the SEO By Yoast plugin's meta box to a lower priority so it appears at the bottom of Edit screens.
// https://wordpress.org/support/topic/plugin-wordpress-seo-by-yoast-position-seo-meta-box-priority-above-custom-meta-boxes
add_filter( 'wpseo_metabox_prio', function(){return 'low';} );





### Customize the buttons on the WYSIWYG toolbars
// For the Basic WYSIWYG (via ACF)
function lds_travel_toolbars( $toolbars ){
	//echo "<pre>"; print_r($toolbars); echo "</pre>";
	/*
	Here's what gets output when you print_r($toolbars):
	Array
	(
	    [Basic] => Array
	        (
	            [1] => Array
	                (
	                    [0] => bold
	                    [1] => italic
	                    [2] => underline
	                    [3] => blockquote
	                    [4] => strikethrough
	                    [5] => bullist
	                    [6] => numlist
	                    [7] => alignleft
	                    [8] => aligncenter
	                    [9] => alignright
	                    [10] => undo
	                    [11] => redo
	                    [12] => link
	                    [13] => unlink
	                    [14] => fullscreen
	                )

	        )

	)
	*/

	// Removing the fullscreen button from the light WYSIWYG
	if( ($key = array_search('fullscreen' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifyleft' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifycenter' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('justifyright' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('blockquote' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('strikethrough' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('underline' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	// if( ($key = array_search('bullist' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	// if( ($key = array_search('numlist' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	if( ($key = array_search('alignleft' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('aligncenter' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	if( ($key = array_search('alignright' , $toolbars['Basic' ][1])) !== false ){
	    unset( $toolbars['Basic' ][1][$key] );
	}
	// if( ($key = array_search('link' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }
	// if( ($key = array_search('unlink' , $toolbars['Basic' ][1])) !== false ){
	//     unset( $toolbars['Basic' ][1][$key] );
	// }

	//Add the Paste as PlainText to the light WYSIWYG
	if( isset($toolbars['Basic' ][1]) ){
		$toolbars['Basic'][1][] = 'pastetext';
	}

	// return $toolbars - IMPORTANT!
	return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars' , 'lds_travel_toolbars'  );

// For the FIRST row of the Full WYSIWYG buttons
function lds_travel_tinymce_buttons($buttons) {
	//echo "<pre>"; print_r($buttons); echo "</pre>";
	/*
	Array (
		[0] => bold
	    [1] => italic
	    [2] => strikethrough
	    [3] => bullist
	    [4] => numlist
	    [5] => blockquote
	    [6] => hr
	    [7] => alignleft
	    [8] => aligncenter
	    [9] => alignright
	    [10] => link
	    [11] => unlink
	    [12] => wp_more
	    [13] => spellchecker
	    [14] => fullscreen
	    [15] => wp_adv
	)
	*/
	//Remove the format dropdown select and text color selector
	$remove = array('strikethrough','blockquote','aligncenter','wp_more','fullscreen');

	return array_diff($buttons,$remove);
}
add_filter('mce_buttons','lds_travel_tinymce_buttons');

// For the SECOND row of the Full WYSIWYG buttons
function lds_travel_tinymce_buttons2($buttons) {
	//echo "<pre>"; print_r($buttons); echo "</pre>";
	/*
	Array (
	    [0] => formatselect
	    [1] => underline
	    [2] => alignjustify
	    [3] => forecolor
	    [4] => pastetext
	    [5] => removeformat
	    [6] => charmap
	    [7] => outdent
	    [8] => indent
	    [9] => undo
	    [10] => redo
	    [11] => wp_help
	)
	*/
	//Remove the format dropdown select and text color selector
	$remove = array('underline','alignjustify','forecolor','outdent','indent','wp_help');

	return array_diff($buttons,$remove);
}
add_filter('mce_buttons_2','lds_travel_tinymce_buttons2');








function make_href_root_relative($input) {
	return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}
function root_relative_permalinks($input) {
	return make_href_root_relative($input);
}
add_filter( 'the_permalink', 'root_relative_permalinks' );









### SVG in media uploader
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');





// Prevents the taxonomy checkbox lists from reordering themselves when one or more terms are checked.
// http://stackoverflow.com/questions/4830913/wordpress-category-list-order-in-post-edit-page
function taxonomy_checklist_checked_ontop_filter ($args){
    $args['checked_ontop'] = false;
    return $args;

}
add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');





### Add excerpts to pages
function lds_travel_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'lds_travel_add_excerpts_to_pages' );


/**
 * Remove the content editor from  pages 
 */
function remove_content_editor()
{ 
	//Remove content editor from Frontpage
	$frontpage_id = get_option( 'page_on_front' );
    if( get_the_ID() == $frontpage_id ){      
        remove_post_type_support('page', 'editor');         
	}
	//Add other condition to remove from other pages 

}
add_action('admin_head', 'remove_content_editor');
