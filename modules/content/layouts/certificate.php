<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key are discount_percentage,bestseller,featured
 */

 //fetch and store in variables
 $data = array(
        'ed_trip_advisor'    => get_theme_mod( 'ed_trip_advisor_section' ),
        'trip_advisor_title' => get_theme_mod( 'trip_advisor_title_section' ),
        'trip_advisor_desc'  => get_theme_mod( 'trip_advisor_desc_section' ),
 );

lds_travel_certificate($data);
