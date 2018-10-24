<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/load-more.php for query details
 * ## This module used in homepage section 
 * @param  $data query data from ACF and wp 
 * 
 */

//##TO prevent multiple function declaration , Use direct tpl include
//##ONLY for repeater module
//include('tpl/load-more--default.tpl.php');


if($tpl_name){
    include('tpl/load-more--'.$tpl_name.'.tpl.php');
}else{
    include('tpl/load-more--dynamic.tpl.php');
}

// function lds_travel_loadmore($data=array()) {
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

