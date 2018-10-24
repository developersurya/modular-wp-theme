<?php 
/**
 * This file contains view part only (HTML)
 * #use var_dump($data); to check all available data
 * #use this popup model for general enquiry form
 */
?>
<!-- Button trigger modal 
### This button will be in wp template file
###add class="general-enquiry-form" data-toggle="modal" data-target="#general-enquiry-form" in button or anchor html  -->
<!-- <button type="button" class="btn btn-primary general-enquiry-form" data-toggle="modal" data-target="#general-enquiry-form" >
  Launch demo modal
</button> -->

<!-- Modal -->
<div id="enquiry-popup-form" style="display:none; max-width:900px;">
  <?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="23"]'); ?>
</div>
<?php if(is_single()){ ?>
<div class="title-for-modal" style="display: none;">
    <?php  echo get_the_title();?>
</div>
<?php };?>
