<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data['data_testimonial']);

if ($data['data_testimonial']) {
?>
<div id="testimonial-slider" class="carousel slide">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
        <?php 
        $count= 0;
        foreach($data['data_testimonial'] as $_data){?>
            <li data-target="#testimonial-slider" data-slide-to="0" class="<?php if($count == 0){echo 'active';}?>"></li>
        <?php 
        $count++;
        } ?>
    </ol>
    <!-- Carousel items -->
        <div class="carousel-inner" style="">
        <?php 
        $count= 0;
        foreach($data['data_testimonial'] as $_data){?>
        <?php //var_dump($_data);?>
                <div class="item testimonial <?php if($count == 0){echo 'active';}?>" style="">
                <h4 class="testimonial--title"><?php echo $_data['title'];?></h4>
                <p class="testimonial--content"><?php echo $_data['excerpt'];?></p>
                <span class="testimonial--author"><?php echo $_data['testimony_name'];?></span>                                        
                <div class="testimonial--author-address">
                <?php echo $_data['country'];?>
                </div>
                </div>
        <?php $count++;
        } ?>
    </div>
</div>

<?php
}
?>