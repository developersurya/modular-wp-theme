<?php 
 // process the url parameter 
    $trip_id = $data['trip_id'];
    //get the trip costs
    $initial_price_u = get_field('trip_cost',$trip_id);
    //var_dump($data);
    //get the trip data form class
    $trip_data = new Trip_Form_Data();
    $trip_id = $trip_data->get_trip_id();
    $trip_url_date = $trip_data->get_trip_url_date();
    $trip_url_pax = $trip_data->get_trip_url_pax();
    $trip_departure_data = $trip_data->get_repeater_data();

    ?>
<!--Need group data for JS calculation-->
<div class="hide group-price-range" style="display:none;">
    <?php foreach($data['group_price'] as $data){?>
        <p><strong><?php echo $data['group_range'];?></strong><span><?php echo $data['price_per_person'];?></span></p>
    <?php }?>
</div>


    <div class="container booking-form">
        <div class="row">
            <div class="form-container">
            <h1 class="border-btm">  
                    <?php
                    echo $trip_data->get_trip_title();
                     ?>
                </h1>
                <?php 
                //Booking form with trip details with HBL payment. 
                //##IMPORTANT: change the form ID with payment detail
                echo do_shortcode('[gravityform id=6 title=false description=true ajax=fasle tabindex=49]');?>
                <!--New logic for HBL payment in gravity form-->
                <div class="button-process-booking">
                    <button type="button" class="gform_button btn button gravity-process-payment btn-dark">Pay By Card</button>
                    <button type="button" class="gform_button btn button gravity-direct-bank btn-dark">Bank Transfer</button>
                </div>
                <!--End of New logic for HBL payment in gravity form-->
            </div>
        </div>
    </div>

