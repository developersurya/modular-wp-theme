<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package LDS_Travel
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <meta property="og:url"           content="http://acethehimalaya.local/" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="Your Website Title" />
  <meta property="og:description"   content="Your description" />
  <meta property="og:image"         content="http://acethehimalaya.local//wp-content/uploads/2017/04/ace-logo.svg" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text"
   href="#content"><?php esc_html_e('Skip to content', 'acethehimalaya'); ?></a>
<!-- START Display Upgrade Message for IE 9 or Less -->
<!--[if lt IE 9]>
<div style="background: #000; text-align: center; position: fixed; top: 0px; width: 100%; color: #FFF; z-index: 100;">This website may not be compatible with your outdated Internet Explorer version. <a href="https://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank" style="color: #fff; text-decoration: underline;">Please upgrade here.</a></div>
<script type="text/javascript"> $('body').addClass('ie'); </script>
<![endif]-->
<!--[if IE 9]>
<div style="background: #000; text-align: center; position: fixed; top: 0px; width: 100%; color: #FFF; z-index: 100;">This website may not be compatible with your outdated Internet Explorer version. <a href="https://windows.microsoft.com/en-us/internet-explorer/download-ie" target="_blank" style="color: #fff; text-decoration: underline;">Please upgrade here.</a></div>
<script type="text/javascript"> $('body').addClass('ie'); </script>
<![endif]-->
<div class="mobile-nav-wrap  clearfix">
    <?php 
    do_action( 'lds_travel_include_module_multiple','navigation','');
    ?>
    <script>
        jQuery(document).ready(function ($) {
            $('#menu-primary-menu').append('<li class=""><a href="/blog">Blog</a></li>' +
                '<li class=""><a href="/company/reviews/">Reviews</a></li>' +
                '<li class=""><a href="/contact-us">Contact us</a></li>' +
                '<li class=""><a href="/request-a-brochure/">Request a Brochure</a></li>'
            );
        });
    </script>
</div>

<div class="conntainer-fluid">
    <div class="mobile-menu">
        <div class="top-space">
            <div class="top-header">

                <div class="site-header">
                    <!--site branding-->
                    <?php 
                     /**
                     * include module action 'lds_travel_include_module_multiple' , 'module name' , 'tpl name';
                     * Important: module folder name (module-name), main php file (module-name.php) and content/layouts/ should have (module-name.php)
                     * action registered in custom-function.php
                     */
                    do_action( 'lds_travel_include_module_multiple','brand','');

                    ?>
                    <!-- .site-branding -->
                    <div class="phone-list-trigger">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/phone.svg" alt="Phone icon" />
                    </div>

                    <?php do_action( 'lds_travel_include_module_multiple','phone','');?>

                </div>

                <div class="mobile-nav-btn"><span></span></div>

            </div>
        </div>
    </div>
    <header id="masthead">
        <div class="site-header">
            
             <!--site branding-->
            <?php 
            /**
             * include module action 'lds_travel_include_module_multiple' , 'module name' , 'tpl name';
             * Important: module folder name (module-name), main php file (module-name.php) and content/layouts/ should have (module-name.php)
             * action registered in custom-function.php
             */
            do_action( 'lds_travel_include_module_multiple','brand','');
            ?>
            <!-- .site-branding -->

            <?php
            do_action( 'lds_travel_include_module_multiple','phone','');
            ?>
            

        </div><!-- .site-header -->

        <?php
        do_action( 'lds_travel_include_module_multiple','navigation','');
        ?>

    </header><!-- #masthead -->
    <div class="metabar--spacer"></div>
</div><!--.container-fluid-->
<div id="content" class="site-content">