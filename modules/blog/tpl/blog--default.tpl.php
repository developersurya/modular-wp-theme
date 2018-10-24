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
<section class="latest-blog">
        <div class="container">
            <header class="section-header col-lg-12">
                <div class="row">
                    <span class="heading-title">LATEST FROM OUR BLOG</span>
                </div>
            </header>
            <div class="row">
                <?php foreach($data as $_data){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 primary-box">
                            <?php if ($_data['image_thumb']) {
                                ?>
                                <figure>
                                    <a href="<?php echo $_data['permalink']; ?>"><img src="<?php  echo $_data['image_thumb']['0'];  ?>" alt=""></a>
                                </figure>
                                <?php
                            } ?>
                            <div class="primary-box--content">
                                <h5><a href="<?php echo $_data['permalink']; ?>"> <?php echo $_data['post_title'];  ?> </a></h5>

                                <div class="primary-box--meta">
                                    <?php   echo $_data['posted_date']; 
                                            echo $_data['category']; 
                                     ?>
                                </div>
                                <div class="primary-box--info">
                                    <?php echo wp_trim_words($_data['post_content'], 20); ?>
                                </div>
                            </div>
                    </div>

                <?php } ?>
            </div>
        </div>
    </section>
<!--end of latest blog section-->

<?php endif;?>