<?php 
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_enqueue_forms_module_scripts(){
     wp_enqueue_script('trip-forms', MODDIR.'/trip-forms/js/trip-forms-script.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('module-related-js', MODDIR.'/featured-trip/js/featured-trip-script.js', array('slick-js'), '1.0', false);
    // wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css', false, '1.0');
}
add_action('wp_enqueue_scripts','lds_travel_enqueue_forms_module_scripts');


function booking_form_trip_title($value){
    if (class_exists('Trip_Form_Data')) {
        $trip_data = new Trip_Form_Data();
        $trip_title = $trip_data->get_trip_title();
    }
    return $trip_title;
}
add_filter('gform_field_value_booking_form_trip_title', 'booking_form_trip_title');


function calculated_price($value){
    if (class_exists('Trip_Form_Data')) {
        $trip_data = new Trip_Form_Data();
        $trip_id = $trip_data->get_trip_id();
    }
    //get the trip costs
    return get_field('trip_cost',$trip_id);
}
add_filter('gform_field_value_calculated_price', 'calculated_price');


/**
 * pre-populating dropdown list for departure date formID 6
 * ##IMPORTANT: Change the form ID as require
 */
add_filter( 'gform_pre_render_6', 'populate_posts' );
add_filter( 'gform_pre_validation_6', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_6', 'populate_posts' );
add_filter( 'gform_admin_pre_render_6', 'populate_posts' );

function populate_posts( $form) {
    if ( !is_admin() ){
        if (class_exists('Trip_Form_Data')) {
            //get the trip data form class
            $trip_data = new Trip_Form_Data();
            $trip_id = $trip_data->get_trip_id();
            $trip_url_date = $trip_data->get_trip_url_date();
            $trip_url_pax = $trip_data->get_trip_url_pax();
            $trip_departure_data = $trip_data->get_repeater_data();

                foreach ($form['fields'] as &$field) {

                if ($field->id == 20) {


                    $choices = array();

                    if(empty($trip_url_date)){
                        foreach($trip_departure_data as $data){

                            $choices[] = array('text' => $data['start_date__end_date'], 'value' => $data['start_date__end_date']);

                        }
                    }else{

                        $choices[] = array('text' =>$trip_url_date, 'value' =>$trip_url_date);

                    }

                    $field->choices = $choices;
                }

            }
        }
    }
   


    return $form;
}
//http://ldstravel.local/trip-booking/?tid=435&d=06/08/2018%20-%2006/19/2018&px=2
