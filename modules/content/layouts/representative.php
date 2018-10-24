<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available only for trip  
 */

//fetch and store in variables
//assuming we are in single trip page
$trip_id = get_the_ID();
$hide_representative = get_field('hide_representative', $trip_id);
$choose_representative = get_field('choose_representative', $trip_id);
$data  = array();
if($hide_representative == "No"){
    if($choose_representative){
        foreach($choose_representative as $representative){
            $post_info  = get_post( $representative);
            $data[] = array(
                'featured_img'  => get_the_post_thumbnail_url($representative,'full'), 
                'post_title'    => $post_info->post_title,
                'post_content'  => $post_info->post_content,
            );
        }
    }
}
//call function for single load module
lds_travel_representative($data); 