<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);
if ($data) {
?>
<div id="homeslider" class="carousel carousel-fade slide " data-ride="carousel">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
            <?php foreach($data as $_data){?>
            <li data-target="#homeslider" data-slide-to="<?php echo $_data['count']; ?>" class="<?php if ($_data['count'] == 0) {echo 'active';} ?>"></li>
            <?php } ?>
    </ol>
    <!-- Wrapper for carousel items -->
    <div class="carousel-inner">
        <?php foreach($data as $_data){?>
            <div class="item slider-content <?php if ($_data['count'] == 0) { echo 'active';} ?>">
                <?php if ( $_data['image_thumb']) {?>
                    <figure class="slider-img">
                        <picture>
                            <!--[if IE 9]><video style="display: none;"><![endif]-->
                            <source srcset="<?php echo $_data['image']['0']; ?>" media="(min-width: 1200px)">
                            <source srcset="<?php echo $_data['image_medium']['0']; ?>"
                                    media="(min-width: 768px)">
                            <source srcset="<?php echo $_data['image_thumb']['0']; ?>"
                                    media="(min-width: 320px)">
                            <!--[if IE 9]></video><![endif]-->
                            <img srcset="<?php echo $_data['image']['0']; ?>"
                                 alt="<?php echo $_data['title']; ?>">
                        </picture>
                    </figure>

                <?php } else { ?>
                    <figure class="slider-img">
                        <img class="img-responsive"
                             src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider-placeholder.png"
                             alt="slide placeholder">
                    </figure>
                <?php } ?>
                <div class="container">
                    <div class="row">
                        <?php if ($_data['title'] || $_data['excerpt']){
                                if(date("Ymd", strtotime($_data['current_date'])) <= date("Ymd", strtotime($_data['end_date']))){
                            ?>
                            <span class="col-lg-12 offer_time">
                            <strong><?php echo $_data['discount_percentage'];?> % OFF</strong>
                             Ends in: <?php echo daysDiff($_data['current_date'], $_data['end_date']); ?></span>
                            <?php } 
                            if ($_data['title']): ?>
                                <h1 class="col-lg-12"><?php echo $_data['title']; ?> - <?php echo $_data['days']; ?></h1>
                            <?php endif; ?>
                            <div class="col-lg-7">

                                <?php if ($_data['excerpt']) { ?>
                                    <div class="sc--short-desc"><?php echo $_data['excerpt'] ; ?></div>
                                <?php } else { ?>
                                    <div class="sc--short-desc"><?php  echo wp_trim_words( $_data['excerpt'], 35, $more = '' ) ; ?></div>
                                <?php } ?>
                                <span class="learn-more"><a href="<?php echo $_data['permalink']; ?>">learn more</a></span>
                            </div>
                        <?php } ?>
                        <div class="col-lg-5 trip__meta-wrap">
                            <div class="row">
                                <ul class="col-lg-7  col-md-4  col-sm-12 col-lg-push-5 trip-info">
                                <?php if($_data['max_altitude']) { ?>
                                    <li class="sc--altitude"><i
                                            class="icon-altitude"></i><span><?php echo $_data['max_altitude']; ?></span>
                                    </li>
                                <?php
                                }   
                                    if($_data['trip_level']) {
                                ?>
                                    <li class="sc--activity-level <?php
                                    if ($_data['trip_level'] == 'Easy') {
                                        echo 'Easy';
                                    } elseif ($_data['trip_level'] == 'Beginners') {
                                        echo 'Beginners';
                                    } elseif ($_data['trip_level'] == 'Moderate') {
                                        echo 'Moderate';
                                    } elseif ($_data['trip_level'] == 'Demanding') {
                                        echo 'Demanding';
                                    } elseif ($_data['trip_level'] == 'Strenuous') {
                                        echo 'Strenuous';
                                    } elseif ($_data['trip_level'] == 'Very Strenuous') {
                                        echo 'Very Strenuous';
                                    } elseif ($_data['trip_level'] == 'Challenging') {
                                        echo 'Challenging';
                                    } elseif ($_data['trip_level'] == 'Tough') {
                                        echo 'Tough';
                                    } elseif ($_data['trip_level'] == 'Advanced') {
                                        echo 'Advanced';
                                    } elseif ($_data['trip_level'] == 'Advanced Beginners') {
                                        echo 'Advanced Beginners';
                                    } elseif ($_data['trip_level'] == 'Intermediate') {
                                        echo 'Intermediate';
                                    }

                                    ?>">
                                    <i class="ico-<?php echo $_data['trip_level']; ?>"></i><span><?php echo $_data['trip_level']; ?></span>

                                        <?php if ($_data['trip_level'] == 'Easy') { ?>
                                            <?php if (get_field('trip_level_easy_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Easy"><?php the_field('trip_level_easy_discription', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Beginners') {
                                            if (get_field('trip_level_beginners_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Beginners"><?php the_field('trip_level_beginners_discription', 'option'); ?></div>
                                            <?php }
                                        }  elseif ($_data['trip_level_type'] == 'Biking' && $_data['trip_level'] == 'Moderate') {
                                            if (get_field('bikes_moderate_trip_level_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Moderate"><?php the_field('bikes_moderate_trip_level_description', 'option'); ?></div>
                                            <?php }
                                        }elseif ($_data['trip_level'] == 'Moderate') {
                                            if (get_field('trip_level_moderate_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Moderate"><?php the_field('trip_level_moderate_discription', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Demanding') {
                                            if (get_field('trip_level_demanding_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Demanding"><?php the_field('trip_level_demanding_discription', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level_type'] == 'Biking' && $_data['trip_level'] == 'Strenuous') {
                                            if (get_field('bikes_strenuous_trip_level_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Strenuous"><?php the_field('bikes_strenuous_trip_level_description', 'option'); ?></div>
                                            <?php }
                                        }
                                        elseif ($_data['trip_level'] == 'Strenuous') {
                                            if (get_field('trip_level_strenuous_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Strenuous"><?php the_field('trip_level_strenuous_discription', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Challenging') {
                                            if (get_field('trip_level_challenging_discription', 'option')) { ?>
                                                <div
                                                    class="tour-level Challenging"><?php the_field('trip_level_challenging_discription', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Tough') {
                                            if (get_field('trip_level_tough_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Tough"><?php the_field('trip_level_tough_description', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Advanced') {
                                            if (get_field('trip_level_advanced_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Advanced"><?php the_field('trip_level_advanced_description', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Advanced Beginners') {
                                            if (get_field('trip_level_advanced_beginners_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Advanced Beginners"><?php the_field('trip_level_advanced_beginners_description', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Intermediate') {
                                            if (get_field('trip_level_intermediate_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Intermediate"><?php the_field('trip_level_intermediate_description', 'option'); ?></div>
                                            <?php }
                                        } elseif ($_data['trip_level'] == 'Very Strenuous') {
                                            if (get_field('trip_level_very_strenuous_description', 'option')) { ?>
                                                <div
                                                    class="tour-level Very Strenuous"><?php the_field('trip_level_very_strenuous_description', 'option'); ?></div>
                                            <?php }
                                        }
                                        ?>


                                    </li>
                                    <?php } ?>

                                </ul>
                                <div class="col-lg-5 col-md-7 col-sm-12 col-lg-pull-7">
                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="row">
                                            <?php
                                             if ($_data['trip_cost']) : ?>
                                                <span class="sc--trip-days">Go on <?php if($_data['days'] == 1) { echo 'a day'; } else { echo $_data['days'] . ''; } ?>
                                                      trip for</span>
                                            <?php endif; ?>
                                            
                                            <?php if ($_data['discount_percentage']) {
                                                $des_cost = $_data['trip_cost'] - ($_data['discount_percentage'] / 100) * $_data['trip_cost'];
                                                ?>
                                                <div class="clearfix">
                                                    <span class="sc--initial-cost">USD <?php echo number_format($_data['trip_cost']); ?></span>
                                                    <span class="sc--dis-cost">USD <?php echo number_format($des_cost); ?> PP</span>
                                                </div>
                                            <?php } else { if ($_data['trip_cost']) : ?>
                                                <span class="sc--cost">USD <?php echo number_format($_data['trip_cost']); ?> PP</span>
                                            <?php endif; } ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-sm-6">
                                        <div class="row">
                                            <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                                <input type="hidden" name="slug-name" value="<?php echo $_data['title']; ?>">
                                                <input type="hidden" name="trip-code" value="<?php echo $_data['trip_code']; ?>">
                                                <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                            </form>
                                                <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $_data['title']; ?>">
                                                <strong>INQUIRE NOW </strong></a>

                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>   
    </div>

</div>
<?php }?>