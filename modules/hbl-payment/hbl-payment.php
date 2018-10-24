<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/hbl-payment.php for query details
 * @param  $data query data from ACF and wp 
 * 
 */
function lds_travel_hbl_payment($data=array(),$bookingId) {
    
    if ( ! $data ) {
        return false;
    }
    $content = false;
    $section_title = false;
    $trip_data = array();// use?
    $content = apply_filters('the_content', $content);//use?
    extract($data, EXTR_OVERWRITE);//use?

    /**
     * ## We have used page template instead of tpl.So, NO need to include here
     * ## Make three pages titled payment-form, bank-transfer
     */
    //include('page-templates/page-template-bank-transfer.php');
    //include('page-templates/page-template-bank-transfer.php');
    // if($tpl_name){
    //     //include('page-templates/page-template-bank-transfer.php');
    //     //include('tpl/trip-forms--'.$tpl_name.'.tpl.php');
    // }else{
    //     //include('tpl/trip-forms--booking-form.tpl.php');
    // }
    
}