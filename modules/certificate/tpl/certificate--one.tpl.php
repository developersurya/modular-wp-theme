<?php 
/**
 * This file contains view part only (HTML) and should NOT contain database related queries
 * #use var_dump($data); to check all available data
 * #use $data['acf_field_name'] to get each field inside loop 
 * #use $data['post_id'] to get default post id and use it in wp function e.g get_the_content($_data['post_id'])
 */
//check what we have in data
//var_dump($data);

if ($data) {
?>
<section class="intro">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 ">
                            <?php
                                $intro_qry = new WP_Query(
                                    array(
                                        'page_id'     => $info_text,
                                        'post_status' => 'publish',
                                    )
                                );
                        
                                if( $intro_qry->have_posts() ){
                                    while( $intro_qry->have_posts() ){
                                        $intro_qry->the_post();
                            ?>
                            <div class="text-holder">
                              <h2 class="section-title"><?php the_title(); ?></h2>
                              <?php the_excerpt(); ?>
                              <?php if ( $info_readmore_text ) { ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-border"><?php echo esc_html( $info_readmore_text ); ?></a>
                              <?php } ?>
                            </div>
                            <?php } } ?>
                        </div>
                        <?php if( $info_youtube_link ){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <div class="media-holder">
                                    <?php $allowed_tags = array( 
                                        'iframe' => array( 
                                            'width' => array(), 
                                            'height' => array(), 
                                            'src' => array(), 
                                            'frameborder' => array(), 
                                            'gesture' => array(), 
                                            'allowfullscreen' => array() 
                                        ) 
                                    );
                                    echo wp_kses( $info_youtube_link, $allowed_tags ); ?> 
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
<?php }