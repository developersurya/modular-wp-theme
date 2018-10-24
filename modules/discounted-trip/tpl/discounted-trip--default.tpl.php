<?php 
/**
 * This file contains view part only (HTML)
 * #use var_dump($data); to check all available data
 * #use $_data['acf_field_name'] to get each field inside loop 
 * #use $_data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
?>
<?php //var_dump($data); ?>
 <?php if (!empty($data)): ?>
    <div class="container">
        <div class="row">
            <h3>Discounted Trips</h3>
        </div>
        <div class="row">

        <?php foreach ($data as $_data): ?>
            <div class="col-sm-4">
                <div class="card" >
                    <?php if($_data['featured_image']){?>
                        <img class="card-img-top" src="<?php echo esc_url($_data['featured_image']);?>" alt="<?php echo $_data['featured_image_caption'];?>">
                        <?php } ?>
                  <div class="card-body">
                    <strong class="card-title"> <?php echo $_data['post_title']; ?>
                    <?php if($_data['days']){?> - <span> 
                        <?php echo $_data['days']; ?>
                        </span>
                            <?php } ?></strong>
                    <p class="card-subtitle mb-2 text-muted">
                        <div class="row">
                        <?php if ($_data['trip_type']): ?>
                            <div class="col-md-6">
                                <p>Type:<span><mark> <?php echo $_data['trip_type']; ?></mark></span></p>
                            </div>
                            <?php endif; ?>
                            <?php if($_data['trip_cost']){?>
                                <div class="col-md-6">
                                    <?php 
                                    // check if discounted on price
                                    $trip_cost_discounted = "";
                                    if($_data['discount_percentage'] ){
                                        $trip_cost_discounted = (int)$_data['trip_cost']-(((int)$_data['trip_cost'] * $_data['discount_percentage'])/100);
                                    } 
                                    ?>
                                    <p><span> $<?php echo $_data['trip_cost']; ?> 
                                    <?php if($trip_cost_discounted){?>
                                        <span>
                                            <del><?php echo $trip_cost_discounted; ?></del>
                                        </span>
                                    <?php } ?>
                                    PP</span></p>
                                </div>
                            <?php } ?>

                        </div>
                    </p>
                    <p class="card-text"><?php echo wp_trim_words( $_data['post_content'], $num_words = 25, $more = null ); ?></p>
                    <a href="<?php echo esc_url(get_the_permalink($_data['post_id']));?>" class="btn btn-primary" class="card-link">
                        <?php esc_html_e('See More','');?>
                    </a>
                  </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php ?>


