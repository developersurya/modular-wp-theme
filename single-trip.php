<?php
    session_start();
    session_destroy();
    $_SESSION['slug-name'] ="";
    $_SESSION['trip_slug'] ="";

    get_header();
    $pid = get_the_ID();
    $post_id = get_the_ID();
    //var_dump($post_id);
    $current_date = date('Ymd'); //current date or any date
?>

    <div class="hero">

        <?php if(get_field('youtube_video_id')){ ?>
            <div class="video-container">
                <div class="video-poster" style="background: url(https://img.youtube.com/vi/<?php echo get_field('youtube_video_id'); ?>/maxresdefault.jpg) no-repeat center center; background-size: cover;"></div>
                <div id="module-video" class="module-video"></div>
                <div class="video-content">
                    <?php if(get_field('video_section_title')){ ?><h2><?php echo get_field('video_section_title'); ?></h2><?php } ?>
                    <?php if(get_field('youtube_video_description')){ ?><p><?php echo get_field('youtube_video_description'); ?></p><?php } ?>
                    <a href="https://www.youtube.com/embed/<?php echo get_field('youtube_video_id'); ?>?autoplay=1" class="fancybox-video">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="play-button"><g fill="#FFFFFF"><path d="M10 0C4.5 0 0 4.5 0 10 0 15.5 4.5 20 10 20 15.5 20 20 15.5 20 10 20 4.5 15.5 0 10 0L10 0ZM8 14.5L8 5.5 14 10 8 14.5 8 14.5Z"/></g></svg>
                    </a>
                </div>
            </div>
            <script>
                jQuery('#module-video').YTPlayer({
                    fitToBackground: false,
                    videoId: '<?php echo get_field('youtube_video_id'); ?>',
                    pauseOnScroll: false,
                    playerVars: {
                        modestbranding: 0,
                        autoplay: 1,
                        showinfo: 0,
                        branding: 0,
                        autohide: 0
                    }
                });
            </script>
        <?php }else{
        if (has_post_thumbnail()) {
        $image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image-mobile');
        $image_medium = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image-tab');
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'banner-image');
        ?>
            <figure
                class="hero-image style1">
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
                         alt="<?php the_title(); ?>">
                </picture>
            </figure>
            <?php
        } else { ?>
                <figure class="hero-image">
                    <img class="img-responsive"
                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider-placeholder.png"
                         alt="slide placeholder">
                </figure>
            <?php }
        } ?>


        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1><?php the_title(); ?></h1>
                    <div class="hero--short-desc">
                        <?php
                           // global $post;
                            //$excerpt = apply_filters('the_content', $post->post_content);
                            if (has_excerpt()) {
                                echo get_the_excerpt() ;
                            } else {
                                echo wp_trim_words( get_the_excerpt(), 35, $more = '' ) ;
                            }
                        ?>
                    </div>
                </div><!-- .col-lg-8 -->
                <div class="col-lg-4">
                </div><!-- .col-lg-4 -->
            </div>
        </div><!--container-->
    </div><!--hero-->
    <div id="trip-container" class="trip-tab">
          <div class="trip-tab--heading">
                <div class="container">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-lg-push-10 col-md-push-10">
                        <div class="row">
                            <div class="relative-holder initial-hide">

                                 <!--Show price div only if it contain price-->
                                <?php  $cost = get_field("trip_cost");
                                if(!empty($cost)){?>
                                     <a href="<?php echo site_url();?>/trip-booking/?tid=<?php echo get_the_ID();?>" class="btn btn-success">BOOK NOW</a>
                                    <?php }else{?>
                                        <?php 
                                        /**
                                         * Add general popup module for enquiry form. Buttons need to be added in featured-trip tpl files.
                                         */
                                        do_action( 'lds_travel_include_module','trip-forms','general-enquiry');
                                        ?>
                                        <!-- <div class="button-widget extra-button-widget">
                                            <a href="#enquiry-popup-form" class="fancybox enq-without-date btn btn-blue" data-title="<?php the_title(); ?>"><strong>INQUIRE NOW</strong></a>
                                       </div> -->
                                    <?php } ?>


                                <?php
                                $phone = get_field('main_phone_number', 'option');
                                $phone_number = preg_replace('/\D/', '', $phone); ?>
                                <a class="quick-contact-main" href="tel:<?php echo $phone_number; ?>"><span
                                        class="icon-phone"></span></a>
                            </div><!-- .relative-holder -->
                        </div><!-- .row -->
                    </div>

                    <!--tab links-->
                    <ul class="nav nav-tabs col-lg-9 col-md-10 col-sm-12 col-lg-pull-2 col-md-pull-2 hidden-print" id="ajax-tab">
                        <li class="active">
                            <a href="#tab-overview" class="tab-overview" title="At a glance">
                                <div class="icon-overview"></div>
                                <span class="tab-title">Overview</span></a>
                        </li>
                        <?php if (have_rows('day_to_day_itinerary',$pid)) { ?>
                            <li class="">
                                <a href="#tab-itinerary" class="tab-itinerary" title="The day-by-day plan">
                                    <div class="icon-itinerary"></div>
                                    <span class="tab-title">Itinerary</span></a>
                            </li>
                            
                        <?php }
                        if (    have_rows('small_group_journey',$pid) ||
                            have_rows('group_size_info',$pid) ||
                            get_field('date_description', $pid) ||
                            get_field('small_group', $pid) ||
                            get_field('private_journey', $pid) ||
                            get_field('tailor_made_journey', $pid)

                        )  { ?>
                            <li class="">
                                <a href="#tab-dates" class="tab-dates" title="Price and trip availability dates">
                                    <div class="icon-dates"></div>
                                    <span class="tab-title">Departure</span></a>
                            </li>
                        <?php }
                        if ( have_rows('cost_includes', $pid) || have_rows('not_include',$pid)  || get_field('include_description',$pid)  || get_field('excludes',$pid) ) {
                            ?>
                            <li class="">
                                <a href="#tab-included" class="tab-included" title="What the price covers">
                                    <div class="icon-included"></div>
                                    <span class="tab-title">Included</span></a>
                            </li>
                            <?php
                        }
                        if (get_field('equipment_main_description', $pid) ||
                            have_rows('equipment_description', $pid) ||
                            get_field('equipment_extra_description', $pid)
                        ) {
                            ?>
                            <li class="">
                                <a href="#tab-equipment" class="tab-equipment" title="What to bring with you">
                                    <div class="icon-equipment"></div>
                                    <span class="tab-title">Equipment</span></a>
                            </li>
                            <?php
                        }
                        if(get_field("gallery_id", $pid) || have_rows('videos_upload', $pid)) {
                            ?>
                            <li class="">
                                <a href="#tab-gallery" class="tab-gallery" title="Visual records of the trip">
                                    <div class="icon-gallery"></div>
                                    <span class="tab-title">Gallery</span></a>
                            </li>
                            <?php
                        }
                        if (have_rows('faqs_list', $pid)): ?>
                            <li class="">
                                <a href="#tab-faq" class="tab-faq" title="Get your queries answered">
                                    <div class="icon-faqs"></div>
                                    <span class="tab-title">FAQs</span></a>
                            </li>
                        <?php endif; ?>

                    </ul>
                    <!--end of tab links-->

                </div>
            </div><!-- .trip-tab--heading -->

          <div class="container">
            <div class="row">

                <!--include tabs -->
                <div class="col-lg-8">
                    <div class="tab-content clearfix">
                        <div id="tab-overview" class="tab-pane fade in active">
                            <?php
                            include(get_template_directory() . '/template-parts/tab-trip-detail/tab-overview.php');
                            ?>
                        </div>
                       
                        <?php if (have_rows('day_to_day_itinerary',$pid)) { ?>
                            <div id="tab-itinerary" class="tab-pane fade itinerary">
                                <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-itinerary.php'); ?>
                            </div>
                            
                        <?php }
                        if (have_rows('small_group_journey',$pid) ||
                            have_rows('group_size_info',$pid) ||
                            get_field('date_description', $pid) ||
                            get_field('small_group', $pid) ||
                            get_field('private_journey', $pid) ||
                            get_field('tailor_made_journey', $pid)

                        )  {

                            ?>
                            <div id="tab-dates" class="tab-pane fade">
                                <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-dates.php'); ?>
                            </div>
                        <?php } ?>
                        <div id="tab-included" class="tab-pane fade ">
                            <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-included.php'); ?>
                        </div>
                        <?php
                        if (get_field('equipment_main_description', $pid) || have_rows('equipment_description', $pid) || get_field('equipment_extra_description', $pid)) {
                            ?>
                            <div id="tab-equipment" class="tab-pane fade">
                                <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-equipment.php'); ?>
                            </div>
                            <?php
                        }
                        if(get_field("gallery_id", $pid) || have_rows('videos_upload', $pid) || have_rows('gallery_id', $pid)) {
                            ?>
                            <div id="tab-gallery" class="tab-pane fade">
                                <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-gallery.php'); ?>
                            </div>
                            <?php
                        }
                        if (have_rows('faqs_list', $pid)) {
                            ?>
                            <div id="tab-faq" class="tab-pane fade">
                                <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-faq.php'); ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div><!-- .tab-content -->
                </div><!-- .col-lg-8 -->
                <!--end of include tabs -->

                <div class="col-lg-4">
                    <?php include(get_template_directory().'/sidebar-single-trip.php');?>
                </div><!-- .col-lg-4 -->

            </div><!-- .row -->
        </div><!-- .container -->
    </div><!--trip-tab-->
<div class="bottom-block-content">
    <?php if (get_field('trip_note')) { ?>
        <div class="extra-info show">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <?php the_field('trip_note'); ?>
                    </div>
                </div>
            </div>
        </div><!--extra-info-->
    <?php } ?>
    <?php if (get_field('trip_distinct_features')) { ?>
        <div class="trip-speciality">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <?php the_field('trip_distinct_features'); ?>
                    </div>
                </div>
            </div>
        </div><!--tirp-soul-->
    <?php } ?>
    <div class="trip-review">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="brown-title">Customer Reviews</h4>

                        <?php 
                        /**
                         * Testimonial module with rating tpl
                         */
                        do_action( 'lds_travel_include_module_multiple','testimonial','rating');?>
                    <!-- form to submit testimonial-->
                    <?php include(get_template_directory() . '/template-parts/tab-trip-detail/tab-review.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="related-block">
    <?php

    $related_trips = get_field('related_trips');

    if( $related_trips ): ?>
        <div class="related-trips">
            <div class="container">
                <header class="section-header col-lg-12">
                    <div class="row">
                        <span class="heading-title">RELATED TRIPS</span>
                    </div>
                </header>
                <section class="related-trip-slider slider">
                    <?php foreach( $related_trips as $related_trip ):
                        $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($related_trip->ID, 'square')); ?>
                        <div>

                                <figure>
                                    <div class="transparent-holder" style="background: url('<?php echo $featuredImage; ?>') no-repeat center; background-size: cover; "></div>
                                </figure>
                                <div class="related-trip-content">
                                    <div class="hover-hdden">
                                        <h5><a href="<?php echo get_permalink( $related_trip->ID ); ?>"> <?php echo get_the_title($related_trip->ID); ?> </a></h5>
                                        <span class="bestseller--trip-days">Go on <?php if(get_field('days', $related_trip->ID) == 1) { echo 'a day'; } else { echo get_field('days', $related_trip->ID) . ' Day'; } ?>
                                            Trip for</span>
                                        <?php $cost = get_field('trip_cost', $related_trip->ID);
                                        if(get_field('discount_percentage', $related_trip->ID)) {
                                            $dcost = $cost - (get_field('discount_percentage', $related_trip->ID) / 100) * $cost;
                                            $dis_per = get_field('discount_percentage', $related_trip->ID);
                                        }
                                        ?>
                                        <?php if ($dcost == $cost) { ?>
                                            <span class="bestseller--cost">USD <?php echo number_format($cost); ?> PP</span>
                                        <?php } elseif ($dcost) { ?>
                                            <span class="bestseller--cost"><span
                                                    class="initial-cost">USD <?php echo number_format($cost); ?></span>USD <?php echo $dcost; ?>
                                                PP</span>
                                        <?php } else { ?>
                                            <span class="bestseller--cost">USD <?php echo number_format($cost); ?> PP</span>
                                        <?php } ?>
                                    </div>
                                </div>

                        </div>
                     <?php endforeach; ?>
                </section>
            </div>

        </div>

    <?php endif;

        $posts = get_field('related_article');

        if( $posts ): ?>
            <section class="latest-blog">
                <div class="container">
                    <header class="section-header col-lg-12">
                        <div class="row">
                            <span class="heading-title">RELATED ARTICLES</span>
                        </div>
                    </header>
                    <div class="row">
                        <?php foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 primary-box">
                                <?php if (has_post_thumbnail($p->ID)) {
                                    ?>
                                    <figure>
                                        <a href="<?php echo get_permalink( $p->ID ); ?>"><?php echo get_the_post_thumbnail( $p->ID, 'footer-blog-thumb'); ?></a>
                                    </figure>
                                    <?php
                                } ?>
                                <div class="primary-box--content">
                                    <h5><a href="<?php echo get_permalink( $p->ID ); ?>"> <?php echo get_the_title($p->ID); ?> </a></h5>

                                    <div class="primary-box--info">
                                        <?php echo wp_trim_words($p->post_content, 20) ?>
                                        <!--                                    --><?php //echo apply_filters('the_content', substr(get_the_excerpt(),90,'...'));
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif;  ?>

    </div>
</div><!-- .bottom-content-wrap -->

<span id="test">
    <?php 
    echo $pid;
     //?>
      <?php 
        /**
         * Testimonial module with rating tpl
         */
        do_action( 'lds_travel_include_module','print','');?>
</span>
<script>
    //add title in enquery form
    var post_title= '<?php echo get_the_title();?>';
    $('#input_7_10').val(post_title);
    $('#input_7_10').before('<h1 class="border-btm">'+post_title+'</h1>');

    $(".enq-without-date").click(function() {
        //debugger;
        $('#input_7_17').val('Not available');
        $('#input_7_17').parent().parent().hide();
     
    });
    
    $(".enq-with-date").click(function() {
        //debugger;
       if($(this)[0].innerHTML =="INQUIRE NOW") {
        $('#input_7_17').parent().parent().show();
        $('#input_7_17').val($(this).parent().parent().children().eq(0).html());
       }
     
    });

</script>
<?php
get_footer();
