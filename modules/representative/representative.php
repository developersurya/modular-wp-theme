<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/representative.php for query details
 * ## This module used in header section 
 * @param  $data query data from ACF and wp 
 * 
 */

function lds_travel_representative($data=array()) {

    if ( ! $data ) {
        return false;
    }
    $content = false;
    $section_title = false;
    $trip_data = array();// use?
    $content = apply_filters('the_content', $content);//use?
    extract($data, EXTR_OVERWRITE);//use?

    include('tpl/representative--default.tpl.php');
    
}