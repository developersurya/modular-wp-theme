<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key 
 */

//fetch and store in variables
 if( have_rows('associated_content', 'option') ){
 while( have_rows('associated_content', 'option') ): the_row();
    $image = get_sub_field('logo');
        $data[] = array(
            'image_logo'      => get_sub_field('logo'),
            'link'       => get_sub_field('link'), 
            'image_url'  => $image['url'],
            'image_alt'  => $image['alt']
        ); 
        endwhile; 
  } 

  lds_travel_associate($data);