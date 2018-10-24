<?php
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_departure_dates_admin_scripts() {
    
    wp_enqueue_script('lds-travel-dd-admin-script', get_template_directory_uri() . '/modules/departure-dates/js/departure-dates.js', array('jquery'), true);
    wp_localize_script( 'lds-travel-dd-admin-script', 'admin_ajax', array(
        'url' => admin_url( 'admin-ajax.php'),'postID' => get_the_ID()
    ));
    
}
add_action('wp_enqueue_scripts', 'lds_travel_departure_dates_admin_scripts');

/**
 * Ajax Search functions for departure date
 */

function lds_travel_departure_date_ajax_filter(){
    $search_year = $_POST['search_year'];
    $search_month = sprintf("%02d", $_POST['search_month']);// making two digit number
    $search_group =  $_POST['search_group'];
    $search_post_id =  $_POST['post_id'];
    $departure_post_id =  $_POST['departure_post_id'];

    $split_group = explode("-",$search_group);
    $pax = $split_group[0];

    //Choosing Year is compulsory
    if($search_year == "0"){
        echo "<tr><td>Please Choose the Year.</td><th></th></tr>";die();
    }

    $post_slug = get_post_field( 'post_name', get_post() ); 
    $p_id = false;
    $repeater_data = false;

        $p_id = $departure_post_id;
        
         if (have_rows('generate_departure_date', $p_id)) { 
            $data = array();
             while (have_rows('generate_departure_date', $p_id)):the_row();
                if (!empty(get_sub_field('start_date__end_date'))) {
                //date checking
                $dateS = explode('-', get_sub_field('start_date__end_date'));
                $str = explode("/",$dateS[0]);

                //Only selected Year 
                if($search_year && $search_month == "00"){ 
                    $start_today = $search_year.'-01-01'; 
                    $end_today = $search_year.'-12-30'; 
                }
                //selected both month and year
                if($search_year && $search_month != "00"){    
                    $start_today =$search_year.'-'.$search_month.'-01'; 
                    $end_today = $search_year.'-'.$search_month.'-30'; 

                }
                //Add logic of three days ahead only
                if(strtotime($start_today) === strtotime(date('Y-m-d'))){ 
                    $sday = date('Y-m-d', strtotime($start_today. ' + 3 days'));
                }else{
                    $sday = $start_today;
                }

                // var_dump($sday);
                //  var_dump($today);
                // var_dump($end_today);

                if (strtotime($dateS[0]) >= strtotime($sday) && strtotime($dateS[0]) < strtotime($end_today)) {

                $repeater_data[]= array(
                        //'count'                 => $count,      
                        'price'                 => get_sub_field('price'),      
                        'discount'              => get_sub_field('discount'),      
                        'discounted_price'      => lds_travel_discounted_price(get_sub_field('price'),get_sub_field('discount')),     
                        'status'                => get_sub_field('status'),      
                        'start_date__end_date'  => get_sub_field('start_date__end_date'),
                        'start_date__only'      => ($dateS[0]),
                        'date_today'            => $start_today,
                        'date_array'            =>  $str 
                        );
                
                }
            }
            endwhile;
        }

        //re-order the data according to date

        function sortFunction( $a, $b ) {
            return strtotime($a["start_date__only"]) - strtotime($b["start_date__only"]);
        }
        if(!empty($repeater_data)){
        usort($repeater_data, "sortFunction");
        //var_dump($repeater_data);
        }

        //check the condition for group discount
        $trip_post_id = $_POST['post_id'];
        if (have_rows('group_discount', $trip_post_id)) { 
            $group_data = array();
             while (have_rows('group_discount', $trip_post_id)):the_row();
                if (!empty(get_sub_field('group_range'))) {
                    $group_range = get_sub_field('group_range');
                    $price_per_person = get_sub_field('price_per_person');
                    $group_data[] = array(
                        'group_range' =>  $group_range,
                        'price_per_person' =>  $price_per_person,
                    );
                }
            endwhile;
        }

        $args = array(
            'p_id'=>$p_id,
            'data'=>$repeater_data,
            'group_data' =>$group_data
        );
       //check the condition for group data price set or not
                            //var_dump($search_group);
                            //var_dump($args['group_data']);
       
                        if($search_group){
                            $grp_price_index = array_search($search_group, array_column($args['group_data'], 'group_range'));
                            //var_dump($grp_price_index);
                            $grpfinal_price = $args['group_data'][$grp_price_index]["price_per_person"];
                        }
                        ($grpfinal_price)? $final_price = $grpfinal_price : $final_price = $data['price']; 
                            
                        
        //output results
         if (!empty($args['data'])) { 
                    $count=1;
                    $month_arr = array();
                     foreach($args['data'] as $data) {
                        var_dump($data);
                        ?>
                        <tr data-year="<?php echo trim($data['date_array']['2']);?>" data-month="<?php echo $data['date_array']['0'];?>">
                            <!-- <th scope="row"><?php //echo $count;?></th> -->
                            <td><?php echo $data['start_date__end_date'];?></td>

                            <td><?php echo (!$grpfinal_price)?"USD <del>".$data['price']."</del> ":"USD ".$final_price;?> 
                            <?php echo ($grpfinal_price)?"":"USD ".$data['discounted_price'].'';?>
                            </td>
                            <!-- <td><?php //echo $data['discount'].'%';?></td>
                            <td><?php //echo $data['status'];?></td> -->
                            <td><button type="button" class="btn btn-secondary"><a href="<?php echo site_url().'/trip-booking/?tid='.$search_post_id.'&dt='.$data['start_date__end_date'].'&px='.$pax;?>">Book Now</a></button>
                            <!-- trigger trip-forms module and activate general enquiry form -->
                             </td>
                              <?php //var_dump($month_arr);?>
                        </tr>
                 <?php
                    $month_arr[] = $data['date_array']['0'];

                 $count++;
            }?>
            <tr>
            <tr class="month_arr" style="display:none;"><th></th><td><?php //var_dump($month_arr);//contains months data to be hide in dropdown
            $months = array();
            foreach($month_arr as $month){
                $months[] = ltrim($month, '0');
            }
            foreach(array_unique($months) as $m){
                echo "<p class='filter-months'>".$m."</p>";
            }

            ?></td></tr></tr>
             <script>
                if(jQuery('#search-ajax-month').val() == "monthlist0"){
                    var mo = jQuery('.filter-months');
                    jQuery('#search-ajax-month option').hide();
                    jQuery('#search-ajax-month option').eq(0).show()
                    mo.each(function( index ) {
                        mo_remove = parseInt(jQuery(this).html());
                        jQuery('#search-ajax-month option').eq(mo_remove).show()
                    });  
                }
            
            </script>
        <?php }else{

            echo "No results Found"; 

        }?>
       
        <?php die();
}

//ajax filter action 
add_action( 'wp_ajax_lds_travel_departure_date_ajax_filter', 'lds_travel_departure_date_ajax_filter' );
add_action( 'wp_ajax_nopriv_lds_travel_departure_date_ajax_filter', 'lds_travel_departure_date_ajax_filter' );