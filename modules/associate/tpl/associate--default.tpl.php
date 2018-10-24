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
<section class="featured-on">  
    <div class="container"> 
        <header class="section-header-associated col-lg-12 ">
            <div class="row"> 
                <span class="heading-title">Associated With</span> 
            </div> 
        </header> 
    </div>
    <div class="associate-wrp"> 
            
            <?php  foreach( $data as $_data){?>

                    <div class="associated-inner">
                        <?php if($_data['image_logo']){ ?>
                        <a target="_blank" href="<?php echo $_data['link']; ?>">
                            <img src="<?php echo $_data['image_logo']['url']; ?>" alt="<?php echo $_data['image_url']; ?>">
                        </a>
                        <?php } ?>
                    </div>
                    
            <?php } ?>

    </div>            
</section>      
<?php endif; ?>