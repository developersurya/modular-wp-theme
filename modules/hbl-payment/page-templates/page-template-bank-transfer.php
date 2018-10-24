<?php
/**
 * Template Name: Payment Bank transfer
 * The template for displaying trip booking form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LDS_Travel
 */

get_header();
//include content file here.
// Page template does not support include method like tpl.
include( lds_travel_get_stylesheet_path().'/modules/content/layouts/hbl-payment.php');
/**
 * Activate email notification for bank account and other detials .  
 */
lds_travel_bank_account_mail($data);
?>

<div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <h5 class="card-header">Here are details you have submitted.</h5>
                            <div class="card-body">
                                <h5 class="card-title">Thank you for your details.</h5>
                                <p class="card-text">You will receive mail regarding bank details and account numbers.</p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Name : <?php echo $data['user_name'];?></li>
                                    <li class="list-group-item">Trip : <?php echo $data['trip_name'];?></li>
                                    <li class="list-group-item">Date departure : <?php echo $data['trip_date_imp'];?></li>
                                    <li class="list-group-item">Email : <?php echo $data['trip_email'];?></li>
                                    <li class="list-group-item">Country : <?php echo $data['trip_country'];?></li>
                                    <li class="list-group-item">Pax : <?php echo $data['trip_pax'];?></li>
                                    <li class="list-group-item">Paymethod : <?php echo $data['trip_paymethod'];?></li>
                                    <li class="list-group-item">Price : <?php echo $data['trip_calprice'];?></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="bank-detail">
                        <?php if($data["bank_tranfer_user_notification"] == "Deactivate-Show Bank detail in the page"){?>
                            <div class="alert alert-warning" role="alert">
                               <?php
                                    echo $data['bank_account_detail'];  
                                ?>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
</div>

<?php
get_sidebar();
get_footer();