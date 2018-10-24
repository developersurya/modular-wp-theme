<?php 
/**
 * This file contains view part only (HTML)
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);
//use LINK <?php echo site_url().'/print/?print='.get_the_ID(); in button required.
?>

<!-- Use This as general Button
    <a href="<?php //echo site_url().'/print/?print='.get_the_ID();?>" class="print-page">Print</a> 
    -->
<a class="btn btn-dossier" target="_blank" href="<?php echo site_url().'/print/?print='.get_the_ID();?>"><i class="file"></i>View Dossier Online</a>