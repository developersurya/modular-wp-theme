<?php 
//query url for booking id
$data = false;
$bookingId = false;
$url = $_SERVER['QUERY_STRING'];
$url_arr = explode('bookingID=', $url);
$bank_account_detail = get_field('bank_account_details', 'option');
$bank_tranfer_user_notification = get_field('bank_tranfer_user_notification', 'option');
if(isset($url_arr[1])){
    $bookingId = $url_arr[1];
}
if($bookingId){
  $bookingData = GFAPI::get_entry( $bookingId );

    if($bookingData['form_id'] == 6){ //change form ID if require
        $data = array(
        'bookingId'          => $bookingId,
        'user_name'          => $bookingData['4'],
        'trip_name'          => $bookingData['1'],
        'trip_date_imp'      => $bookingData['20'],
        'trip_date_extra'    => $bookingData['7'],
        'trip_email'         => $bookingData['12'],
        'trip_country'       => $bookingData['8'],
        'trip_pax'           => $bookingData['15'],
        'trip_paymethod'     => $bookingData['18'],
        'trip_calprice'      => $bookingData['13'],
        'trip_email'         => $bookingData['21'],
        'bank_tranfer_user_notification'         => $bank_tranfer_user_notification,
        'bank_tranfer_admin_notification'         => get_field('bank_tranfer_admin_notification', 'option'),
        'bank_account_detail'         => $bank_account_detail,
        );
    }
}

lds_travel_hbl_payment($data,$bookingId);

