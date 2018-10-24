<?php
/**
 * Enqueue script only in this module
 * Custom JS will be in js folder
 * @return [type] [description]
 */

function lds_travel_date_generator_admin_scripts() {
    
    wp_enqueue_script('lds-travel-dg-admin-script', get_template_directory_uri() . '/modules/date-generator/js/date-generator.js', array('jquery'), true);
    wp_enqueue_script('momentjs',  'https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'), true);
    wp_enqueue_script('daterangepicker',  'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery'), true);
    //wp_enqueue_script('daterangepicker-css',  'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');

    
}
add_action('admin_enqueue_scripts', 'lds_travel_date_generator_admin_scripts');


/**
 * Dynamically populate custom post title in dropdown
 * @param  string|array $field [description]
 * @return [type]        [description]
 */
function lds_travel_load_select_trip_field_choices($field) {
    
    $args = array(
        'post_type' => 'trip',
        'posts_per_page' => 500,
        'orderby' => 'title',
        'order' => 'asc',
    );
    $trip_posts = array();
    $loop = new WP_Query($args);
    //add default trip title and id
    $trip_posts[] = "Trip Name"; 
    while ($loop->have_posts()): $loop->the_post();
        if(get_the_title()){
            $trip_posts[] = get_the_title();
        }

    endwhile;
    wp_reset_query();

    // reset choices
    //$field['choices'] = $trip_posts;

    $choices = $trip_posts;

    // loop through array and add to field 'choices'
    if (is_array($choices)) {
        foreach ($choices as $choice) {
            $field['choices'][$choice] = $choice;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/name=select_trip', 'lds_travel_load_select_trip_field_choices');


//ajax call for repeater field to remove old dates, Delete all dates
add_action("wp_ajax_lds_travel_update_repeater_field_tripdates", "lds_travel_update_repeater_field_tripdates");
add_action("wp_ajax_nopriv_lds_travel_update_repeater_field_tripdates", "lds_travel_update_repeater_field_tripdates");
add_action("wp_ajax_lds_travel_delete_repeater_field_tripdates", "lds_travel_delete_repeater_field_tripdates");
add_action("wp_ajax_nopriv_lds_travel_delete_repeater_field_tripdates", "lds_travel_delete_repeater_field_tripdates");

/**
 * Remove old dates and update 
 * @return [type] [description]
 */
function lds_travel_update_repeater_field_tripdates() {
    $p_id = $_POST['postId'];
    if (have_rows('generate_departure_date', $p_id)) {
        $new_repeater = array();
        while (have_rows('generate_departure_date', $p_id)) {
            the_row();
            //spliting into single date
            $rep_date = get_sub_field('start_date__end_date');
            $repe_date = explode(" - ", $rep_date);
            $repea_date = $repe_date['0'];
            $repeat_date = new DateTime($repea_date);
            //yesterday date for preventing delete for today's trip dates.
            $yesterday_date = date('Y/m/d', strtotime("-30 days"));
            $now = new DateTime($yesterday_date);

            if ($repeat_date > $now) {
                // echo 'present';
                $new_repeater[] = array(
                    'start_date__end_date' => get_sub_field('start_date__end_date'),
                    'price' => get_sub_field('price'),
                    'discount' => get_sub_field('discount'),
                    'status' => get_sub_field('status'),
                );
            } else {
                //do something for present date
            }
           
        }
        update_field('generate_departure_date', $new_repeater, $p_id);
    }
    die();
}

/**
 * Delete all dates including present and past dates
 * 
 */
function lds_travel_delete_repeater_field_tripdates() {
    $p_id = $_POST['postId'];
     if (have_rows('generate_departure_date', $p_id)) {
        $new_repeater = array();
        while (have_rows('generate_departure_date', $p_id)) {
            the_row();
             $new_repeater[] = array(
                );
              delete_row('generate_departure_date', 1, $p_id);
        }
    }
    die();
}


function lds_travel_remove_old_dates_admin_css() {
    ?>
       <style>
       .remove-old-date {
            position: relative;
            float: right;
            background: #ea6060;
            padding: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            margin: 10px;
            top: -20px;
            z-index: 999;
        }
        .remove-all-date {
            position: relative;
            float: right;
            background: #ea6060;
            padding: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            margin: 10px;
            top: -20px;
            z-index: 999;
        }
        #idAll .acf-true-false label{
            position:relative;
        }
        #idAll .acf-true-false label::before {
            content: "Delete";
            position: absolute;
            top: 0px;
            left: 0;
            background: #ea3131;
            width: 40px;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            cursor:Pointer;
        }
        .loader {
            border: 5px solid #f3f3f3; /* Light grey */
            border-top: 5px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 10px;
            height: 10px;
            animation: spin 2s linear infinite;
            vertical-align: middle;
            display: inline-block;
            margin-right: 10px;
        }
        .remove-old-date p,.remove-all-date p{
            display: inline-block;
            margin:0;
            padding:0;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .daterangepicker {
  position: absolute;
  color: inherit;
  background-color: #fff;
  border-radius: 4px;
  border: 1px solid #ddd;
  width: 278px;
  max-width: none;
  padding: 0;
  margin-top: 7px;
  top: 100px;
  left: 20px;
  z-index: 3001;
  display: none;
  font-family: arial;
  font-size: 15px;
  line-height: 1em;
}

.daterangepicker:before, .daterangepicker:after {
  position: absolute;
  display: inline-block;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.daterangepicker:before {
  top: -7px;
  border-right: 7px solid transparent;
  border-left: 7px solid transparent;
  border-bottom: 7px solid #ccc;
}

.daterangepicker:after {
  top: -6px;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-left: 6px solid transparent;
}

.daterangepicker.opensleft:before {
  right: 9px;
}

.daterangepicker.opensleft:after {
  right: 10px;
}

.daterangepicker.openscenter:before {
  left: 0;
  right: 0;
  width: 0;
  margin-left: auto;
  margin-right: auto;
}

.daterangepicker.openscenter:after {
  left: 0;
  right: 0;
  width: 0;
  margin-left: auto;
  margin-right: auto;
}

.daterangepicker.opensright:before {
  left: 9px;
}

.daterangepicker.opensright:after {
  left: 10px;
}

.daterangepicker.drop-up {
  margin-top: -7px;
}

.daterangepicker.drop-up:before {
  top: initial;
  bottom: -7px;
  border-bottom: initial;
  border-top: 7px solid #ccc;
}

.daterangepicker.drop-up:after {
  top: initial;
  bottom: -6px;
  border-bottom: initial;
  border-top: 6px solid #fff;
}

.daterangepicker.single .daterangepicker .ranges, .daterangepicker.single .drp-calendar {
  float: none;
}

.daterangepicker.single .drp-selected {
  display: none;
}

.daterangepicker.show-calendar .drp-calendar {
  display: block;
}

.daterangepicker.show-calendar .drp-buttons {
  display: block;
}

.daterangepicker.auto-apply .drp-buttons {
  display: none;
}

.daterangepicker .drp-calendar {
  display: none;
  max-width: 270px;
}

.daterangepicker .drp-calendar.left {
  padding: 8px 0 8px 8px;
}

.daterangepicker .drp-calendar.right {
  padding: 8px;
}

.daterangepicker .drp-calendar.single .calendar-table {
  border: none;
}

.daterangepicker .calendar-table .next span, .daterangepicker .calendar-table .prev span {
  color: #fff;
  border: solid black;
  border-width: 0 2px 2px 0;
  border-radius: 0;
  display: inline-block;
  padding: 3px;
}

.daterangepicker .calendar-table .next span {
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
}

.daterangepicker .calendar-table .prev span {
  transform: rotate(135deg);
  -webkit-transform: rotate(135deg);
}

.daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
  white-space: nowrap;
  text-align: center;
  vertical-align: middle;
  min-width: 32px;
  width: 32px;
  height: 24px;
  line-height: 24px;
  font-size: 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  white-space: nowrap;
  cursor: pointer;
}

.daterangepicker .calendar-table {
  border: 1px solid #fff;
  border-radius: 4px;
  background-color: #fff;
}

.daterangepicker .calendar-table table {
  width: 100%;
  margin: 0;
  border-spacing: 0;
  border-collapse: collapse;
}

.daterangepicker td.available:hover, .daterangepicker th.available:hover {
  background-color: #eee;
  border-color: transparent;
  color: inherit;
}

.daterangepicker td.week, .daterangepicker th.week {
  font-size: 80%;
  color: #ccc;
}

.daterangepicker td.off, .daterangepicker td.off.in-range, .daterangepicker td.off.start-date, .daterangepicker td.off.end-date {
  background-color: #fff;
  border-color: transparent;
  color: #999;
}

.daterangepicker td.in-range {
  background-color: #ebf4f8;
  border-color: transparent;
  color: #000;
  border-radius: 0;
}

.daterangepicker td.start-date {
  border-radius: 4px 0 0 4px;
}

.daterangepicker td.end-date {
  border-radius: 0 4px 4px 0;
}

.daterangepicker td.start-date.end-date {
  border-radius: 4px;
}

.daterangepicker td.active, .daterangepicker td.active:hover {
  background-color: #357ebd;
  border-color: transparent;
  color: #fff;
}

.daterangepicker th.month {
  width: auto;
}

.daterangepicker td.disabled, .daterangepicker option.disabled {
  color: #999;
  cursor: not-allowed;
  text-decoration: line-through;
}

.daterangepicker select.monthselect, .daterangepicker select.yearselect {
  font-size: 12px;
  padding: 1px;
  height: auto;
  margin: 0;
  cursor: default;
}

.daterangepicker select.monthselect {
  margin-right: 2%;
  width: 56%;
}

.daterangepicker select.yearselect {
  width: 40%;
}

.daterangepicker select.hourselect, .daterangepicker select.minuteselect, .daterangepicker select.secondselect, .daterangepicker select.ampmselect {
  width: 50px;
  margin: 0 auto;
  background: #eee;
  border: 1px solid #eee;
  padding: 2px;
  outline: 0;
  font-size: 12px;
}

.daterangepicker .calendar-time {
  text-align: center;
  margin: 4px auto 0 auto;
  line-height: 30px;
  position: relative;
}

.daterangepicker .calendar-time select.disabled {
  color: #ccc;
  cursor: not-allowed;
}

.daterangepicker .drp-buttons {
  clear: both;
  text-align: right;
  padding: 8px;
  border-top: 1px solid #ddd;
  display: none;
  line-height: 12px;
  vertical-align: middle;
}

.daterangepicker .drp-selected {
  display: inline-block;
  font-size: 12px;
  padding-right: 8px;
}

.daterangepicker .drp-buttons .btn {
  margin-left: 8px;
  font-size: 12px;
  font-weight: bold;
  padding: 4px 8px;
}

.daterangepicker.show-ranges .drp-calendar.left {
  border-left: 1px solid #ddd;
}

.daterangepicker .ranges {
  float: none;
  text-align: left;
  margin: 0;
}

.daterangepicker.show-calendar .ranges {
  margin-top: 8px;
}

.daterangepicker .ranges ul {
  list-style: none;
  margin: 0 auto;
  padding: 0;
  width: 100%;
}

.daterangepicker .ranges li {
  font-size: 12px;
  padding: 8px 12px;
  cursor: pointer;
}

.daterangepicker .ranges li:hover {
  background-color: #eee;
}

.daterangepicker .ranges li.active {
  background-color: #08c;
  color: #fff;
}

/*  Larger Screen Styling */
@media (min-width: 564px) {
  .daterangepicker {
    width: auto; }
    .daterangepicker .ranges ul {
      width: 140px; }
    .daterangepicker.single .ranges ul {
      width: 100%; }
    .daterangepicker.single .drp-calendar.left {
      clear: none; }
    .daterangepicker.single.ltr .ranges, .daterangepicker.single.ltr .drp-calendar {
      float: left; }
    .daterangepicker.single.rtl .ranges, .daterangepicker.single.rtl .drp-calendar {
      float: right; }
    .daterangepicker.ltr {
      direction: ltr;
      text-align: left; }
      .daterangepicker.ltr .drp-calendar.left {
        clear: left;
        margin-right: 0; }
        .daterangepicker.ltr .drp-calendar.left .calendar-table {
          border-right: none;
          border-top-right-radius: 0;
          border-bottom-right-radius: 0; }
      .daterangepicker.ltr .drp-calendar.right {
        margin-left: 0; }
        .daterangepicker.ltr .drp-calendar.right .calendar-table {
          border-left: none;
          border-top-left-radius: 0;
          border-bottom-left-radius: 0; }
      .daterangepicker.ltr .drp-calendar.left .calendar-table {
        padding-right: 8px; }
      .daterangepicker.ltr .ranges, .daterangepicker.ltr .drp-calendar {
        float: left; }
    .daterangepicker.rtl {
      direction: rtl;
      text-align: right; }
      .daterangepicker.rtl .drp-calendar.left {
        clear: right;
        margin-left: 0; }
        .daterangepicker.rtl .drp-calendar.left .calendar-table {
          border-left: none;
          border-top-left-radius: 0;
          border-bottom-left-radius: 0; }
      .daterangepicker.rtl .drp-calendar.right {
        margin-right: 0; }
        .daterangepicker.rtl .drp-calendar.right .calendar-table {
          border-right: none;
          border-top-right-radius: 0;
          border-bottom-right-radius: 0; }
      .daterangepicker.rtl .drp-calendar.left .calendar-table {
        padding-left: 12px; }
      .daterangepicker.rtl .ranges, .daterangepicker.rtl .drp-calendar {
        text-align: right;
        float: right; } }
@media (min-width: 730px) {
  .daterangepicker .ranges {
    width: auto; }
  .daterangepicker.ltr .ranges {
    float: left; }
  .daterangepicker.rtl .ranges {
    float: right; }
  .daterangepicker .drp-calendar.left {
    clear: none !important; } }

   </style>
   <?php
}
add_action('admin_footer', 'lds_travel_remove_old_dates_admin_css');