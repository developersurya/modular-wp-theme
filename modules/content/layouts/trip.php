<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key are discount_percentage,bestseller,featured
 */

    $query = array(
        'posts_per_page'   => -1,
        'post_type'     => 'trip',
        'meta_key'     => 'bestseller', //change metakey bestseller,featured (true/false fields)
        'meta_value'    => true, //change metakey bestseller,featured (true/false fields)
        // 'meta_key'     => 'discount_percentage', //change metakey discount_percentage ( Numerical)
        // 'meta_value' => 0,//change metakey discount_percentage ( Numerical)
        // 'meta_compare' => '>',//change metakey discount_percentage ( Numerical)
    );
    $the_query = new WP_Query( $query );
     $data_bestseller = array();
    if( $the_query->have_posts() ): 
        while( $the_query->have_posts() ) : 
            $the_query->the_post(); 
                $data_bestseller[] = array(
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
    //query for discounted trip
    $query = array(
        'posts_per_page'   => -1,
        'post_type'     => 'trip',
         'meta_key'     => 'discount_percentage', //change metakey discount_percentage ( Numerical)
         'meta_value' => 0,//change metakey discount_percentage ( Numerical)
         'meta_compare' => '>',//change metakey discount_percentage ( Numerical)
    );
    $the_query = new WP_Query( $query );
    global $post;
     $data_discounted = array();
    if( $the_query->have_posts() ): 
        while( $the_query->have_posts() ) : 
            $the_query->the_post(); 
                $data_discounted[] = array(
                    //post defaults
                    'post_title'             => get_the_title(),      
                    'post_id'                => get_the_id(),  
                    'post_content'           => get_the_content(),      
                    'featured_image'         => get_the_post_thumbnail_url(),      
                    'permalink'              => get_the_permalink(),      
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
                    //date
                    'current_date'           => date('Ymd'), //current date or any date
                    'end_date'               => get_field('offer_ends'),
                    //image
                    'front_grid_image'       => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'front-grid' ),
                    'blog_grid_image'        => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-grid' ),
                    );
                endwhile;    
        wp_reset_query(); 
    endif; 


    //query for featured trip
     $query = array(
        'posts_per_page'   => -1,
        'post_type'     => 'trip',
         'meta_key'     => 'featured', //change metakey discount_percentage ( Numerical)
         'meta_value' => 0,//change metakey discount_percentage ( Numerical)
         'meta_compare' => '>',//change metakey discount_percentage ( Numerical)
    );
    $the_query = new WP_Query( $query );
    global $post;
     $data_featured = array();
    if( $the_query->have_posts() ): 
        while( $the_query->have_posts() ) : 
            $the_query->the_post(); 
                $data_featured[] = array(
                    //post defaults
                    'post_title'             => get_the_title(),      
                    'post_id'                => get_the_id(),  
                    'post_content'           => get_the_content(),      
                    'featured_image'         => get_the_post_thumbnail_url(),      
                    'permalink'              => get_the_permalink(),      
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
                    //date
                    'current_date'           => date('Ymd'), //current date or any date
                    'end_date'               => get_field('offer_ends'),
                    //image
                    'front_grid_image'       => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'front-grid' ),
                    'blog_grid_image'        => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-grid' ),
                    );
                endwhile;    
        wp_reset_query(); 
    endif; 


    //query for month trip
    $frontpage_id = get_option( 'page_on_front' );
    $month_posts = get_field('trip_of_month',$frontpage_id);

    //saving post ids for hero slider form frontpage
    if( $month_posts ): 
    $hero_post_id = array();
        foreach( $month_posts as $post): 
            setup_postdata($post);
            $month_post_id[] = $post->ID; 
        endforeach;
        wp_reset_postdata(); 
    endif; 

    $args_month = array(
        'post_type'      => 'trip',
        'posts_per_page' => -1,
        'post__in'       => $month_post_id,
        );
        $the_query = new WP_Query( $args_month );
        global $post;
        $data_month = array();
        if( $the_query->have_posts() ): 
            while( $the_query->have_posts() ) : 
                $the_query->the_post(); 
                    $data_month[] = array(
                        //post defaults
                        'post_title'             => get_the_title(),      
                        'post_id'                => get_the_id(),  
                        'post_content'           => get_the_content(),      
                        'featured_image'         => get_the_post_thumbnail_url(),      
                        'permalink'              => get_the_permalink(),      
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
                        //date
                        'current_date'           => date('Ymd'), //current date or any date
                        'end_date'               => get_field('offer_ends'),
                        //image
                        'front_grid_image'       => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'front-grid' ),
                        'blog_grid_image'        => wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'blog-grid' ),
                        //trip label description

                        );
                    endwhile;    
            wp_reset_query(); 
        endif; 

        //trip label and description relationship
        $trip_label_desc = array(
            'Easy' => get_field('trip_level_easy_description', 'option'),
            'Beginners' => get_field('trip_level_beginners_description', 'option'),
            'Biking Moderate' => get_field('bikes_moderate_trip_level_description', 'option'),
            'Moderate' => get_field('trip_level_moderate_description', 'option'),
            'Demanding' => get_field('trip_level_demanding_description', 'option'),
            'Bike Strenuous' => get_field('bikes_strenuous_trip_level_description', 'option'),
            'Strenuous' => get_field('trip_level_strenuous_description', 'option'),
            'Challenging' => get_field('trip_level_challenging_description', 'option'),
            'Tough' => get_field('trip_level_tough_description', 'option'),
            'Advanced' => get_field('trip_level_advanced_description', 'option'),
            'Advanced Beginners' => get_field('trip_level_advanced_beginners_description', 'option'),
            'Intermediate' => get_field('trip_level_intermediate_description', 'option'),
            'Very Strenuous' => get_field('trip_level_very_strenuous_description', 'option'),
        );

  //lds_travel_trip($trip_data);

    