<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key are discount_percentage,bestseller,featured
 */

 //fetch and store in variables
 if( have_rows('header_phone_number', 'option') ):
    $data_array= array();
    while ( have_rows('header_phone_number', 'option') ) : the_row();
        // display a sub field value
        $phone_label = get_sub_field('phone_label');
        $phone = get_sub_field('phone_number');
        $phone_number = preg_replace('/\D/', '', $phone);
        $data[] = array(
            'phone_label'  => $phone_label, 
            'phone_number' => preg_replace('/\D/', '', $phone)
        );
    endwhile; 
endif;

//call function to pass data 
//## Use ONLY for none repeater module
//## Repeater module will include tpl directly.
//lds_travel_phone($data);