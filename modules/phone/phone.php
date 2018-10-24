<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/phone.php for query details
 * ## This module used in header section 
 * @param  $data query data from ACF and wp 
 * 
 */

//##TO prevent multiple function declaration , Use direct tpl include
//##ONLY for repeater module
if($tpl_name){
    include('tpl/phone--'.$tpl_name.'.tpl.php');
}else{
    include('tpl/phone--default.tpl.php');
}


// function lds_travel_phone($data=array()) {

//     if ( ! $data ) {
//         return false;
//     }
//     $content = false;
//     $section_title = false;
//     $trip_data = array();// use?
//     $content = apply_filters('the_content', $content);//use?
//     extract($data, EXTR_OVERWRITE);//use?

//     include('tpl/phone--default.tpl.php');
    
// }

