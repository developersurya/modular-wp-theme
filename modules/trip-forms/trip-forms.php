<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/discouted-trip.php for query details
 * ## This module can be replicate to form #feature-trip, #bestsellar and other wp default post listing (e.g. latest,ordering) modules
 * @param  $data query data from ACF and wp 
 * 
 */
function lds_travel_trip_forms($data=array(),$tpl_name) {
    
    // if ( ! $data ) {
    //     return false;
    // }
    $content = false;
    $section_title = false;
    $trip_data = array();// use?
    $content = apply_filters('the_content', $content);//use?
    extract($data, EXTR_OVERWRITE);//use?

    //include('tpl/trip-forms--default.tpl.php');
    if($tpl_name){
        include('tpl/trip-forms--'.$tpl_name.'.tpl.php');
    }else{
        include('tpl/trip-forms--booking-form.tpl.php');
    }
    
}
//include tpl name to get specific tpl layout
//$data = false if we do not have to pass any data
//lds_travel_trip_forms($data=false,$tpl_name);