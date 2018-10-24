<?php
/**
 * 
 * Template Name: Trip booking
 * The template for displaying trip booking form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LDS_Travel
 */
get_header();
?>

<?php if (has_post_thumbnail()) {
	$image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image-mobile');
	$image_medium = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image-tab');
	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image');
	?>
    <figure class="hero-image style1">
        <picture>
            <!--[if IE 9]>
            <video style="display: none;"><![endif]-->
            <source srcset="<?php echo $image[0]; ?>" media="(min-width: 1200px)">
            <source srcset="<?php echo $image_medium[0]; ?>"
                    media="(min-width: 768px)">
            <source srcset="<?php echo $image_thumb[0]; ?>"
                    media="(min-width: 320px)">
            <!--[if IE 9]></video><![endif]-->
            <img srcset="<?php echo $image[0]; ?>"
                 alt="<?php the_title();?>">
        </picture>
    </figure>
<?php }?>
        
    <!--trip booking form-->
        <?php 
        // Include trip booking module with hbl payment options
        // It will use gravity form with ID #3
        //do_action( 'lds_travel_include_module','trip-forms','hbl-booking-form');


        // Include trip booking module with hbl payment options
        // It will use gravity form with ID #2
        do_action( 'lds_travel_include_module','trip-forms','hbl-booking-form');
            

        // Include booking form directly form gravity form without any module
        //echo do_shortcode('[gravityform id=3 title=false description=false ajax=true tabindex=49]');

        ?>

    <!--/trip booking form-->
         
<?php
get_sidebar();
get_footer();