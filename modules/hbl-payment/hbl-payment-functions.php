<?php 


// See WP_Theme::get_page_templates 
/**
 * Filters list of page templates for a theme.
 *
 * The dynamic portion of the hook name, `$post_type`, refers to the post type.
 *
 * @since 3.9.0
 * @since 4.4.0 Converted to allow complete control over the `$page_templates` array.
 * @since 4.7.0 Added the `$post_type` parameter.
 *
 * @param array        $post_templates Array of page templates. Keys are filenames,
 *                                     values are translated names.
 * @param WP_Theme     $this           The theme object.
 * @param WP_Post|null $post           The post being edited, provided for context, or null.
 * @param string       $post_type      Post type to get the templates for.
 */

function lds_travel_add_templates( $post_templates, $wp_theme, $post, $post_type ) {
    //add the absolute folders name and template name.
    $post_templates['modules/hbl-payment/page-templates/page-template-hbl-form.php'] = 'Payment Form';
    $post_templates['modules/hbl-payment/page-templates/page-template-hbl-payment-success.php'] = 'Payment Success';
    $post_templates['modules/hbl-payment/page-templates/page-template-bank-transfer.php'] = 'Payment Bank transfer';
    //add page template for independent payment form
    $post_templates['modules/hbl-direct-payment/page-templates/page-template-direct-payment-form.php'] = 'Direct Payment Form';
    $post_templates['modules/hbl-direct-payment/page-templates/page-template-direct-payment-success.php'] = 'Direct Payment Success';
    $post_templates['modules/hbl-direct-payment/page-templates/page-template-direct-payment-Process.php'] = 'Direct Payment Process';

    return $post_templates;
}
add_filter( 'theme_page_templates', 'lds_travel_add_templates', 10, 4 );


/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */
function lds_travel_enqueue_hbl_payment_module_scripts(){
    wp_enqueue_script('hbl-payment-js', MODDIR.'/hbl-payment/js/hbl-payment-script.js', array('jquery'),true);
}
add_action('wp_enqueue_scripts','lds_travel_enqueue_hbl_payment_module_scripts');



/**
 * Bank tranfer and payment option logic
 * @param  [type] $entry [description]
 * @param  [type] $form  [description]
 * @return [type]        [description]
 */
function after_submission_gravityform($entry, $form) {
    //add the entry id form backend
    //Don't forget to off ajax in shortcode. It will break the redirect logic.
    //Aso need to make two pages titled bank-transfer  & payment-form
    if($entry['18'] == "Bank Transfer"){
        $url = site_url() . '/bank-transfer/?bookingID=' . $entry["id"];
    }
    if($entry['18'] == "Pay By Card"){
        $url = site_url() . '/payment-form/?bookingID=' . $entry["id"];
    }
    wp_redirect($url);
    exit;
}
add_action('gform_after_submission_6', 'after_submission_gravityform', 10, 2);


