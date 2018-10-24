<?php
/**
 * This file work as controller to link tpl and content file.
 * Departure Dates will create departure dates in frontend with shortcode. 
 * # Check the acf-date-generator-functions.php for functions and query details
 * ## This module should be call in function files, NOT in template file.
 * @param  $data query data from ACF and wp 
 * 
 */
function lds_travel_departure_dates($args=array()) {
    if ( ! $args ) {
        return false;
    }
    $content = false;
    $section_title = false;
    $trip_args = array();// use?
    $content = apply_filters('the_content', $content);//use?
    extract($args, EXTR_OVERWRITE);//use?
    //var_dump($args);

    include('tpl/departure-dates--default.tpl.php');
    
}   
