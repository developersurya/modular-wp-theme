<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//debugger($data,false);

if ($data) {
?>


<div class="overall-rating">
    <span class="rating-msg large"><?php echo $data['av_rating'];?> - <?php echo $data['av_rating_msg'];?></span>
    <div class="rating-list large">
        <ul class="'.$av_rating_text.'">
        <li class="icon-star-outline  icon-star star-one"></li>
        <li class="icon-star-outline  icon-star star-two"></li>
        <li class="icon-star-outline  icon-star star-three"></li>
        <li class="icon-star-outline  icon-star star-four"></li>
        <li class="icon-star-outline  icon-star star-five"></li>
        </ul>
    </div>
    <span class="review-count"> - Based on <a href="#" class="link-to-review"><?php echo $data['num_rating'];?> reviews</a></span>

</div>
<?php
}
?>