<?php
//var_dump($data_bestseller);
$first = $data_bestseller[0];
$second = $data_bestseller[1];
$third = $data_bestseller[2];
$fourth = $data_bestseller[3];
//$fifth = $data_bestseller[4];

if ($data_bestseller) {
?>
    <section class="bestseller">
        <div class="container">
            <header class="section-header col-lg-12">
                <div class="row">
                    <span class="heading-title"> <?php echo the_field('our_best_sellers_title'); ?> for <?php echo date('Y'); ?></span>
                </div>
            </header>
            <div class="row">
                <ul class="col-lg-6 col-1">
                    <li class="col-lg-12">
                        <?php
                        $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($first['post_id'], 'square'));
                        ?>
                        <figure>
                            <div class="transparent-holder" style="background: url('<?php echo $featuredImage; ?>') no-repeat center; background-size: cover; ">
                            </div>
                        </figure>
                        <div class="bestseller--package-content">
                            <div class="hover-hdden">
                                <h5><?php echo $first['post_title']; ?></h5>
                                <h5><?php echo $first['trip_cost']; ?></h5>
                                <span class="bestseller--trip-days">Go on <?php if( $first['days'] == 1) { 
                                    echo 'a day'; } else { echo  $first['days']. ' Day'; } ?>
                                     Trip for</span>
                                <?php $cost = $first['trip_cost'];
                                if($first['discount_percentage']) {
                                    $dcost = $first['trip_cost'] - ( $first['discount_percentage'] / 100) * $first['trip_cost'];
                                    $dis_per = $first['discount_percentage'];
                                }
                                ?>
                                <?php if ($dcost == $first['trip_cost']) { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($first['trip_cost']); ?> PP</span>
                                <?php } elseif ($dcost) { ?>
                                    <span class="bestseller--cost"><span
                                            class="initial-cost">USD <?php echo number_format($first['trip_cost']); ?></span>USD <?php echo $dcost; ?>
                                        PP</span>
                                <?php } else { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($first['trip_cost']); ?> PP</span>
                                <?php } ?>
                            </div>
                            <div class="hover-show large">
                                <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                    <input type="hidden" name="slug-name" value="<?php echo $first['post_title']; ?>">
                                    <input type="hidden" name="trip-code" value="<?php echo  $first['trip_code']; ?>">
                                    <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                </form>
                                <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php  echo $first['post_title'];  ?>">
                                <strong>INQUIRE NOW</strong></a>
                                                    
                                <span class="learn-more"> or <a href="<?php echo get_the_permalink($first['post_id']); ?>">
                                learn more</a></span>
                            </div>
                        </div>
                    </li>
                    <li class="col-lg-12">
                        <?php
                        $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($second['post_id'], 'square'));
                        ?>
                        <figure>
                            <div class="transparent-holder" style="background: url('<?php echo $featuredImage; ?>') no-repeat center; background-size: cover; ">
                            </div>
                        </figure>
                        <div class="bestseller--package-content">
                            <div class="hover-hdden">
                                <h5><?php echo $second['post_title']; ?></h5>
                                <span class="bestseller--trip-days">Go on <?php if( $second['days'] == 1) { 
                                    echo 'a day'; } else { echo  $second['days'] . ' Day'; } ?>
                                     Trip for</span>
                                <?php $cost2 = $second['trip_cost'];
                                if( $second['discount_percentage']) {
                                    $dcost2 = $cost2 - ( $second['discount_percentage'] / 100) * $cost2;
                                    $dis_per =  $second['discount_percentage'];
                                }
                                ?>
                                <?php if ($dcost2 == $cost2) { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost2); ?> PP</span>
                                <?php } elseif ($dcost2) { ?>
                                    <span class="bestseller--cost"><span
                                            class="initial-cost">USD <?php echo number_format($cost2); ?></span>USD <?php echo $dcost2; ?>
                                        PP</span>
                                <?php } else { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost2); ?> PP</span>
                                <?php } ?>
                            </div>
                            <div class="hover-show">
                                <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                    <input type="hidden" name="slug-name" value="<?php echo $second['post_title']; ?>">
                                    <input type="hidden" name="trip-code" value="<?php echo get_field('trip_code', $second['post_id']); ?>">
                                    <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                </form>
                                <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $second['post_title']; ?>"><strong>INQUIRE NOW</strong></a>
                                                    
                                <span class="learn-more"> or <a href="<?php echo get_the_permalink($second['post_id']); ?>">learn
                                        more</a></span>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="col-lg-6 col-2 col-md-12 ">
                    <li class="col-lg-12">

                        <?php
                        $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($third['post_id'], 'square'));
                        ?>
                        <figure>
                            <div class="transparent-holder" style="background: url('<?php echo $featuredImage; ?>') no-repeat center; background-size: cover; "></div>
                        </figure>
                        <div class="bestseller--package-content">
                            <div class="hover-hdden">
                                <h5><?php echo $third['post_title']; ?></h5>
                                <span class="bestseller--trip-days">Go on <?php if( $third['days'] == 1) { echo 'a day'; } else { echo  $third['days'] . ' Day'; } ?>
                                     Trip for</span>
                                <?php $cost3 = $third['trip_cost'];
                                if( $third['discount_percentage']) {
                                    $dcost3 = $cost3 - ( $third['discount_percentage'] / 100) * $cost3;
                                    $dis_per =  $third['discount_percentage'];
                                }
                                ?>
                                <?php if ($dcost3 == $cost3) { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost3); ?> PP</span>
                                <?php } elseif ($dcost3) { ?>
                                    <span class="bestseller--cost"><span
                                            class="initial-cost">USD <?php echo number_format($cost3); ?></span>USD <?php echo $dcost3; ?>
                                        PP</span>
                                <?php } else { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost3); ?> PP</span>
                                <?php } ?>
                            </div>
                            <div class="hover-show">
                                <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                    <input type="hidden" name="slug-name" value="<?php echo $third['post_title']; ?>">
                                    <input type="hidden" name="trip-code" value="<?php echo get_field('trip_code', $third['post_id']); ?>">
                                    <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                </form>
                                <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $third['post_title']; ?>"><strong>INQUIRE NOW</strong></a>
                                                    
                                <span class="learn-more"> or <a href="<?php echo get_the_permalink($third['post_id']); ?>">learn
                                        more</a></span>
                            </div>
                        </div>
                    </li>

                    <li class="col-lg-12 ">

                        <?php
                        $featuredImage = wp_get_attachment_url(get_post_thumbnail_id($fourth['post_id'], 'square'));
                        ?>
                        <figure>
                            <div class="transparent-holder"
                                 style="background: url('<?php echo $featuredImage; ?>') no-repeat center; background-size: cover; "></div>
                        </figure>
                        <div class="bestseller--package-content">
                            <div class="hover-hdden">
                                <h5><?php echo $fourth['post_title']; ?></h5>
                                <span class="bestseller--trip-days">Go on <?php if( $fourth['days'] == 1) { echo 'a day'; } else { echo  $fourth['post_id'] . ' Day'; } ?>
                                     Trip for</span>
                                <?php $cost4 =  $fourth['trip_cost'];
                                if( $fourth['discount_percentage']) {
                                    $dcost4 = $cost4 - ( $fourth['discount_percentage'] / 100) * $cost4;
                                    $dis_per =  $fourth['discount_percentage'];
                                }?>
                                <?php if ($dcost4 == $cost4) { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost4); ?> PP</span>
                                <?php } elseif ($dcost4) { ?>
                                    <span class="bestseller--cost"><span
                                            class="initial-cost">USD <?php echo number_format($cost4); ?></span>USD <?php echo number_format($dcost4); ?>
                                        PP</span>
                                <?php } else { ?>
                                    <span class="bestseller--cost">USD <?php echo number_format($cost4); ?> PP</span>
                                <?php } ?>
                            </div>
                            <div class="hover-show large">
                                <form method="post" action="<?php echo site_url(); ?>/inquire-form" style="display: none;">
                                    <input type="hidden" name="slug-name" value="<?php echo $fourth['post_title']; ?>">
                                    <input type="hidden" name="trip-code" value="<?php echo  $fourth['trip_code']; ?>">
                                    <input type="submit" class="btn btn-default" value="INQUIRE NOW"/>
                                </form>
                                <a href="#enquiry-popup-form" class="fancybox home-inq-btn btn btn-blue"  data-title="<?php echo $fourth['post_title']; ?>"><strong>INQUIRE NOW</strong></a>
                                                    
                                <span class="learn-more"> or <a href="<?php echo get_the_permalink($fourth['post_id']); ?>">learn
                                        more</a></span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </section>
<?php }?>