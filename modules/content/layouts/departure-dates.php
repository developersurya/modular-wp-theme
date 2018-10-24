<?php 
/**
 * This file work as data modal.
 * Contains departure dates related query and variables.
 * #MUST have in single post ID 
 */
//check the slug of new date post
$post_slug = get_post_field( 'post_name', get_post() ); 
    $p_id = false;
    $repeater_data = false;
    $args = array(
        'post_type' => 'departure-dates',
        'name' =>$post_slug,
    );
    $trip_posts = array();
    $loop = new WP_Query($args);
    while($loop->have_posts()): $loop->the_post();
        $p_id = get_the_ID();
        wp_reset_postdata();
    endwhile;

        
        if (have_rows('generate_departure_date', $p_id)) { 
            $data = array();
             while (have_rows('generate_departure_date', $p_id)):the_row();
                if (!empty(get_sub_field('start_date__end_date'))) {
                //date checking
                $dateS = explode('-', get_sub_field('start_date__end_date'));
                $str = explode("/",$dateS[0]);

                //Showing departure dates excatly from today
                //$today = strtotime(date('Y-m-d'));

                //change today date to three days ahead, for booking process current departure date selection is not logical.
                $today = date('Y-m-d');     
                //$today = date('2018-06-23');     
                $today = strtotime(date('Y-m-d', strtotime($today. ' + 3 days')));

                if (strtotime($dateS[0]) >= $today) {

                $repeater_data[]= array(
                        //'count'                 => $count,      
                        'price'                 => get_sub_field('price'),      
                        'discount'              => get_sub_field('discount'),      
                        'discounted_price'      => lds_travel_discounted_price(get_sub_field('price'),get_sub_field('discount')),     
                        'status'                => get_sub_field('status'),      
                        'start_date__end_date'  => get_sub_field('start_date__end_date'),
                        'start_date__only'      => ($dateS[0]),
                        'date_today'            => $today,
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

        //check the condition for group data
        //get_the_ID() will provide Trip post ID as we are in template
        $group_data = "";
        $trip_post_id = get_the_ID();
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
       


  lds_travel_departure_dates($args);