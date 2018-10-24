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
<section class="section-tripadviser">
            <div class="container">
                <?php if( $data['trip_advisor_title'] ){ ?>
                <header class="section-header col-lg-12 ">
                    <div class="row">
                        <span class="heading-title"><?php echo esc_html( $data['trip_advisor_title'] ); ?></span>
                    </div>
                </header>
                <?php } if( $data['trip_advisor_desc'] ){ ?>
                <div class="top-description">
                   <?php echo wpautop( wp_kses_post( $data['trip_advisor_desc'] ) ); ?>
                </div>
                <?php } ?>
                <div class="col-lg-offset-1 col-lg-10">
                    <div class="content-panel">
                        <?php if ( is_active_sidebar( 'left-trip-advisor-widget' ) ) : ?>
                            <div class="left-panel">
                                <?php dynamic_sidebar( 'left-trip-advisor-widget' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'right-trip-advisor-widgets' ) ) : ?>
                            <div class="right-panel">
                                <ul class="items">
                                    <?php dynamic_sidebar( 'right-trip-advisor-widgets' ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php }