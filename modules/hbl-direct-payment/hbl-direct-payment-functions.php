<?php
/**
 * Bank tranfer and payment option logic
 * @param   $entry [description]
 * @param   $form  [description]
 * @return [type]  [description]
 */
function after_submission_gravityform_5($entry, $form) {
    //add the entry id form backend
    //Don't forget to off ajax in shortcode. It will break the redirect logic.
    //Aso need to make two pages titled bank-transfer  & payment-form

    if($entry['10'] == "Pay By Card"){
        $url = site_url() . '/direct-payment-process/?bookingID=' . $entry["id"];
    }
    wp_redirect($url);
    exit;
}
add_action('gform_after_submission_5', 'after_submission_gravityform_5', 10, 2);     
 