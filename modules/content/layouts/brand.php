<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key are discount_percentage,bestseller,featured
 */

 //fetch and store in variables
$site_logo = get_field('site_logo', 'option'); 
$ace_slogan = get_field('ace_slogan', 'option'); 

//collect all variable as array
$data = array(
    'site_logo'  => $site_logo['url'], 
    'ace_slogan' => $ace_slogan['url']
);

//call function to pass data 
//## Use ONLY for none repeater module
//## Repeater module will include tpl directly.
//lds_travel_brand($data);