<?php 
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_enqueue_video_module_scripts(){
     wp_enqueue_script('video', MODDIR.'/video/js/video-script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts','lds_travel_enqueue_video_module_scripts');