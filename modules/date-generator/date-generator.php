<?php
/**
 * This file work as controller to link tpl and content file.
 * Date generator will create departure dates with ACF fields 
 * # Check the acf-date-generator-functions.php for functions and query details
 * ## This module should be call in function files, NOT in template file.
 * @param  $data query data from ACF and wp 
 * 
 */
function lds_travel_acf_date_generator($args=array()) {
    // Functional module does not have any view part. We  will not include any tpl here.
    // if ( ! $args ) {
    //     return false;
    // }
    // $content = false;
    // $section_title = false;
    // $trip_args = array();// use?
    // $content = apply_filters('the_content', $content);//use?
    // extract($args, EXTR_OVERWRITE);//use?

    //include('tpl/featured-trip--default.tpl.php');
    
}   //date-generator fucnction are directly called in custom-functions.php file. We do NOT need to include here.
    //include main functions
    //include('acf-date-generator-functions.php');

