<?php
/**
 * 
 * Template Name: print
 * The template for displaying trip booking form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LDS_Travel
 */

//get_header();//we do not need header and it's style
//include content file here.
// Page template does not support include method like tpl.
include( lds_travel_get_stylesheet_path().'/modules/content/layouts/print.php');
$url = $_SERVER['QUERY_STRING'];
$url_arr = explode('print=', $url);
if(isset($url_arr[1])){
$data = pdf_content($url_arr[1]);
}
echo $data;
?>

<?php
//we do not need footer and it's style
//get_sidebar();
//get_footer();