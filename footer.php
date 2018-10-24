<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LDS_Travel
 */

?>

<footer id="footer" >

<div class="footer-contact">
    <div class="container">
        <?php 
        /**
         * associate module
         */        
        do_action( 'lds_travel_include_module','associate','default');
        ?>
        <div class="row">
            <div class="col-lg-2">
               <h3 class="footer-section__title">Contact Us</h3>
            </div>
            <div class="col-lg-12">
                <h6>Head Office</h6>

                <div class="row footer-contact--row  col-sm-12 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 first">
                            <?php the_field('head_office', 'option'); ?>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <?php the_field('north_america_office', 'option'); ?>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <?php the_field('europe_office', 'option'); ?>
                        </div>
                    </div>
                </div>
                <div class="row footer-contact--row col-sm-12 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <?php the_field('south_africa_office', 'option'); ?>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <?php the_field('indonesia_office', 'option'); ?>
                        </div>
                        <div class="col-lg-4 col-md-4">

                            <?php the_field('russia_and_east_europe_office', 'option'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--footer-contact-->
</div>
<div class="footer-social-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 newsletter-subscription">
                <?php echo do_shortcode('[gravityform id="4" title="true" description="true" ajax="true"]') ?>

            </div>
            <div class="col-md-8 col-lg-8">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <?php if( have_rows('logo_repeater', 'option') ){ ?>
                            <div class="logo-list clearfix">
                                <?php  while( have_rows('logo_repeater', 'option') ): the_row();
                                    $image = get_sub_field('logo');  ?>
                                        <?php if($image){ ?><a target="_blank" href="<?php echo get_sub_field('url'); ?>"><img
                                                src="<?php echo $image['url']; ?>"
                                                alt="<?php echo $image['alt']; ?>"></a><?php } ?>
                                         <?php endwhile; ?>
                            </div><!-- .logo-list -->
                        <?php } ?>

                    </div><!--col-lg-4-->
                    <div class="col-md-6 col-lg-6">

                        <div class="social-links clearfix">
                                    <h5>
                                        <small>Let’s get social</small>
                                    </h5>
                                    <ul class="clearfix">
                                        <?php if (get_field('facebook', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('facebook', 'option'); ?>"
                                                   class="icon-facebook"></a></li>
                                        <?php } ?>
                                        <?php if (get_field('twitter', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('twitter', 'option'); ?>"
                                                   class="icon-twitter"></a>
                                            </li>
                                        <?php } ?>
                                        <?php if (get_field('flickr', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('flickr', 'option'); ?>"
                                                   class="icon-flickr"></a>
                                            </li>
                                        <?php } ?>
                                        <?php if (get_field('instagram', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('instagram', 'option'); ?>"
                                                   class="icon-instagram"></a>
                                            </li>
                                        <?php } ?>
                                        <?php if (get_field('google_plus', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('google_plus', 'option'); ?>"
                                                   class="icon-googleplus"></a></li>
                                        <?php } ?>
                                        <?php if (get_field('linkedin', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('linkedin', 'option'); ?>"
                                                   class="icon-linkedin2"></a>
                                            </li>
                                        <?php } ?>
                                        <?php if (get_field('youtube', 'option')) { ?>
                                            <li><a target="_blank" href="<?php the_field('youtube', 'option'); ?>  "
                                                   class="icon-youtube"></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="sharethis">
                                        <div id="fb-root"></div>
                                        <script>(function (d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0];
                                                if (d.getElementById(id)) return;
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }(document, 'script', 'facebook-jssdk'));</script>

                                        <div class="fb-like" data-href="https://www.facebook.com/acethehimalaya"
                                             data-width="450" data-layout="button_count" data-action="like"
                                             data-show-faces="true" data-share="false"></div>

                                        <a href="https://twitter.com/acethehimalaya" class="twitter-follow-button"
                                           data-show-count="false" data-size="large" data-show-screen-name="false"
                                           data-dnt="true">Follow @acethehimalaya</a>
                                        <script>!function (d, s, id) {
                                                var js, fjs = d.getElementsByTagName(s)[0], p = /^https:/.test(d.location) ? 'http' : 'https';
                                                if (!d.getElementById(id)) {
                                                    js = d.createElement(s);
                                                    js.id = id;
                                                    js.src = '//platform.twitter.com/widgets.js';
                                                    fjs.parentNode.insertBefore(js, fjs);
                                                }
                                            }(document, 'script', 'twitter-wjs');</script>

                                    </div> <!-- .sharethis -->

                        </div><!-- .social-links -->

                    </div><!--col-lg-4-->
                </div>

                 <div class="row">
                    <div class="online-pay-icon">
                        <?php $online_pay_img = get_field('online_payment_card_image', 'option'); 
                        if($online_pay_img['url']){?>
                        <img src="<?php echo $online_pay_img['url'];?>" alt="<?php echo  $online_pay_img['alt'];?>">
                        <?php } ?>
                    </div>
                 </div>
            </div>

        </div><!-- .row -->
    </div><!--container-->
    </div><!-- .footer-social-block -->
<div class="footer-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="site-branding col-lg-3">
                    <?php $site_logo = get_field('site_logo', 'option'); 
                        $ace_slogan = get_field('ace_slogan', 'option'); ?>
                    <a class="logo" href="<?php echo site_url(); ?>"><img class="img-responsive" src="<?php echo $site_logo['url']; ?>" alt="Acethehimalaya logo"></a>
                    <img class="ace-slogan" src="<?php echo $ace_slogan['url']; ?>" alt="Acethehimalaya Slogan">
                </div><!-- .site-branding -->
                <div class="ace-important-info col-lg-9">
                    <?php the_field('ace_information', 'option'); ?>
                </div>
            </div><!-- .col-lg-12 -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="footer-nav text-center">
                        <?php wp_nav_menu(array('theme_location' => 'secondary_menu')); ?>
                    </div>
                    <div id="colophon" class="clearfix">
                        <div class="copyright">&#169; 2007 - <?php echo date("Y"); ?> All rights reserved. <a
                                href="<?php echo site_url(); ?>">Ace the
                                Himalaya.</a></div>
                                <div class="site-map">
                                    <a href="<?php echo site_url();?>/site-map">Site Map</a>
                                </div>
                        <div class="designer"><a href="https://www.lastdoorsolutions.com" <?php if ( ! is_front_page() ) {
                                echo 'rel="nofollow"';
                            } else {
                                echo 'rel="bookmark"';
                            } ?> target="_blank"
                                                 title="Web Design & Development Agency based in Kathmandu, Nepal">Crafted by Last Door Solutions</a></div>
                    </div>
                </div>
            </div>
        </div><!-- .row -->
    </div><!--container-->
</div><!--footer-info-->
</footer>

<?php wp_footer(); ?>

</body>
</html>