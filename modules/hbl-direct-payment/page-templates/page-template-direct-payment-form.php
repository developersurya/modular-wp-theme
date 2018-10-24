<?php
/**
 * 
 * Template Name: Direct Payment Form
 * The template for displaying trip booking form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LDS_Travel
 */

get_header();
//include content file here.
// Page template does not support include method like tpl.
include( lds_travel_get_stylesheet_path().'/modules/content/layouts/hbl-direct-payment.php');
?>

<div class="container">
    <div class="row">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
            <div class="container">
                <div class="row  contact-us">
                    <div class="col-lg-12">
                        <?php
                        if (have_posts()) {
                            while (have_posts()) {
                                the_post();
                        ?>
                        <div class="header-block centered-form">
                            <h1 class="page-heading"><?php the_title(); ?></h1>
                            <?php
                                the_content();
                            ?>
                            <br/>
                            <?php echo do_shortcode('[gravityform id=5 title=false description=false ajax=false tabindex=49]');?>
                        </div>
                        <?php
                            } // end while
                        } // end if
                        ?>
                    </div>
                </div>
            </div>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>
<script>
		$(document).ready(function(){
			$('#gform_submit_button_4').val('Pay By Card');
		});
	</script>
<?php

get_sidebar();
get_footer();