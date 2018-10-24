<?php
if ($data_month) {
?>
    <?php foreach($data_month as $_data){ ?>
        <section class="monthly-trip">
            <div class="container">
                <div class="ribbon"><span><?php echo $_data['post_title']; ?></span></div>
                <div class="col-lg-12">
                    <h1><a href="<?php echo $_data['permalink']; ?>"><?php echo $_data['post_title']; ?> - <?php echo $_data['days']; ?> Days</a></h1>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <a href="<?php echo $_data['permalink']; ?>"><figure class="monthly-trip--image" style="background: url('<?php echo $_data['featured_image']; ?>') no-repeat center; background-size: auto 100%; ">
                    </figure></a>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-11 col-xs-11">
                    <!--mt stands for monthly trip -->
                    <p class="big-paragraph"><?php echo wp_trim_words($_data['post_content'], 25) ?> <span class="learn-more"><a href="<?php $_data['permalink']; ?>">learn more</a>
                    </span>
                    </p>

                    <div class="mt-trip-detail">
       <?php if($_data['max_altitude']) { ?> 
            <span class="mt--altitude"><i class="icon-altitude"></i><?php echo $_data['max_altitude']; ?></span> 
        <?php } ?>
        <?php if( $_data['trip_level'] ) { ?> 
        <div class="mt--activity-level"><i
                class="ico-<?php $_data['trip_level']; ?>"></i><span><?php $_data['trip_level']; ?></span>

            <div class="mt--activity-level-hidden">

                <?php if ($_data['trip_level'] ) { ?>
                    <?php if ($trip_label_desc[$_data['trip_level']]) { ?>
                        <div class="tour-level Easy"><?php echo $trip_label_desc[$_data['trip_level']]; ?></div>
                    <?php }
                } ?>

            </div><!-- .mt-activity-level-hidden -->
        </div>
        <?php } ?>

        <?php if($_data['days'] && $_data['trip_cost']) { ?>

                        <span class="mt--trip-days">Go on <?php if($_data['days'] == 1) { echo 'a day'; } else { echo $_data['days'] . ' day'; } ?> trip for
                            <?php if ($_data['discount_percentage']) {
                                $des_cost = $_data['trip_cost'] - ($_data['discount_percentage'] / 100) * $_data['trip_cost'];
                            ?>
                            <span class="mt--cost">
                                <span class="initial-cost">USD <?php echo number_format($_data['trip_cost']); ?></span>
                                <span class="sc--dis-cost">USD <?php echo number_format($des_cost); ?> PP</span>
                            </span>
            <?php } else { if ($_data['trip_cost']) : ?>
                <span class="mt--cost">USD <?php echo number_format($_data['trip_cost']); ?> PP</span>
            <?php endif; } ?>
        <?php } ?>
                        <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display:none;">
                            <input type="hidden" name="slug-name" value="<?php the_title(); ?>">
                            <input type="hidden" name="trip-code" value="<?php echo $_data['trip_code']; ?>">
                            <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                        </form>
                        <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $_data['post_title']; ?> "><strong>INQUIRE NOW</strong></a>
                       
                    </div>
                </div>

            </div>
        </section>
        <?php
    }
}   
?>