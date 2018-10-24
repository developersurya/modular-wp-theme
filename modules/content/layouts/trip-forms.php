<?php 

//### all code has been changed to class method##
//####kept as backup####
// // process the url parameter 
// $parameter = $_SERVER['REQUEST_URI'];
// $query = parse_url($parameter, PHP_URL_QUERY);
// parse_str($query, $params);
// $trip_post_id = $params['tid'];

// $data = get_post( $trip_post_id , ARRAY_A ); //to check all data of trip post.

// //get group data
// //Required Trip ID 
// if (have_rows('group_discount', $trip_post_id)) { 
//     $group_data = array();
//      while (have_rows('group_discount', $trip_post_id)):the_row();
//         if (!empty(get_sub_field('group_range'))) {
//             $group_range = get_sub_field('group_range');
//             $price_per_person = get_sub_field('price_per_person');
//             $group_data[] = array(
//                 'group_range' =>  $group_range,
//                 'price_per_person' =>  $price_per_person,
//             );
//         }
//     endwhile;
// }

// //get departure date data
// //Required departure post ID related with Trip ID
//     $post_data   = get_post( $trip_post_id ); 
//     //get the slug from trip ID. It will use to get the same slug departure post to get the matched departure date.
//     $departure_id = false;
//     $repeater_data = false;
//     $args = array(
//         'post_type' => 'departure-dates',
//         'name' =>$post_data->post_name,
//     );
//     $trip_posts = array();
//     $loop = new WP_Query($args);
//     while($loop->have_posts()): $loop->the_post();
//         $departure_id = get_the_ID();
//         wp_reset_postdata();
//     endwhile;
//     //var_dump($departure_id); //check the departure post ID



// if (have_rows('generate_departure_date', $departure_id)) { 
//     $repeater_data = array();
//         while (have_rows('generate_departure_date', $departure_id)):the_row();
//         if (!empty(get_sub_field('start_date__end_date'))) {
//         //date checking
//         $dateS = explode('-', get_sub_field('start_date__end_date'));
//         $str = explode("/",$dateS[0]);

//         //Showing departure dates excatly from today
//         //$today = strtotime(date('Y-m-d'));

//         //change today date to three days ahead, for booking process current departure date selection is not logical.
//         $today = date('Y-m-d');     
//         //$today = date('2018-06-23');     
//         $today = strtotime(date('Y-m-d', strtotime($today. ' + 3 days')));

//         if (strtotime($dateS[0]) >= $today) {

//         $repeater_data[]= array(
//                 //'count'                 => $count,      
//                 'price'                 => get_sub_field('price'),      
//                 'discount'              => get_sub_field('discount'),      
//                 'discounted_price'      => lds_travel_discounted_price(get_sub_field('price'),get_sub_field('discount')),     
//                 'status'                => get_sub_field('status'),      
//                 'start_date__end_date'  => get_sub_field('start_date__end_date'),
//                 'start_date__only'      => ($dateS[0]),
//                 'date_today'            => $today,
//                 'date_array'            =>  $str 
//                 );
        
//         }
//     }
//     endwhile;
// }


/**
 * 
 */
class Trip_Form_Data{

    public $var1 = 121;

    public function get_trip_title(){
        $trip_data = new Trip_Form_Data();
        $trip_id = $trip_data->get_trip_id();
        $data = get_post( $trip_id , ARRAY_A );
        $trip_title = $data['post_title'];

        return $trip_title;
    }

    public function get_trip_url_data(){ // public or private ok??
        // process the url parameter 
        $parameter = $_SERVER['REQUEST_URI'];
        $query = parse_url($parameter, PHP_URL_QUERY);
        parse_str($query, $params);
        $trip_post_id = false;
        if(!empty($params)){ //ok??
            $trip_post_id = $params['tid'];
        }
        return $params;
    }

    public function get_trip_id(){ // public or private ok??
        // process the url parameter 
        $trip_post_id = false;
        $para = $this->get_trip_url_data();
        if(isset($para['tid'])){
            $trip_post_id=  $para['tid'];
        }
       
        if(!empty($params)){ //ok??
            $trip_post_id = $params['tid'];
        }

        return $trip_post_id;
    }

    public function get_trip_url_date(){
        $para = $this->get_trip_url_data();
        if(isset($para['dt'])){ //ok??
            return $para['dt'];
        }
    }

    public function get_trip_url_pax(){
        $para = $this->get_trip_url_data();
        if(isset($para['px'])){ //ok??
            return $para['px'];
        }
    }

    public function get_departure_post_id(){

        $trip_post_id = $this->get_trip_id();
        //get departure date data
        //Required departure post ID related with Trip ID
        $post_data   = get_post( $trip_post_id ); 
        //get the slug from trip ID. It will use to get the same slug departure post to get the matched departure date.
        $departure_id = false;
        $repeater_data = false;
        $args = array(
            'post_type' => 'departure-dates',
            'name' =>$post_data->post_name,
        );
        $trip_posts = array();
        $loop = new WP_Query($args);
        while($loop->have_posts()): $loop->the_post();
            $departure_id = get_the_ID();
            wp_reset_postdata();
        endwhile;
        return $departure_id;
        //var_dump($departure_id); //check the departure post ID
    }

    public function get_group_price_data(){
        //get group data
        //Required Trip ID
        $group_data = false; //ok??
        $trip_post_id = $this->get_trip_id();
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
        return $group_data;
    }

    public function get_repeater_data(){

        $repeater_data = ""; //ok??
        //get the departure date 
        $departure_id = $this->get_departure_post_id();

        if (have_rows('generate_departure_date', $departure_id)) { 
            $repeater_data = array();
                while (have_rows('generate_departure_date', $departure_id)):the_row();
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
        return $repeater_data;
    }


    public function bar(){
        $this->foo($this->var1);
    }

}


$trip_data = new Trip_Form_Data();

//Keep updating all query and data required for form module
$data = array(
        'trip_id'=>$trip_data->get_trip_id(),
        'trip_url_date'=>$trip_data->get_trip_url_date(),
        'trip_url_pax'=>$trip_data->get_trip_url_pax(),
        'group_price'=>$trip_data->get_group_price_data(),
        'departure_date_data'=>$trip_data->get_repeater_data()
);

lds_travel_trip_forms($data,$tpl_name);

