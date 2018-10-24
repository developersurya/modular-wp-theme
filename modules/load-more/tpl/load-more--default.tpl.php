<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//if ($data) {
//IMPORTANT: To make the load more re usable for any post type. We need to change the post_type,post_per_page and tax_query. 
//We also need to change same arguments in load-more-functions.php 
//We need to change data-term for static taxonomy.
?>
<div class="ajax-load-more review-wrap">
    <?php 
    //change query as required
    $args  = array(
        'post_type'  => 'testimonial',
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'testimonial-category',
                'field'    => 'slug',
                'terms'    => 'general',
            ),
        ),
    );
    //debugger($args);
	// it is always better to use WP_Query but not here
    $query = new WP_Query($args);
    if( $query->have_posts() ) :
        
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
 
    endif;?>
</div>
<div class="lds_travel_loadmore btn btn-border uppercase" data-term="general">LOAD MORE REVIEWS</div>

<?php
//}
?>