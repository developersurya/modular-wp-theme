<div class="trip-sidebar">
    <!--<div class="sticky-widget">-->
    <!--Show price div only if it contain price-->
    <?php  $cost = get_field("trip_cost");
    if(!empty($cost)){?>
        <div class="hero--trip-meta<?php if(get_field('discount_percentage') == ''){ echo " no-discount-per"; } ?>">
            <?php $end_date = get_field('offer_ends', $pid); //Future date
            $dis_per = get_field('discount_percentage');
            if($dis_per){ ?>
                <span class="offer_time"><strong><?php echo get_field('discount_percentage'); ?>% Off</strong>
                    <?php if(date("Ymd", strtotime($current_date)) <= date("Ymd", strtotime($end_date))){  ?>
                        <span>Ends in: <?php echo daysDiff($current_date, $end_date); ?></span><?php } ?>
            </span>
            <?php }
            if(get_field("trip_cost")){ ?> <div class="hero--trip-days">Go on <?php if(get_field('days', $post_id) == 1) { echo 'a day'; } 
            else { echo get_field('days', $post_id) . ' day'; } ?> trip for</div><?php  } ?>

            <?php
            
            $dis_per = get_field('discount_percentage');
            ?>
            <?php if ($dis_per) {
                $des_cost = $cost - ($dis_per / 100) * $cost;
                ?>
                <div class="clearfix">
                    <span class="hero--cost">USD <?php echo number_format($cost); ?></span>
                    <span class="hero-dis-cost">USD <?php echo number_format($des_cost); ?> <sup>per person</sup></span>
                </div>
            <?php } else { if ($cost) : ?>
                <span class="hero--cost hero--no-dis">USD <?php echo number_format($cost); ?> <sup>per person</sup></span>
            <?php endif; }
            $saved_cost = $cost - $des_cost; ?>
            <span class="save-cost">You Save <i class="saved-amount">USD <?php echo $saved_cost; ?></i> </span>

            <?php if( have_rows('group_discount') ): ?>
                <span class="group-discount" style="display:block;">See Group Discount</span>
                <div class="discount-list">
                    <table>
                        <thead>
                        <tr>
                            <th>No. of people</th>
                            <th>Price per person</th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php while( have_rows('group_discount') ): the_row();
                        $group_range = get_sub_field('group_range');
                        $group_price = get_sub_field('price_per_person'); ?>
                        <tr>
                            <td><?php echo $group_range; ?></td>
                            <td><?php echo 'USD '.number_format($group_price); ?></td>
                        </tr>
                    <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>
            <?php endif;
            if (    have_rows('small_group_journey',$pid) ||
            have_rows('group_size_info',$pid) ||
            get_field('date_description', $pid) ||
            get_field('small_group', $pid) ||
            get_field('private_journey', $pid) ||
            get_field('tailor_made_journey', $pid)

            )  {

            ?>
            <a href="#" class="btn btn-large check-availability">Check Availability</a>
            <?php } ?>
        </div><!-- .hero-trip-meta -->
    <?php } ?>

    <!--</div> .sticky-widget -->

    <div class="sidebar-item button-widget clearfix">
        
    <!--Show price div only if it contain price-->
        <?php  $cost = get_field("trip_cost");
        if(!empty($cost)){?>
            <a href="<?php echo site_url();?>/trip-booking/?tid=<?php echo get_the_ID();?>" class="btn btn-success">BOOK NOW</a>
        <?php } ?>
             <a href="#enquiry-popup-form" class="fancybox enq-without-date btn btn-blue <?php if(empty($cost)){echo "no-price-avl";}?>" data-title="<?php the_title(); ?>"><strong>INQUIRE NOW</strong></a>
                <!--<div id="enquiry-popup-form" style="display:none; max-width:900px;">
                <?php //echo do_shortcode('[gravityform id="7" title="true" description="false" ajax="true" tabindex="23"]'); ?>
                </div> -->
            <?php 
            /**
             * Add general popup module for enquiry form. Buttons need to be added in featured-trip tpl files.
             */
            do_action( 'lds_travel_include_module','trip-forms','general-enquiry');
            ?>
    </div>

    <!--info list-->
    <?php if( have_rows('checklist', 'option') ): ?>
        <ul class="info-list text-center clearfix">
            <?php while( have_rows('checklist', 'option') ): the_row();
                $item = get_sub_field('checklist_item'); ?>
                <li>
                    <?php echo $item; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <!--End of info list-->

    <?php 
    /**
     * Testimonial module with rating tpl
     */
    do_action( 'lds_travel_include_module_multiple','testimonial','sidebar');
    ?>

    <div id="TA_selfserveprop283" class="TA_selfserveprop"><ul id="uQvHml9AyoaK" class="TA_links nKQJUmYwRH6"><li id="ONWJoTyW" class="Ehfz0mJVtv3k"><a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png"alt="TripAdvisor"/></a></li></ul></div><script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=283&amp;locationId=1957215&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2"></script>
    <div class="sidebar-item trip__social-block">
    <!-- Load Facebook SDK for JavaScript -->
    <?php $obj_id = get_queried_object_id();
    $current_url = get_permalink( $obj_id );?>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <!-- Your share button code -->
  <div class="fb-share-button" 
    data-href="<?php echo $current_url;?>" 
    data-layout="button_count">
  </div>
  <a href="#" class="twitter-share">Tweet</a>
  <script>
  var getWindowOptions = function() {
  var width = 500;
  var height = 350;
  var left = (window.innerWidth / 2) - (width / 2);
  var top = (window.innerHeight / 2) - (height / 2);

  return [
    'resizable,scrollbars,status',
    'height=' + height,
    'width=' + width,
    'left=' + left,
    'top=' + top,
  ].join();
};
var twitterBtn = document.querySelector('.twitter-share');
var text = encodeURIComponent('Hey everyone, come & see how good I look!');
var shareUrl = 'https://twitter.com/intent/tweet?url=' + location.href + '&text=' + text;
twitterBtn.href = shareUrl; // 1
</script>
        <h5 class="sidebar-item-title">
            <strong>Share:</strong>
            <span class='st_facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
            <span st_via='@acethehimalaya' st_username='acethehimalaya' class='st_twitter' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
        </h5>
        <!-- <a class="btn btn-dossier" target="_blank" href="<?php //the_permalink(); ?>?print=print&id=<?php //echo $post->ID; ?>"><i class="file"></i>View Dossier Online</a> -->
        <?php 
        /**
         * Add Print button 
         */
        do_action( 'lds_travel_include_module','print','');?>

    </div>

    <!--map-->
    <?php
    $image = get_field("trip_map");
    if ($image):
        ?>
        <div class="trip-map">
            <h5 class="trip-map-title">Trip Map</h5>

            <div class="sidebar-item">
                <a href="<?php echo $image['url']; ?>" class="fancybox  zoom-map center-icon"><i
                        class="icon-zoom-in"></i></a>
                <a href="<?php echo $image['url']; ?>" class="download-icon center-icon"
                    download="<?php the_title(); ?> Map"><i class="icon-arrow-down2"></i></a>
                <img class="img-responsive" src="<?php echo $image['url']; ?>"
                        alt="<?php echo $image['alt']; ?>">
            </div>
        </div>
    <?php endif; ?>
    <!--end of map-->

    <!--before booking-->
    <?php wp_reset_query(); 
    $trip_id = get_the_ID();
    if( have_rows('sidebar_before_booking_a_trip_page_list', $trip_id) ){ ?>
        <div class="sidebar-item before-booking-item">
            <h5 class="sidebar-item-title">Before Booking a Trip</h5>
            <ul>
                <?php  while ( have_rows('sidebar_before_booking_a_trip_page_list', $trip_id) ) : the_row();
                    $page_title = get_sub_field('page_title', $trip_id);
                    $page_link = get_sub_field('page_relative_url', $trip_id); ?>
                    <li><a href="<?php echo site_url() . $page_link ?>" title="Link to <?php echo $page_title; ?>"><?php echo $page_title; ?></a></li>

                <?php endwhile;  ?>
            </ul>
        </div>
    <?php } ?>
    <!--end of before booking-->

    <!--representative section-->
    
    <?php do_action( 'lds_travel_include_module','representative','default');?>
    
    <!--end of representative section-->

</div>