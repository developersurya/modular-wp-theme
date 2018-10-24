<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);
if ($data) {?>
    <div class="sidebar-item expert-listing">
        <h5 class="sidebar-item-title">Speak to an Expert? </h5>
       
        <ul class="trip-expert">
            <?php foreach($data as $_data){
                ?>
                <li class="trip-expert__item">
                    <div class="trip-expert__image">
                        <img src="<?php echo $_data["featured_img"];?>">
                    </div>
                    <div class="trip-expert__detail">
                        <div class="trip-expert__name"><?php echo $_data['post_title'];?></div>
                            <div class="trip-expert__phone">Phone: <?php  echo $_data['post_content'];?></div>
                    </div>
                </li>
            <?php 
                }?>
        </ul>
    </div>
    <?php }
?>              