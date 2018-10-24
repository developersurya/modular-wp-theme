<?php 
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * Add related custom functions 
 * @return [type] [description]
 */

/**
 * Register a book post type.
 * ##IMPORTANT: kept seperated form post-type.php so that it will create only if module called
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function cpt_testimonial_init() {
	$labels = array(
		'name'               => _x( 'Testimonial', 'post type general name', 'acethehimalaya' ),
		'singular_name'      => _x( 'testimonial', 'post type singular name', 'acethehimalaya' ),
		'menu_name'          => _x( 'Testimonial', 'admin menu', 'acethehimalaya' ),
		'name_admin_bar'     => _x( 'testimonial', 'add new on admin bar', 'acethehimalaya' ),
		'add_new'            => _x( 'Add New', 'testimonial', 'acethehimalaya' ),
		'add_new_item'       => __( 'Add New testimonial', 'acethehimalaya' ),
		'new_item'           => __( 'New testimonial', 'acethehimalaya' ),
		'edit_item'          => __( 'Edit testimonial', 'acethehimalaya' ),
		'view_item'          => __( 'View testimonial', 'acethehimalaya' ),
		'all_items'          => __( 'All testimonial', 'acethehimalaya' ),
		'search_items'       => __( 'Search testimonial', 'acethehimalaya' ),
		'parent_item_colon'  => __( 'Parent testimonial:', 'acethehimalaya' ),
		'not_found'          => __( 'No testimonial found.', 'acethehimalaya' ),
		'not_found_in_trash' => __( 'No testimonial found in Trash.', 'acethehimalaya' )
	);

	$args = array(
		'labels'             => $labels,
         'description'        => __( 'Description.', 'acethehimalaya' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-star-filled',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'cpt_testimonial_init' );

add_action( 'init', 'create_testimonial_tax' );

function create_testimonial_tax() {
	register_taxonomy(
		'testimonial-category',
		'testimonial',
		array(
			'label' => __( 'Testimonial Category' ),
			'rewrite' => array( 'slug' => 'testimonial-category' ),
			'hierarchical' => true,
		)
	);
}


/* *
 * Add custom field in ACF checkbox : acf/load_field
 *  
 * Populating trip title in dropdown in the testimonial form
*/

add_filter('gform_pre_render_13', 'populate_posts_13');
function populate_posts_13($form) {

	foreach ($form['fields'] as &$field) {
		if ($field->id == 5) {
			$posts = get_posts('numberposts=-1&post_type=trip');
			$postSlug = get_post(get_the_ID());
			$slug = $postSlug->post_name;
			$choices = array();
			if (!is_page(3550)) {
				//reviews page id
				$choices[] = array('text' => get_the_title(), 'value' => $slug);
			}
			$choices[] = array('text' => 'General Category', 'value' => 'general');

			foreach ($posts as $post) {
				if ($slug != $post->post_name) {
					$choices[] = array('text' => $post->post_title, 'value' => $post->post_name);
				}
			}

			$field->choices = $choices;
		}
	}

	return $form;
}
