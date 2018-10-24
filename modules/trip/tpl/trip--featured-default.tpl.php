<?php
//var_dump($data_featured);
if ($data_featured) {
?>
<!--Discount trip starts-->
<section class="discount-trip">
        <div class="container">
            <header class="section-header col-lg-12 ">
                <div class="row">
                    <span class="heading-title"><?php the_field('featured_trips_title'); ?></span>
                </div>
            </header>
            <div class="row">
                
                    <?php 
                        foreach($data_featured as $_data){
                        ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                            <div class="border-box">
                                <div class="figure">
                                    <?php 
                                    if($_data['featured_image']){ ?>
                                        <img src="<?php echo $_data['front_grid_image']['0']; ?>" alt="<?php echo $trip_image['featured_image_caption']; ?>" />
                                    <?php } else{ ?>
                                        <img src="/wp-content/uploads/2016/05/trip-460x305.png" alt="Default Placeholder Image" />
                                    <?php } ?>
                                    <div class="hover-show">
                                        <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                            <input type="hidden" name="slug-name" value="<?php echo $_data['post_title']; ?>">
                                            <input type="hidden" name="trip-code" value="<?php echo $_data['trip_code']; ?>">
                                            <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                        </form>
                                        <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $_data['post_title']; ?>"><strong>INQUIRE NOW</strong></a>
                                                    
                                                <span class="learn-more"> or <a href="<?php echo $_data['permalink']; ?>">learn
                                                        more</a></span>
                                    </div>
                                </div>

                                <div class="border-box--content">
                                    <?php  if(date("Ymd", strtotime($_data['current_date'])) <= date("Ymd", strtotime($_data['offer_ends']))){ ?>
                                        <span class="offer_time">Ends in: <?php echo daysDiff($_data['current_date'], $_data['offer_ends']); ?></span>
                                    <?php } ?>
                                    <h6><a href="<?php  echo $_data['permalink']; ?>"><?php echo $_data['post_title']; ?></a></h6>
                                    <div class="clearfix">
                                        <?php if ($_data['discount_percentage']): ?>
                                            <div class="discount-block">
                                                <span class="discount-block__title">Discount</span>
                                                <span class="discount-block__value"><?php echo $_data['discount_percentage']; ?> % OFF</span>

                                            </div>
                                        <?php endif; ?>
                                        <div class="trip-price__meta">
                                                <span class="border-box--trip-days">Go on <?php if($_data['days'] == 1) { echo 'a day'; } 
                                                else 
                                                { echo $_data['days'] . ' day'; } ?>
                                                    trip
                                                    for
                                                </span>
                                            <?php
                                            $cost = $_data['trip_cost'];
                                            $dcost = $cost - ($_data['discount_percentage'] / 100) * $cost;

                                            ?>
                                            <?php if ($_data['discount_percentage']) { ?>
                                                <span class="border-box--trip-cost">
                                                        <span class="initial-cost">USD <?php echo number_format($cost); ?></span>
                                                        <span>USD <?php echo number_format($dcost); ?> </span>
                                                        PP
                                                    </span>
                                            <?php } else { ?>
                                                <span class="border-box--trip-cost">
                                                        <span>USD <?php echo number_format($cost); ?></span> PP
                                                    </span>

                                            <?php } ?>
                                        </div><!-- .trip-price__meta -->
                                    </div><!-- .clearfix -->
                                </div><!-- .border-box--content -->
                            </div><!-- .border-box -->
                        </div>
                        <?php
                        //} 
                    }
               
                wp_reset_postdata();
                ?>
                <div class="border-box hidden"></div>
            </div>
    </section>
    <?php } ?>