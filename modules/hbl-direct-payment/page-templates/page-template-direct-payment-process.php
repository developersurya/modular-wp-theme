test<?php
/**
* Template Name: Direct Payment Proccess
*/
get_header();
//include content file here.
// Page template does not support include method like tpl.
include( lds_travel_get_stylesheet_path().'/modules/content/layouts/hbl-direct-payment.php');

//get raw data form gravity form
$bookingId = $data['bookingId'];
$form_data = GFAPI::get_entry( $bookingId );
//var_dump($form_data);

if($bookingId){
    if($form_data['form_id'] == 5){ //change form id if necessary
        $independent_user_name        = isset($data['user_name'])?$data['user_name']:"";
        $independent_trip_name        = isset($data['trip_name'])?$data['trip_name']:"";
        $independent_trip_nationality = isset($data['trip_nationality'])?$data['trip_nationality']:"";
        $independent_trip_address     = isset($data['user_name'])?$data['user_name']:"";
        $independent_trip_email       = isset($data['trip_email'])?$data['trip_email']:"";
        $independent_trip_phone       = isset($data['trip_phone'])?$data['trip_phone']:"";
        $independent_trip_calprice    = isset($data['trip_calprice'])?$data['trip_calprice']:"";
    }
}
?>


<div class="container">
  <div class="row  contact-us">
    <div class="col-lg-12">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          the_content();
      ?>
      <?php
       $signData = hash_hmac('SHA256', "signatureString",'L3YN0LCZM6JFGMGA49XS7FK07BIHLA3L', false);
       $signData = strtoupper($signData);
       $hash_code =  urlencode($signData);

        function generate_invoice_id($digits = 20){
          $i = 0; //counter
          $pin = ""; //our default 
          while($i < $digits){
              //generate a random number between 0 and 9.
              $pin .= mt_rand(0, 9);
              $i++;
          }
          return $pin;
        }
        ?>  
      <div class=""  >
        <h1 class="page-heading"><?php //the_content();?></h1>
        
        <div class="direct-payment-form form-container" style="display: none;">
          <Form method="post" action="https://hblpgw.2c2p.com/HBLPGW/Payment/Payment/Payment" id="process-form">
            <input type="text" id="paymentGatewayID" name="paymentGatewayID" value="9103332318" hidden>
            <input type="text" id="invoiceNo" name="invoiceNo" value="<?php echo generate_invoice_id();?>" hidden>
            <input type="text" id="currencyCode" name="currencyCode" value="840" hidden>
            
            <div class="form-group">
              <label>Trip Name</label>
              <input type="text" id="productDesc" name="productDesc" value="<?php if(!empty($independent_trip_name)){ echo $independent_trip_name;}else{ echo "Trip";}?>" >
            </div>
            <div class="form-group">
              <label>Full Name</label>
              <input type="text" id="fullname" name="userDefined1" value="<?php if(!empty($independent_user_name)){ echo $independent_user_name;}else{ echo "User Name";}?>" >
            </div>
            
            <div class="row">
              <div class="col-md-6 col-xm-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" id="paymentEmail" name="userDefined5" value="<?php if(!empty($independent_trip_email)){ echo $independent_trip_email;}else{ echo "Email";}?>" >
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
                  <input type="text" id="amount" name="amount" value="" placeholder="$<?php if($independent_trip_calprice){ echo $independent_trip_calprice;}?>" required>
                  
                </div>
              </div>
              <div class="col-md-6 col-xm-12">
                <div class="form-group">
                  <label>Nationality</label>
                  <input type="text" id="independent_trip_nationality" name="userDefined4" value="<?php if(!empty($independent_trip_nationality)){ echo $independent_trip_nationality;}else{ echo "Nationality";}?>" required>
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
            <button type="submit" class="pay-button" id="process-direct-pay">Submit</button>
          </Form>
          
        </div>
      </div>
      <?php
        } // end while
      } // end if
      ?>
    </div>
  </div>
</div>

<script>
    jQuery('.direct-payment-form  input[type=text]').blur(function()
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
    jQuery(document).ready(function(){
      //debugger;
      var user_data = jQuery('#fullname').val()+'//'+jQuery('#paymentEmail').val()+'//'+jQuery('#paymentBookingId').val()+'//'+jQuery('#independent_trip_nationality').val()+'//'+jQuery('#productDesc').val();
      jQuery('#fullname').val(user_data);
      var user_price = '<?php echo $independent_trip_calprice;?>';
      var formatted_price = padDigits(user_price,10)+'00';
      jQuery('#amount').val(formatted_price);
      jQuery("#process-direct-pay").click();
    });

  </script>

<?php get_footer();?>