<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/brand.php for query details
 * ## This module used in header section 
 * @param  $data query data from ACF and wp 
 * 
 */
//var_dump($data);

include('tpl/brand--default.tpl.php');

// function lds_travel_brand($data=array()) {

//     if ( ! $data ) {
//         return false;
//     }
//     $content = false;
//     $section_title = false;
//     $trip_data = array();// use?
//     $content = apply_filters('the_content', $content);//use?
//     extract($data, EXTR_OVERWRITE);//use?

//     include('tpl/brand--default.tpl.php');
    
// }

// class Brand{

//     public function lds_travel_getdata_brand($data){
//         $data = $this->$data;
//     }

//     public  function lds_travel_brand($data=array()) {

//         if ( ! $data ) {
//             return false;
//         }
//         $content = false;
//         $section_title = false;
//         $trip_data = array();// use?
//         $content = apply_filters('the_content', $content);//use?
//         extract($data, EXTR_OVERWRITE);//use?
//         return $data;

//     }

//     public function lds_travel_brand_tpl(){
//         $data = $this->lds_travel_getdata_brand();
//         include('tpl/brand--default.tpl.php');
//     }

// }


