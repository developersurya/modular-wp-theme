<?php
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_hero_scripts() {
    
    wp_enqueue_script('lds-travel-hero-script', get_template_directory_uri() . '/modules/hero/js/hero-script.js', array('jquery'), true);
   
    //wp_enqueue_script('daterangepicker-css',  'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');
    
}
add_action('wp_enqueue_scripts', 'lds_travel_hero_scripts');
