<?php 
/**
 * This file work as data modal.
 * Contains video related query and variables.
 * #Available for any page by settings up in ACF
 */

 //fetch and store in variables
 if(get_field('youtube_video_id')){
    $video_img = get_field('youtube_video_image');
    
    get_field('video_section_title');
    get_field('youtube_video_description');
    get_field('youtube_video_id');
    $data = array(
        'video_img'                   => $video_img['url'],
        'video_section_title'         => get_field('video_section_title'),
        'youtube_video_description'   => get_field('youtube_video_description'),
        'youtube_video_id'            => get_field('youtube_video_id'),
    );

 }
//call function to pass data 
//## Use ONLY for none repeater module
//## Repeater module will include tpl directly.
lds_travel_video($data);