/**
 * Mail notification for online HBL payment
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function lds_travel_bank_account_mail($data){
    //##Get some dynamic content from ACF site options
      ## 1.Get bank details 
      #
        $bank_account_detail = get_field('bank_account_details', 'option');
        $bank_tranfer_user_notification = get_field('bank_tranfer_user_notification', 'option');
        $bank_tranfer_admin_notification = get_field('bank_tranfer_admin_notification', 'option');

        //user notification is active
        if($bank_tranfer_user_notification == "Activate-Show Bank detail in the email only" ){
            //var_dump($data);
            $to = 'surya@lastdoorsolutions.com';
            //$admin_email = get_option( 'admin_email' );
            $subject = 'Direct Bank Payment';
            $body = "Dear ".$data['user_name'].",<br/><br/>
            Thank you for your form submission. 
            <br/><br/>
            Here are some detail you have filled:<br/>
            </hr>

            <br/>Name : ".$data['user_name']."
            <br/>Trip : ".$data['trip_name']."
            <br/>Date departure : ".$data['trip_date_imp']."
            <br/>Email : ".$data['trip_email']."
            <br/>Country : ".$data['trip_country']."
            <br/>Pax : ".$data['trip_pax']."
            <br/>Paymethod : ".$data['trip_paymethod']."
            <br/>Price : ".$data['trip_calprice']."
            </hr>
            <br/>
            ".$bank_account_detail."
            <br/>";

            echo $body;

            $headers = array('Content-Type: text/html; charset=UTF-8');
            $admin_mail = wp_mail( $to, $subject, $body, $headers );
            if($admin_mail){
                echo '<h3>Mail notification has been sent.Thank you.</h3>';
            }else{
                echo '<h3>Mail notification failed.</h3>';
            }
        }


        //Admin notification is active
        //We can still get email from gravity form. This can be used as alternative email with custom values.
        if($bank_tranfer_admin_notification == "Activate"){
            //var_dump($data);
            $to = get_option( 'admin_email' );
            $subject = 'Direct Bank Payment';
            $body = "Dear Admin,<br/><br/>
            New visitor has selected direct bank transfer method. 
            <br/><br/>
            Here are some detail:<br/>
            </hr>

            <br/>Name : ".$data['user_name']."
            <br/>Trip : ".$data['trip_name']."
            <br/>Date departure : ".$data['trip_date_imp']."
            <br/>Email : ".$data['trip_email']."
            <br/>Country : ".$data['trip_country']."
            <br/>Pax : ".$data['trip_pax']."
            <br/>Paymethod : ".$data['trip_paymethod']."
            <br/>Price : ".$data['trip_calprice']."
            </hr>
            <br/>
            <br/>";

            echo $body;

            $headers = array('Content-Type: text/html; charset=UTF-8');
            $admin_mail = wp_mail( $to, $subject, $body, $headers );
            if($admin_mail){
                echo '<h3>Mail notification has been sent.Thank you.</h3>';
            }else{
                echo '<h3>Mail notification failed.</h3>';
            }
        }
   
}

/**
 *Creat metabox for  saving payment details in gravity form entry.
 *
 */
add_filter('gform_entry_detail_meta_boxes', 'register_meta_box', 10, 3);

function register_meta_box($meta_boxes, $entry, $form) {
	if (!isset($meta_boxes['Payment'])) {
		$meta_boxes['Payment'] = array(
			'title' => esc_html__('Payment Details', 'gravityforms'),
			'callback' => 'add_details_meta_box',
			'context' => 'side',
			'callback_args' => array($entry, $form),
		);
	}

	return $meta_boxes;
}

function add_details_meta_box($args) {
	$form = $args['form'];
	$entry = $args['entry'];
	$bookingId = $entry['id'];
	$option_name = 'hbl_payment_result_' . $bookingId;
    $payment_details = get_option($option_name, $default = false);
    
    $payment_details = true;

	//00000001234567890301
	if ($payment_details) {
		$html = '<strong>Paid Amount : $</strong>' . $payment_details['0'] . '<br/>';
		$html .= '<strong>Invoice ID : </strong>' . $payment_details['1'] . '<br/>';
		$html .= '<strong>DateTime : </strong>' . date("d-m-Y", strtotime($payment_details['2'])) . '<br/>';
		$html .= '<strong>PaymentGatewayID : </strong>' . $payment_details['3'] . '<br/>';
		$html .= '<strong>ApprovalCode : </strong>' . $payment_details['4'] . '<br/>';
		$html .= '<strong>RespCode : </strong>' . $payment_details['5'] . '<br/>';
		$html .= '<strong>FraudCode : </strong>' . $payment_details['6'] . '<br/>';
		$html .= '<strong>Pan : </strong>' . $payment_details['7'] . '<br/>';
		$html .= '<strong>TranRef : </strong>' . $payment_details['8'] . '<br/>';

		//$html   .= '<strong>Note : </strong>'.$payment_details['9'].'<br/>';
	} else {
		$html = "Payment detail not available.";
	}
	echo $html;
}