<style>
    .payment-method-select, .booking-form .gform_footer  {
    xdisplay: none;
}
</style>
<script>
        jQuery(document).ready(function($){
        // console.log('hbl payment..');
        // debugger;
        var initial_price    = '<?php echo $initial_price_u; ?>';
        var initial_price_n  = '<?php echo number_format($initial_price_u); ?>';
        var inital_price_dis = Math.round(initial_price*.3);
        var trip_url_pax     = '<?php echo $trip_url_pax; ?>';
        var trip_date        = '<?php echo $trip_url_date;?>';

        //check if pax is already there
            if(trip_url_pax != ""){
                $('.number-of-pax select').val(trip_url_pax);
                $('.number-of-pax select').trigger('change');
                setTimeout(function(){ $('.number-of-pax select').trigger('change'); },2000);
            }
        
            if($('.booking-form-departure select').val() == "" || $('.booking-form-departure select').val() == "date"){
                $('.booking-form-departure select').append('<option value="'+trip_date+'" selected>'+trip_date+'</option>');
            }
        
        $('.payment-method').after('<div class="cal-price"><strong>Your Total Payment: <p class="dollor-sign">USD </p></strong><span> '+inital_price_dis+'</span></div>');


        //check for group price
        var price_range = $('.group-price-range p');
        if(price_range.length != 0){

        //new logic for minium grp price
            var grp_range = price_range[0].children[0].innerText;
            var grp_range_initial = grp_range.split('-')[0];

            var all_range = $('.number-of-pax select option');
            //debugger;
            //remove extra option in number of pax
            //hide unwanted options
            if(grp_range_initial.length>0){
                for (var i = 1; i < grp_range_initial; i++) {
                  all_range[i].hidden = true;
                }
            }
                //hide 31 to 100 option in Pax
            if(all_range.length>32){
                for (var i = 31; i < 100; i++) {
                  all_range[i].hidden = true;
                }
            }
        }



        $(document).on('change','.number-of-pax select,.payment-method',function(){
                //debugger;
                var checked_payment_method = $('.payment-method input:checked').val();
                var pax = parseInt($('.number-of-pax select').val());

                //remove all append html
                $('.remainging-amount').remove();
                $('.enq').remove();
                

                var initial_price= Math.round('<?php echo $initial_price_u; ?>');

                //check for group price
                var price_range = $('.group-price-range p');

                //calculation for grouped price
                if(price_range.length!=0){
                    var index;
                   
                    for (index = 0; index < price_range.length; ++index) {

                        console.log(price_range[index]);
                        var grp = price_range[index].children[0].innerText;
                        var group_min = grp.split('-')[0];
                        var group_max = grp.split('-')[1];

                       if(pax <= group_max && pax >= group_min){
                            var price_to_cal = price_range[index].children[1].innerText;
                            jQuery('.price-per-person input').val(price_to_cal);
                              if(checked_payment_method=="100%"){
                                   var  f_price = price_to_cal*pax;
                                }else{
                                    var  f_price = Math.round((price_to_cal*.3)*pax);
                                }
                            stop();
                             //debugger;
                                 //remaining amount calculation 
                                if(checked_payment_method=="30%"){    
                                    $('.remainging-amount').remove();
                                    var i_price = price_to_cal;
                                    var r_price = Math.round((i_price)*pax);
                                    var fi_price = Math.round((i_price*.3)*pax);
                                    var remaining_amount = parseInt(r_price) - parseInt(fi_price);
                                    $('.cal-price').after('<p class="remainging-amount">Remaining Amount: USD <span>'+remaining_amount+'</span></p>');
                                     //remaining price input 
                                    $('.remaining-amount input').val(remaining_amount);
                                }

                                //if 100% selected,remove remaining price value.
                                if(checked_payment_method=="100%"){ 
                                     $('.remainging-amount').remove();
                                      $('.remaining-amount input').val('0');
                                }
                       }
                    }

                }


                //calculation for flat discount
                 function calculatePrice(price,pax){
                    var final_price = Math.round(price)*parseInt(pax);
                    return final_price;
                }
                
                if(price_range.length == 0){
                    if(checked_payment_method=="100%"){
                        var price = '<?php echo $initial_price_u; ?>';
                    }else{
                        var price = '<?php echo $initial_price_u; ?>';
                        var price = Math.round(price*.3);
                    }
                    var f_price = calculatePrice(price,pax);
                   
                     //remaining amount calculation 
                    if(checked_payment_method=="30%"){    
                        $('.remainging-amount').remove();
                        var a_price = '<?php echo $initial_price_u; ?>';
                        var r_price = Math.round(a_price*.3*pax);
                        var fi_price =  calculatePrice(a_price,pax);
                        var remaining_amount = parseInt(fi_price) - parseInt(r_price);
                        $('.cal-price').after('<p class="remainging-amount">Remaining Amount: USD <span>'+remaining_amount+'</span></p>');
                         //remaining price input 
                        $('.remaining-amount input').val(remaining_amount);
                    }
                    //if 100% selected,remove remaining price value.
                    if(checked_payment_method=="100%"){ 
                         $('.remainging-amount').remove();
                          $('.remaining-amount input').val('0');
                    }

                }

                //append price after calculation
                $('.cal-price span').html(' '+f_price);
                $('#input_13_45').val(f_price);
                $('#input_2_43').val(f_price);



            });

        //add price per person
        //jQuery('.price-per-person').html('Price Per Person: <span class="price-per-color">US $'+initial_price+'</span>');
        jQuery('.price-per-person input').val(initial_price_n);

         //change the default value (participants) to 1 if not selected after changing 30% or 100%
         $('.payment-method').change(function(){
            if($('.number-of-pax select').val() == 0){
                $('.number-of-pax select').val('1');
            }
        });

         //hide pre-define date if its empty
        
            //new wire & payment button  logic
            $(document).on('click','.gravity-process-payment,.gravity-direct-bank',function(){
                //debugger;
                $('.payment-method-select input').val($(this).html());
                $('.booking-form .gform_footer input[type="submit"]').trigger('click');
            });

        });
</script>
