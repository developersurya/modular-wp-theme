<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);
 ?>
<?php if (!empty($data)): ?>
    <div class="quick-contact--menu-secondary">
        <ul class="quick-contact clearfix">
        <?php // loop through the rows of data
        foreach ( $data as $_data){
            ?>
            <li>
                <span class="contact-region"><?php echo $_data['phone_label']; ?></span>
                <a class="quick-contact-main" href="tel:<?php echo $_data['phone_number']; ?>">
                    <span class="icon-phone"></span><span
                        class="num"><?php echo $_data['phone_number']; ?></span>
                </a>
            </li>
        <?php  } ?>
        </ul>
    </div>
<?php endif;?>