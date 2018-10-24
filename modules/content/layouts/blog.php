<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key 
 */

//fetch and store in variables

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    //option for fetching from metakey or category 
     );
$posts = new WP_Query($args);
if ($posts) {
    global $post;
    $data  = array();
    $count = 0;
            while ($posts->have_posts()): $posts->the_post();
                //collect all variable as array
                if(get_the_category_list()) {
                    $category = ' under ' . get_the_category_list(__(', ', 'acethehimalaya')) ;
                }
                $data[] = array(
                    'count'                 => $count,
                    'posted_date'           => get_the_time(' F jS, Y'), // date or any date
                    'image_thumb'           => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog-grid'),
                    'image'                 => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'),
                    'post_title'            => get_the_title() ,
                    'excerpt'               => get_the_excerpt(),
                    'post_content'          => get_the_content(),
                    'permalink'             => get_the_permalink(),
                    'category'              => $category
                );
                $count++;
            endwhile;
            wp_reset_postdata();
    }
    //call function for single load module
    lds_travel_blog($data);