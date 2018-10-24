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

<div class="container">
    <div class="row">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
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


            
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>

<?php
get_sidebar();
get_footer();