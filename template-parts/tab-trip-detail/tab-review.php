<?php
//$post_id = $_POST['post_id'];
$post_id = get_the_ID();
$post_data = get_post($post->post_parent);
//debugger($post_data->post_name,false);
?>

<div>
    <?php if(get_field('review_tab_description','options')){ ?><p class="intro-text"><?php echo get_field('review_tab_description','options'); ?></p> <?php } ?>
    <a href="#share-story-form" class="fancybox"><strong>Share your story with us.</strong></a>

       <div id="share-story-form" style="display:none; max-width:900px;"><?php echo do_shortcode('[gravityform id="13" title="true" description="false" ajax="true" tabindex="23"]'); ?></div>
</div>

<div class="review-wrap">
    <?php
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'testimonial-category',
                'field' => 'slug',
                'terms' => $post_data->post_name,
            ),
        ),
    );
    $loop = new WP_Query($args);
    if($loop->have_posts()) {
        do_action( 'lds_travel_include_module_multiple','load-more','dynamic'); 
        //echo do_shortcode('[ajax_load_more post_type="testimonial" taxonomy="testimonial-category" taxonomy_terms="' . $post_data->post_name . '" taxonomy_operator="IN" posts_per_page="1" scroll="false" button_label="LOAD MORE REVIEWS" repeater="template_6"]');
                ?>
                <?php
    } else {
        do_action( 'lds_travel_include_module_multiple','load-more','default');

        //echo do_shortcode('[ajax_load_more post_type="testimonial" taxonomy="testimonial-category" taxonomy_terms="general" taxonomy_operator="IN" posts_per_page="6" scroll="false" button_label="LOAD MORE REVIEWS" repeater="template_6"]');
    } 
   
    ?>
</div>


