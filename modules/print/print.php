<?php
/**
 * This file work as controller to link tpl and content file.
 * Discounted Trip will fetch according to the discount percentage in ACF fields 
 * # Check the content/layouts/print.php for query details
 * ## This module used in header section 
 * @param  $data query data from ACF and wp 
 * 
 */

//##TO prevent multiple function declaration , Use direct tpl include
//##ONLY for repeater module

if($tpl_name){
    include('tpl/print--'.$tpl_name.'.tpl.php');
}else{
    include('tpl/print--default.tpl.php');
}

