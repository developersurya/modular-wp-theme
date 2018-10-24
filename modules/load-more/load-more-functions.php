<?php 
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * Add related custom functions 
 * @return [type] [description]
 */

 function lds_travel_load_more_scripts(){
    global $wp_query; 
 
	// In most cases it is already included on the page and this line can be removed
	wp_enqueue_script('jquery');
 
	// register our main script but do not enqueue it yet
	wp_register_script( 'lds_travel_loadmore', get_stylesheet_directory_uri() . '/modules/load-more/js/load-more.js', array('jquery') );
 
	// now the most interesting part
	// we have to pass parameters to lds-travel-load-more.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
	wp_localize_script( 'lds_travel_loadmore', 'lds_travel_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX.
        'post_type' => 'testimonial',
        'taxonomy' => 'testimonial-category',
        'taxonomy_terms' => 'general',
        'posts_per_page' => 1 //change here for number of post per click

		//'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		//'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		//'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'lds_travel_loadmore' );
 }
add_action( 'wp_enqueue_scripts', 'lds_travel_load_more_scripts' );

function lds_travel_total_post($taxonomy_term){
    // prepare our arguments for the query
	$post_type = $_POST['post_type'];
	$taxonomy = $_POST['taxonomy'];
	$taxonomy_terms = $_POST['taxonomy_terms'];
    $posts_per_page = (int)$_POST['posts_per_page'];
    $increment = (int)$_POST['increment'];
    $increament_post = $increment*$posts_per_page;

    $args  = array(
        'post_type'  => $post_type,
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $taxonomy_terms ,
            ),
        ),
    );
    //debugger($args);
	// it is always better to use WP_Query but not here
    $query = new WP_Query($args);
    if( $query->have_posts() ) {
        $countPosts = $query->post_count;
    }
    return $countPosts;
}

function lds_travel_loadmore_ajax_handler(){
	// prepare our arguments for the query
	$post_type = $_POST['post_type'];
	$taxonomy = $_POST['taxonomy'];
	$taxonomy_terms = $_POST['taxonomy_terms'];
    $posts_per_page = (int)$_POST['posts_per_page'];
    $increment = (int)$_POST['increment'];
    $increament_post = $increment*$posts_per_page;
    $total_posts = lds_travel_total_post($taxonomy_terms);
    $args  = array(
        'post_type'  => $post_type,
        'posts_per_page' => $increament_post,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'slug',
                'terms'    => $taxonomy_terms ,
            ),
        ),
    );
    //debugger($args);
	// it is always better to use WP_Query but not here
    $query = new WP_Query($args);
    if( $query->have_posts() ) :?>
        <div id="total_posts" style="display:none"><?php echo $total_posts;?></div>
        <?php
        // run the loop
        while( $query->have_posts() ): $query->the_post();
        $featured_testimonial  = get_field('featured_testimonial');
        $testimony_name        = get_field('testimony_name');
        $overall_ratings       = get_field('overall_ratings');
        $country               = get_field('country');
        $address               = get_field('address');
        $trip_name             = get_field('trip_name');
        if($overall_ratings == 'Five'){
            $av_rating_numb = '5';
            $av_rating_msg = 'Excellent';
        }
        if($overall_ratings == 'Four'){
            $av_rating_numb = '4';
            $av_rating_msg = 'Good';
        }
        if($overall_ratings == 'Three'){
            $av_rating_numb = '3';
            $av_rating_msg = 'Average';
        }
        if($overall_ratings == 'Two'){
            $av_rating_numb = '2';
            $av_rating_msg = 'Poor';
        }
        if($overall_ratings == 'One'){
            $av_rating_numb = '1';
            $av_rating_msg = 'Very Poor';
        }
        ?>
             <div class="clearfix mrgn-btm-3">
             <div class="col-md-12">
                 <div class="title-part">
     
                     <h4><?php echo $testimony_name;?></h4>
                     <div class="rating-list <?php echo $av_rating_numb;?>">
                         <ul class="Five">
                             <li class="icon-star-outline  icon-star star-one"></li>
                             <li class="icon-star-outline  icon-star star-two"></li>
                             <li class="icon-star-outline  icon-star star-three"></li>
                             <li class="icon-star-outline  icon-star star-four"></li>
                             <li class="icon-star-outline  icon-star star-five"></li>
                         </ul>
                     </div>
                     <span class="rating-msg"><?php echo $av_rating_numb;?> - <?php echo $av_rating_msg;?></span>
                     <div>
                         <span class="author-address">
                         <?php echo $address;?>
                         <?php echo $country;?>
                         </span>
                         <span class="post-date"><?php echo the_date();?></span>
                     </div>
                     <img src="https://www.acethehimalaya.com/wp-content/themes/acethehimalaya/images/avatar.jpg" alt="avatar">
                 </div>
             </div>
             <div class="col-md-12">
                 <div class="content-box">
                     <h5><?php echo $trip_name;?></h5>
                     <div class="rating-list">
                     </div><!-- .rating-list -->
                     <p><?php the_content();?></p>
                 </div><!-- .content-box -->
             </div>
         </div>
         <?php
 
		endwhile;
 
    endif;
    
	die; // here we exit the script and even no wp_reset_query() required!
}
add_action('wp_ajax_loadmore', 'lds_travel_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'lds_travel_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}cc