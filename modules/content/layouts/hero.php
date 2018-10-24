<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key are discount_percentage,bestseller,featured
 */

//fetch and store in variables

$frontpage_id = get_option( 'page_on_front' );
$posts = get_field('hero_slider',$frontpage_id);

//saving post ids for hero slider form frontpage
if( $posts ): 
$hero_post_id = array();
    foreach( $posts as $post): 
        setup_postdata($post);
        $hero_post_id[] = $post->ID; 
    endforeach;
    wp_reset_postdata(); 
endif; 

$args = array(
    'post_type'      => 'trip',
    'posts_per_page' => -1,
    'post__in'       => $hero_post_id,
    //option for fetching form each of trip posts
    // 'meta_query' => array( 
    //         array(
    //             'key' => 'home_slider',
    //             'value' => '1',
    //             'compare' => '=='
    //         )
    //     )
     );
$posts = new WP_Query($args);
if ($posts) {
    global $post;
    $data_arr  = array();
    $count = 0;
            while ($posts->have_posts()): $posts->the_post();
                //collect all variable as array
                $data_arr[] = array(
                    'count'                 => $count,
                    'current_date'          => date('Ymd'), //current date or any date
                    'image_thumb'           => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image-mobile'),
                    'image_medium'          => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image-tab'),
                    'image'                 => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image'),
                    'title'                 => get_the_title() ,
                    'excerpt'               => get_the_excerpt(),
                    'permalink'             => get_the_permalink(),
                    'days'                  => get_field('days'),
                    'trip_code'             => get_field('trip_code'),
                    'trip_cost'             => get_field('trip_cost'),
                    'max_altitude'          => get_field('max_altitude'),
                    'discount_percentage'   => get_field('discount_percentage'),
                    'trip_level_type'       => get_field("trip_level_type"),
                    'trip_level'            => get_field('trip_level'),
                    'end_date'              => get_field('offer_ends'),
                );
                $count++;
            endwhile;
            wp_reset_postdata();
    }
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

    $data = array(
        'data' => $data_arr,
        'trip_label_desc' => $trip_label_desc
    );
//call function to pass data 
lds_travel_hero($data);