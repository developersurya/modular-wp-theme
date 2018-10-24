<?php

// create two taxonomies, genres and writers for the post type 
function lds_travel_registers_taxonomies() {

    $lds_travel_magic_taxonomy_maker_array = array(

        //Register default taxonomies
        array(
            'tax_singular' => 'Destination',
            'tax_plural'   => 'Destinations',
            'tax_slug'     => 'destinations', // lowercase letters and dashes only
            'applicable_post_types' => array(
                'trip',
                'activity-info' //add more post type if needed
            )
        ),
        array(
            'tax_singular' => 'Activity',
            'tax_plural'   => 'Activities',
            'tax_slug'     => 'activities', // lowercase letters and dashes only
            'applicable_post_types' => array(
                'trip',
                'activity-info' //add more post type if needed
            )
        ),
        array(
            'tax_singular' => 'Region',
            'tax_plural'   => 'Regions',
            'tax_slug'     => 'regions', // lowercase letters and dashes only
            'applicable_post_types' => array(
                'trip', //add more post type if needed
            )
        ),

    );

    foreach( $lds_travel_magic_taxonomy_maker_array as $taxonomy ){
        $tax_singular = $taxonomy['tax_singular'];
        $tax_plural   = $taxonomy['tax_plural'];
        $tax_slug     = $taxonomy['tax_slug'];
        $applicable_post_types = $taxonomy['applicable_post_types'];

        $labels = lds_travel_generate_tax_labels_array($tax_singular, $tax_plural);
        $args = lds_travel_generate_tax_args_array($labels, $tax_slug);
        register_taxonomy( $tax_slug, $applicable_post_types, $args );
    }

}
add_action( 'init', 'lds_travel_registers_taxonomies', 0 ); // hook into the init action



function lds_travel_generate_tax_labels_array($tax_singular, $tax_plural){
    $labels = array(
        'name'              => __( $tax_plural ),
        'singular_name'     => __( $tax_singular ),
        'search_items'      => __( 'Search '.$tax_plural ),
        'all_items'         => __( 'All '.$tax_plural ),
        'parent_item'       => __( 'Parent '.$tax_singular ),
        'parent_item_colon' => __( 'Parent '.$tax_singular.':' ),
        'edit_item'         => __( 'Edit '.$tax_singular ),
        'update_item'       => __( 'Update '.$tax_singular ),
        'add_new_item'      => __( 'Add New '.$tax_singular ),
        'new_item_name'     => __( 'New '.$tax_singular.' Name' ),
        'menu_name'         => __( $tax_plural ),
    );
    return $labels;
}

function lds_travel_generate_tax_args_array($labels, $tax_slug){
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $tax_slug ),
    );
    return $args;
}
