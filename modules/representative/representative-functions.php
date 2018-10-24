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
function cpt_representative_init() {
	$labels = array(
		'name'               => _x( 'Representatives', 'post type general name', 'acethehimalaya' ),
		'singular_name'      => _x( 'Representative', 'post type singular name', 'acethehimalaya' ),
		'menu_name'          => _x( 'Representatives', 'admin menu', 'acethehimalaya' ),
		'name_admin_bar'     => _x( 'representative', 'add new on admin bar', 'acethehimalaya' ),
		'add_new'            => _x( 'Add New', 'representative', 'acethehimalaya' ),
		'add_new_item'       => __( 'Add New representative', 'acethehimalaya' ),
		'new_item'           => __( 'New representative', 'acethehimalaya' ),
		'edit_item'          => __( 'Edit representative', 'acethehimalaya' ),
		'view_item'          => __( 'View representative', 'acethehimalaya' ),
		'all_items'          => __( 'All representatives', 'acethehimalaya' ),
		'search_items'       => __( 'Search representatives', 'acethehimalaya' ),
		'parent_item_colon'  => __( 'Parent representatives:', 'acethehimalaya' ),
		'not_found'          => __( 'No representatives found.', 'acethehimalaya' ),
		'not_found_in_trash' => __( 'No representatives found in Trash.', 'acethehimalaya' )
	);

	$args = array(
		'labels'             => $labels,
         'description'        => __( 'Description.', 'acethehimalaya' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'representative' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-businessman',
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'representative', $args );
}
add_action( 'init', 'cpt_representative_init' );


/* *
 * Add custom field in ACF checkbox : acf/load_field
 *  
 * */

 function acf_load_representative_field_choices( $field ) {
    // reset choices
    $field['choices'] = array();
		$args = array( 'post_type'=>'representative');
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); 
						$value = $post->ID;
						//var_dump($post);
			            $label = $post->post_title;
			            $value_array[] = $post->ID;
			            // append to choices
			            $field['choices'][ $value ] = $label;
			endforeach; 
		wp_reset_postdata();
		$field['default_value'] = $value_array;
    // return the field
    return $field;
}

//use the field ID for specific checkbox only
//##IMPORTANT: NEED representative acf fields
add_filter('acf/load_field/key=field_5ab9cc840b7f5', 'acf_load_representative_field_choices');