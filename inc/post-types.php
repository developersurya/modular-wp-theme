<?php

function lds_travel_register_post_types() {

	// Add all your post type info into this array.
	$lds_travel_magic_post_type_maker_array = array(

        array(
            'cpt_single' => 'Trip',
            'cpt_plural' => 'Trips',
            'slug' => 'trip',
            'cpt_icon' => 'dashicons-palmtree',
            'exclude_from_search' => true,
            'cpt_supports' => array('title','editor','thumbnail','excerpt'),
            'cpt_menu_position'=> 2,
        ),
            array(
            'cpt_single' => 'Departure Dates',
            'cpt_plural' => 'Departure Dates',
            'slug' => 'departure-dates',
            'cpt_icon' => 'dashicons-calendar',
            'exclude_from_search' => true,
            'cpt_supports' => array('title'),
            'cpt_menu_position'=> 3
        ),
        array(
            'cpt_single' => 'Activity Info',
            'cpt_plural' => 'Activity Info',
            'slug' => 'activity-info',
            'cpt_icon' => 'dashicons-clipboard',
            'exclude_from_search' => true,
            'cpt_supports' => array('title', 'editor'),
            'cpt_menu_position'=> 4
        ),
    
        array(
            'cpt_single' => 'FAQS',
            'cpt_plural' => 'FAQS',
            'slug' => 'faqs',
            'cpt_icon' => 'dashicons-format-status',
            'exclude_from_search' => true,
            'cpt_supports' => array('title'),
            'cpt_menu_position'=> 5
        ),
        

	);

	foreach( $lds_travel_magic_post_type_maker_array as $post_type ){
		$cpt_single = $post_type['cpt_single'];
		$cpt_plural = $post_type['cpt_plural'];
		$slug = $post_type['slug'];
		$cpt_icon = $post_type['cpt_icon'];
        $exclude_from_search = $post_type['exclude_from_search'];
		$cpt_supports = $post_type['cpt_supports'];
        $cpt_menu_position =$post_type['cpt_menu_position'];

		// Admin Labels
	  	$labels = lds_travel_generate_label_array($cpt_plural, $cpt_single);

	  	// Arguments
		$args = lds_travel_generate_post_type_args($labels, $cpt_plural, $cpt_icon, $exclude_from_search,$cpt_supports,$cpt_menu_position);

		// Just do it
		register_post_type( $slug, $args );
	}

}

// Hook into the 'init' action
add_action( 'init', 'lds_travel_register_post_types', 0 );




function lds_travel_generate_label_array($cpt_plural, $cpt_single){

	$labels = array(
            'name'               => __( $cpt_plural,                                'spark' ),
            'singular_name'      => __( $cpt_single,                                'spark' ),
            'add_new'            => __( 'Add New '.$cpt_single,                     'spark' ),
            'add_new_item'       => __( 'Add New '.$cpt_single,                     'spark' ),
            'edit_item'          => __( 'Edit '.$cpt_single,                        'spark' ),
            'new_item'           => __( 'New '.$cpt_single,                         'spark' ),
            'all_items'          => __( 'All '.$cpt_plural,                         'spark' ),
            'view_item'          => __( 'View '.$cpt_single.' Page',                'spark' ),
            'search_items'       => __( 'Search '.$cpt_plural,                      'spark' ),
            'not_found'          => __( 'No '.$cpt_plural.' found',                 'spark' ),
            'not_found_in_trash' => __( 'No '.$cpt_plural.' found in the Trash',    'spark' ),
            'parent_item_colon'  => '',
            'menu_name'          => $cpt_plural,
        );

	return $labels;
}

function lds_travel_generate_post_type_args($labels, $cpt_plural, $cpt_icon, $exclude_from_search,$cpt_supports,$cpt_menu_position){
	$args = array(
        'labels'        	  => $labels,
        'description'   	  => __('Manage '.$cpt_plural, 'spark'),
        'public'        	  => true,
        'menu_position' 	  => $cpt_menu_position,
        'hierarchical'		  => true,
        'supports'      	  => $cpt_supports,
        'has_archive'   	  => true,
        'menu_icon'			  => $cpt_icon,
        'exclude_from_search' => $exclude_from_search
    );

	return $args;
}
