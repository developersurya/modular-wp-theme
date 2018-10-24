<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/testimonial.php for query details
 * ## This module used in homepage section 
 * @param  $data query data from ACF and wp 
 * 
 */

//##TO prevent multiple function declaration , Use direct tpl include
//##ONLY for repeater module
//include('tpl/testimonial--default.tpl.php');

if($tpl_name){
    include('tpl/testimonial--'.$tpl_name.'.tpl.php');
}else{
    include('tpl/trip--default.tpl.php');
}

// function lds_travel_testimonial($data=array()) {
//     //var_dump($data);
//     if ( ! $data ) {
//         return false;
//     }
//     $content = false;
//     $section_title = false;
//     $trip_data = array();// use?
//     $content = apply_filters('the_content', $content);//use?
//     extract($data, EXTR_OVERWRITE);//use?
// }

