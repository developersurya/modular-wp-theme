<?php 
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_enqueue_module_scripts(){
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), '1.0', false);
    wp_enqueue_script('module-related-js', MODDIR.'/featured-trip/js/featured-trip-script.js', array('slick-js'), '1.0', false);
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css', false, '1.0');
}
add_action('wp_enqueue_scripts','lds_travel_enqueue_module_scripts');