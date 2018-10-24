<?php
/**
 * 
 * Template Name: Payment Form
 * The template for displaying trip booking form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LDS_Travel
 */

get_header();
//include content file here.
// Page template does not support include method like tpl. So, include it directly
 include( lds_travel_get_stylesheet_path().'/modules/content/layouts/hbl-payment.php');
if($data['bookingId']){
?>

<div class="container">
    <div class="row">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="container contact-us" >
                    <div class="row">
                        <div class="col-lg-12 clearfix" style="display: none;">
                          <h6></h6>
                          <?php
                          $signData = hash_hmac('SHA256', "signatureString",'L3YN0LCZM6JFGMGA49XS7FK07BIHLA3L', false);
                          $signData = strtoupper($signData);
                          $hash_code =  urlencode($signData);
                          $querystrr = "SELECT option_value FROM 0a6y1m9_options 
                                        WHERE  option_id=(
                                            SELECT max(option_id) FROM 0a6y1m9_options WHERE option_name LIKE '%hbl_payment_result_%' 
                                            )";
                                         $payposts = $wpdb->get_results($querystrr);
                                         $invoice = unserialize($payposts[0]->option_value);
                                         $invoice_number = intval($invoice[1]);
                                         $new_invoice = $invoice_number+1;
                                         $input = 1234;
                                         $n_invoice = str_pad($new_invoice, 20, "0", STR_PAD_LEFT);//echo $n_invoice; previously
                                                function random_invoice() {
                                                  $number = "";
                                                  for($i=0; $i<20; $i++) {
                                                    $min = ($i == 0) ? 1:0;
                                                    $number .= mt_rand($min,9);
                                                  }
                                                  return $number;
                                                }
                            //echo random_invoice();die();
                          ?>
                          <div class="payment-form form-container">
                            <Form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" id="process-form">
                              <input type="text" id="paymentGatewayID" name="paymentGatewayID" value="9103332318" hidden>
                              <input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo random_invoice();?>" hidden>
                              <input type="text" id="currencyCode" name="currencyCode" value="840" hidden>
                              
                              <div class="form-group">
                                <label>Trip Name</label>
                                <input type="text" id="productDesc" name="productDesc" value="<?php if(!empty($data['trip_name'])){ echo $data['trip_name'];}else{ echo "Trip";}?>" >
                              </div>
                              <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" id="fullname" name="userDefined1" value="<?php if(!empty($data['user_name'])){ echo $data['user_name'];}else{ echo "User Name";}?>" >
                              </div>
                              
                              <div class="row">
                                <div class="col-md-6 col-xm-12">
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" id="paymentEmail" name="userDefined5" value="<?php if(!empty($data['trip_email'])){ echo $data['trip_email'];}else{ echo "Email";}?>" >
                                  </div>
                                </div>
                                <div class="col-md-6 col-xm-12">
                                  <div class="form-group">
                                    <label>Booking ID</label>
                                    <input type="text" id="paymentBookingId" name="userDefined3" value="<?php if(!empty($bookingId)){ echo $bookingId;}else{ echo "Booking ID";}?>" >
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-xm-12">
                                  <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" id="amount" name="amount" value="<?php if($data['trip_calprice']){ echo $data['trip_calprice'];}?>" placeholder="$<?php if($data['trip_calprice']){ echo $data['trip_calprice'];}?>" required>
                                    
                                  </div>
                                </div>
                                <div class="col-md-6 col-xm-12">
                                  <div class="form-group">
                                    <label>Booking Date</label>
                                    <input type="text" id="paymentBookingDate" name="userDefined4" value="<?php if(!empty($data['trip_date'])){ echo $data['trip_date'];}else{ echo "Booking trip date";}?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" id="paymentNote" name="userDefined2" value=""><?php if(!empty($paymentNote)){ echo $paymentNote;}else{ echo "Payment Note";}?></textarea>
                                  </div>
                                </div>
                              </div>
                              
                              <input type="text" id="nonSecure" name="nonSecure" value="N" hidden>
                              <input type="text" id="hashValue" name="hashValue" value="<?php echo $hash_code;?>" hidden>
                              <button type="submit" class="pay-button">Submit</button>
                            </Form>
                            
                            <script type="text/javascript">

                            </script>
                          </div>
                        </div>
                    </div>
                </div>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>
<style>
    .payment-form input {
      border: 2px solid #d3d3d1;
      -webkit-box-shadow: 0 0 6px 1px #efefed;
      -moz-box-shadow: 0 0 6px 1px #efefed;
      box-shadow: 0 0 6px 1px #efefed;
      color: #000;
      font-size: 14px;
      font-size: 1.4rem;
      font-family: 'Open Sans', sans-serif;
      font-weight: 600;
      height: 45px;
      padding: 10px;
      width: 100%;
      pointer-events: none;
    }
    .payment-form label {
      display: inline-block;
      max-width: 100%;
      margin-bottom: 5px;
      font-size: 12px;
    }
    .text-muted{
      display:none;
      color: #f11111;
    }
    .payment-form .pay-button {
      background: #262626;
      box-shadow: none;
      border: 1px solid #262626;
      text-transform: uppercase;
      padding: 10px 40px;
      font-size: 12px;
      color: #fff;
      text-align: center;
    }
    .payment-form textarea.form-control {
      height: 200px;
      background: #fff;
      width: 100%;
      margin: 0 auto;
      border: 2px solid #d3d3d1;
      border-radius: 2px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
      -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
      -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
      color: #111;
      font-weight: bold;
    }
    input#amount {
      background: #fff;
      color: #fff;
    }
    .overprice {
      position: absolute;
      top: 40px;
      left: 20px;
    }
</style>
<script>
  jQuery('.payment-form  input[type=text]').blur(function()
    {
      if( !jQuery(this).val() ) {
        jQuery(this).next().show();
      }else{
        jQuery(this).next().hide();
      }
    });
    //change price formatt for HBL API
    function padDigits(number, digits) {
      return Array(Math.max(digits - String(number).length + 1, 0)).join(0) + number;
    }
    //add data in first input
    jQuery('.payment-form').ready(function(){
      var user_data = jQuery('#fullname').val()+'//'+jQuery('#paymentEmail').val()+'//'+jQuery('#paymentBookingId').val()+'//'+jQuery('#paymentBookingDate').val()+'//'+jQuery('#productDesc').val();
      jQuery('#fullname').val(user_data);
      var user_price = '<?php  echo $data['trip_calprice'];?>';
      var formatted_price = padDigits(user_price,10)+'00';
      jQuery('#amount').val(formatted_price);
      document.getElementById("process-form").submit();
    });
</script>
<?php
}
get_sidebar();
get_footer();