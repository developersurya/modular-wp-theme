<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package LDS_Travel
 */
      
get_header();
?>
               
<?php 


/**
 * include module action 'lds_travel_include_module' and 'module name';
 * Important: module folder name (module-name), main php file (module-name.php) and content/layouts/ should have (module-name.php)
 * action registered in custom-function.php
 */
do_action( 'lds_travel_include_module','hero','');

/**
 * include repeater modules
 * include module action 'lds_travel_include_module_multiple' and 'module name';
 * Important: module folder name (module-name), main php file (module-name.php) and content/layouts/ should have (module-name.php)
 * action registered in custom-function.php
 */
 do_action( 'lds_travel_include_module_multiple','trip','bestseller-masonry');
 do_action( 'lds_travel_include_module_multiple','trip','discounted-default');
 do_action( 'lds_travel_include_module_multiple','trip','discounted-list');
 do_action( 'lds_travel_include_module_multiple','trip','featured-default');
 do_action( 'lds_travel_include_module_multiple','trip','featured-list');
 do_action( 'lds_travel_include_module_multiple','trip','month-default');
?>


<section class="about-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <span class="site-name">Ace the Himalaya</span>
                    <!--Display page content of about us by passing page id -->
                    <p>Ace the Himalaya is a trekking and adventure sports agency based in Nepal serving to provide first-class 
                    adventure and holiday experience in the Himalayas. The company was established by Prem K Khatry in early 2006 
                    with rather humble beginnings. Born in a remote village, surrounded by lush forest and an endless chain of hills, 
                    Khatry was inspired to start a career in travelling as a trekking Sherpa then eventually as a guide. With years of 
                    experience and enough know-how of the field, Khatry founded Ace the Himalaya. Since…</p>
                    <!--Display page permalink of about us by passing page id -->
                    <a href="https://www.acethehimalaya.com/company/" class="btn btn-border">
                        READ MORE
                    </a>
                </div>
            
                    <div class="col-lg-5 col-lg-offset-1 text-center">
                        <?php
                        /**
                         * Testimonial Slider 
                         */
                        do_action( 'lds_travel_include_module_multiple','testimonial','slider');
                        ?>
                        <a href="https://www.acethehimalaya.com/company/reviews" class="btn btn-border uppercase">Read all our testimonials</a>
                    </div>
                </div>
        </div>
    </section>

<!--video section -->

<?php do_action( 'lds_travel_include_module','video','default');?>

<!--end of video section -->

<?php 
do_action( 'lds_travel_include_module','certificate','two');

do_action( 'lds_travel_include_module','blog','');
?>

   
<?php 
/**
 * Add general popup module for enquiry form. Buttons need to be added in featured-trip tpl files.
 */
do_action( 'lds_travel_include_module','trip-forms','general-enquiry');
?>
<?php
get_sidebar();
get_footer();
