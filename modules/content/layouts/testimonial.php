<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key 
 */

//fetch and store in variables

//$post_id = $_POST['post_id'];
global $post;
$post_data = get_post(get_the_ID()); 
$slug = $post_data->post_name;

$data = array();
//for specific post rating calculation
$arg=array(
    'post_type' => 'testimonial',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'testimonial-category',
            'field' => 'slug',
            'terms' => $slug,
        ),
    ),
);
$query = new WP_Query($arg);
$rating_arr = array();
    if($query->have_posts()):while($query->have_posts()):$query->the_post();
        $ratings = get_field('overall_ratings');
    
            switch ($ratings) {
                case "Five":
                    $rating_number = 5;
                    break;
                case "Four":
                    $rating_number = 4;
                    break;
                case "Three":
                    $rating_number = 3;
                    break;
                case "Two":
                    $rating_number = 2;
                    break;
                case "One":
                    $rating_number = 1;
                    break;
                default:
                    $rating_number = 0;
            }
            $rating_arr[] = $rating_number;
            endwhile;
        wp_reset_postdata();
    endif;
    $num_rating = count($rating_arr);
    if(count($rating_arr) !=0){
        $av_rating =  round((array_sum($rating_arr))/(count($rating_arr)));
        //echo "<br/>Total review:".$num_rating ;
    // echo "<br/>Total average review:".$av_rating;
        if($av_rating == 5){
            $av_rating_text = 'Five';
            $av_rating_msg = 'Excellent';
        }
        if($av_rating == 4){
            $av_rating_text = 'Four';
            $av_rating_msg = 'Good';
        }
        if($av_rating == 3){
            $av_rating_text = 'Three';
            $av_rating_msg = 'Average';
        }
        if($av_rating == 2){
            $av_rating_text = 'Two';
            $av_rating_msg = 'Poor';
        }
        if($av_rating == 1){
            $av_rating_text = 'One';
            $av_rating_msg = 'Very Poor';
        }
      
       
}else{

    //for general rating calculations
    $arg=array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'slug',
                'terms' => 'general',
            ),
        ),
    );
    $query = new WP_Query($arg);
   
    $rating_arr = array();
    if($query->have_posts()):while($query->have_posts()):$query->the_post();
        $ratings = get_field('overall_ratings');
        
        switch ($ratings) {
            case "Five":
                $rating_number = 5;
                break;
            case "Four":
                $rating_number = 4;
                break;
            case "Three":
                $rating_number = 3;
                break;
            case "Two":
                $rating_number = 2;
                break;
            case "One":
                $rating_number = 1;
                break;
            default:
                $rating_number = 0;
        }
        $rating_arr[] = $rating_number;
    endwhile;
        wp_reset_postdata();
    endif;
    $num_rating = count($rating_arr);
    if(count($rating_arr)>0){
        $av_rating =  round((array_sum($rating_arr))/(count($rating_arr)));
    }
    //echo "<br/>Total review:".$num_rating ;
    //echo "<br/>Total average review:".$av_rating;
    $av_rating_text = "";
    $av_rating      = "";
    $av_rating_msg  = "";
    if($av_rating == 5){
        $av_rating_text = 'Five';
        $av_rating_msg = 'Excellent';
    }
    if($av_rating == 4){
        $av_rating_text = 'Four';
        $av_rating_msg = 'Good';
    }
    if($av_rating == 3){
        $av_rating_text = 'Three';
        $av_rating_msg = 'Average';
    }
    if($av_rating == 2){
        $av_rating_text = 'Two';
        $av_rating_msg = 'Poor';
    }
    if($av_rating == 1){
        $av_rating_text = 'One';
        $av_rating_msg = 'Very Poor';
    }
   
}



/**
 * Query for testimonial list
 */
$args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
     );
$query = new WP_Query($args);
if ($query) {
    global $post;
    $data_testimonial  = array();
            while ($query->have_posts()): $query->the_post();
                //collect all variable as array only if it is featured testimonial
                if(get_field('featured_testimonial') == true){
                    $data_testimonial[] = array(
                        'image_thumb'           => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image-mobile'),
                        'image_medium'          => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image-tab'),
                        'image'                 => wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'banner-image'),
                        'title'                 => get_the_title() ,
                        'excerpt'               => get_the_excerpt(),
                        'permalink'             => get_the_permalink(),
                        'featured_testimonial'  => get_field('featured_testimonial'),
                        'testimony_name'        => get_field('testimony_name'),
                        'overall_ratings'       => get_field('overall_ratings'),
                        'country'               => get_field('country'),
                        'address'               => get_field('address'),
                    );
                }
            endwhile;
            wp_reset_postdata();
    }


//pass  the data 
$data =array(
    'av_rating_text'    => $av_rating_text,
    'av_rating'         => $av_rating,
    'av_rating_msg'     => $av_rating_msg,
    'num_rating'        => $num_rating,
    'data_testimonial'  => $data_testimonial
);
//var_dump($data);
//lds_travel_testimonial($data);