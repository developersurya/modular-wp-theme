<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * Available Meta_key are discount_percentage,bestseller,featured
 */

    $query = array(
        'posts_per_page'   => -1,
        'post_type'     => 'trip',
        //'meta_key'     => 'bestseller', //change metakey bestseller,featured (true/false fields)
        //'meta_value'    => true, //change metakey bestseller,featured (true/false fields)
        'meta_key'     => 'discount_percentage', //change metakey discount_percentage ( Numerical)
        'meta_value' => 0,//change metakey discount_percentage ( Numerical)
        'meta_compare' => '>',//change metakey discount_percentage ( Numerical)
    );
    $the_query = new WP_Query( $query );
     $trip_data = array();
    if( $the_query->have_posts() ): 
        while( $the_query->have_posts() ) : 
            $the_query->the_post(); 

                $trip_data[] = array(
                    //post defaults
                    'post_title'             => get_the_title(),      
                    'post_id'                => get_the_id(),      
                    'post_content'           => get_the_content(),      
                    'featured_image'         => get_the_post_thumbnail_url(),      
                    'featured_image_caption' => get_the_post_thumbnail_caption(),      
                    'trip_type'              => get_field('trip_type'),
                    //Trip Options
                    'trip_cost'              => get_field('trip_cost'),
                    'discount_percentage'    => get_field('discount_percentage'),
                    'offer_starts'           => get_field('offer_starts'),
                    'offer_ends'             => get_field('offer_ends'),
                    'featured'               => get_field('featured'),
                    'bestseller '            => get_field('bestseller'),   
                    'thumbnail'              => get_field('trip_thumbnail'),   
                    //Overview   
                    'code'                   => get_field('code'),
                    'days'                   => get_field('days'),
                    'group_size'             => get_field('group_size'),
                    'trip_level'             => get_field('trip_level'),
                    'max_altitude'           => get_field('max_altitude'),
                    'country_visited'        => get_field('country_visited'),
                    'trip_starts_at'         => get_field('trip_starts_at'),
                    'trip_ends_at'           => get_field('trip_ends_at'),
                    'destination'            => get_field('destination'),
                    'best_season'            => get_field('best_season'),
                    'activity'               => get_field('activity'),
                    'activity_per_day'       => get_field('activity_per_day'),
                    'trip_route'             => get_field('trip_route'),
                    'highlights'             => get_field('highlights'),
                );

                endwhile;  
                
        wp_reset_query(); 

    endif; 

  lds_travel_discounted_trip($trip_data);

    