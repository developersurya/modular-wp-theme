<?php 
/**
 * This file work as data modal.
 * Contains discounted trips related query and variables.
 * #Available Meta_key 
 */
function pdf_content($pid) {
	//if (is_singular('trip')) {
		global $post;
        //$pid = $post->ID;
         //echo $pid;
        $html = "";
		$html .= '<style type="text/css">* {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        body{
          font-size:14px;
          margin: 0;
        }
        #content {
            width: 900px;
            margin: 15px auto;
            text-align: justify;
        }
        .trip-facts{
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            border-bottom: 0;
        }
        .trip-facts:after {
            content: "";
            clear: both;
            display: table;
        }
        .trip-facts li {
            list-style: none;
            width: 50%;
            vertical-align: top;
            padding: 7px 2% 7px 2%;
            float: left;
            border-bottom: 1px solid #ccc;
        }
        .trip-facts.full-width li{
            width: 100%;
            padding: 7px 2%;
        }
        ul.trip-facts.full-width.clearfix {
           margin-top:-1px;
        }
        .trip-short-itinerary ul{
           padding:0;
        }
        .trip-facts__title{
          font-weight:bold;
        }
        .trip-highlight ul,
        .cost-included,
        .cost-excluded{
          padding:0;
          margin: 0 0 0 30px;
        }
        .trip-highlight li,
        .cost-included li,
        .cost-excluded li{
            margin-bottom: 5px;
            line-height: 12px;
        }
        .cost-included li p,
        .cost-excluded li p{
          margin-bottom:0;
        }
        .section__heading{
          margin-top:30px;
        }
        .footer-contact--row .col {
            float: left;
            width: 30%;
            margin-right: 3%;
        }
        .footer-contact--row:after {
            content: "";
            clear: both;
            display: table;
        }
        .img-map{
            display: block;
            max-width: 100%;
            width: 100%;
            height: auto;
        }
        #printableArea{
           text-align:center;
              margin-top: 20px;
        }
        a.print {
            padding: 3px 0px;
            background: #FF6600;
            color: #fff;
            font: bold 12px Arial, Helvetica, sans-serif;
            text-align: center;
            width: 100px;
            display: inline-block;
             text-decoration: none;
        }
        a.print:hover{
          background: #e25c03;
        }
        .banner-image {
            width: 100%;
            height: auto;
            margin: 0;
        }
        p, td, th, li {
            font-size: 1em;
            line-height: 1.5em;
            font-family: Times;
        }
        h1,h2,h3,h4,h5,h6{
            font-family: Times;
        }
        .cost-included li p, .cost-excluded li p {
            margin-bottom: 0;
            line-height: 12px;
        }
        @media print {
          .map-title{
                page-break-before: always;
                }
            .img-map { max-width:100% !important;}
          a.print{
                display:none;}
        }</style><style type="text/css">
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
        </style>';
        //$map = get_field("trip_map");
        $html .="<div id='content'>";
		$banner_img = wp_get_attachment_image_src(get_post_thumbnail_id($pid), "full");
		if ($banner_img[0] != '') {
			$html .= '<img class="banner-image" src="' . $banner_img[0] . '"  alt="' .  get_the_title($pid) . '">';
		}

		$html .= '<h1 class="print-title">' . get_the_title($pid) . '</h1>';

        $trip_code = get_field("code", $pid);
		$trip_days = get_field("days", $pid);
		$trip_size = get_field("group_size", $pid);
		$trip_cost = get_field("trip_cost", $pid);
		$trip_level = get_field("trip_level", $pid);
		$trip_alt = get_field("max_altitude", $pid);
		$trip_country = get_field("country_visited", $pid);
		$trip_desti = get_field("destination", $pid);
		$trip_season = get_field("best_season", $pid);
		$trip_activityday = get_field("activity_per_day", $pid);
		$trip_route = get_field("trip_route", $pid);
		$trip_activity = get_field("activity", $pid);
		$trip_category = get_field("destination", $pid);
		$trip_discount = get_field("discount_percentage", $pid);
		$trip_level_type = get_field("trip_level_type", $pid);
		if ($trip_discount) {
			$dcost = $trip_cost - ($trip_discount / 100) * $trip_cost;
		}

		$html .= '<ul class="trip-facts clearfix">';
		if ($trip_code) {
			$html .= '<li class="trip-code odd"><span class="trip-facts__title"><i class="icon-tf_pen"></i>Trip Code: </span><span>' . $trip_code . '</span></li>';
		}
		if ($trip_country) {
			$html .= '<li class="trip-visited even"><span class="trip-facts__title"><i class="icon-tf_country"></i>Country: </span><span>' . $trip_country . '</span></li>';
		}
		if ($trip_days) {
			$html .= '<li class="trip-days odd"><span class="trip-facts__title"><i class="icon-tf_clock"></i>Duration: </span><span>' . $trip_days . ' Days</span></li>';
		}
		if ($trip_level) {
			$html .= '<li class="trip-level even col-lg-6';
			if ($trip_level_type == 'Biking') {
				$html .= ' biking-type';
			} elseif ($trip_level_type == 'Climbing') {
				$html .= ' climbing-type';
			} else {
				$html .= ' tour-treks-type';
			}
			if ($trip_level == 'Easy') {
				$html .= ' Easy';
			} elseif ($trip_level == 'Beginners') {
				$html .= ' Beginners';
			} elseif ($trip_level == 'Advanced Beginners') {
				$html .= ' advanced-beginners';
			} elseif ($trip_level == 'Moderate') {
				$html .= ' Moderate';
			} elseif ($trip_level == 'Demanding') {
				$html .= ' Demanding';
			} elseif ($trip_level == 'Strenuous') {
				$html .= ' Strenuous';
			} elseif ($trip_level == 'Challenging') {
				$html .= ' Challenging';
			} elseif ($trip_level == 'Tough') {
				$html .= ' Tough';
			} elseif ($trip_level == 'Very Strenuous') {
				$html .= ' very-strenuous';
			} elseif ($trip_level == 'Intermediate') {
				$html .= ' Intermediate';
			} elseif ($trip_level == 'Advanced') {
				$html .= ' Advanced';
			}
			$html .= '"><span class="trip-facts__title"><i class="icon-';
			if ($trip_level_type == 'Biking') {
				$html .= 'biking';
			} elseif ($trip_level_type == 'Climbing') {
				$html .= 'climbing';
			} else {
				$html .= 'tf_level';
			}
			$html .= '"></i>Trip Level: </span><span>' . $trip_level . '</span>';

			$html .= '</li>';

		}
		if ($trip_alt) {
			$html .= '<li class="trip-altitude odd"><span class="trip-facts__title"><i class="icon-tf_altitude"></i>Max Altitude: </span><span>' . $trip_alt . '</span></li>';
		}
		if ($trip_activity) {
			$html .= '<li class="trip-activity even"><span class="trip-facts__title"><i class="icon-tf_activity"></i>Activity: </span><span>' . $trip_activity . '</span></li>';
		}
		if (get_field("starts_at", $pid)) {
			$html .= '<li class="trip-starts-at odd"><span class="trip-facts__title"><i class="icon-tf_trip-start"></i>Starts at: </span><span>' . get_field("starts_at", $pid) . '</span></li>';
		}
		if (get_field("ends_at", $pid)) {
			$html .= '<li class="trip-ends-at even"><span class="trip-facts__title"><i class="icon-tf_trip-end"></i>Ends at: </span><span>' . get_field("ends_at", $pid) . '</span></li>';
		}

		$html .= '</ul>';

		$html .= '<ul class="trip-facts full-width clearfix">';
		if ($trip_route) {
			$html .= '<li class="trip-route"><span class="trip-facts__title"><i class="icon-tf_trip-route"></i>Trip Route:</span><span>' . $trip_route . '</span></li>';
		}
		if ($trip_season) {
			$html .= '<li class="trip-season"><span class="trip-facts__title"><i class="icon-tf_season"></i>Best Season: </span><span>' . $trip_season . '</span></li>';
		}

		$html .= '</ul>';

		if (get_field('highlights', $pid) != '') {
			$html .= '<div class="col-lg-12 trip-highlight">';
			$html .= '<h4 class="section__heading">Trip Highlights</h4>';
			$html .= apply_filters('the_content', get_field('highlights', $pid)) . '</div>';
		}
        $content = get_post_field('post_content', $pid);
		if ($content) {
			$html .= '<div class="trip-info">';
			$html .= '<h4 class="section__heading">Trip Information</h4>' . apply_filters('the_content', $content ). '</div>';
		}

		if (have_rows('day_to_day_itinerary', $pid)):
			$html .= '<h4 class="section__heading">Detailed Itinerary</h4>';
			while (have_rows('day_to_day_itinerary', $pid)): the_row();
				$html .= '<div class="itinerary--item">';
				$html .= '<h6>' . get_sub_field("title") . '</h6>' . get_sub_field("description") . '</div>';
			endwhile;
		endif;

		if (get_field("include_description", $pid)) {
			$html .= '<div class="include_note">' . get_field("include_description", $pid) . '</div>';
		}
		if (have_rows('cost_includes')) {
			$html .= '<h4 class="section__heading">Price Includes</h4>';
			$html .= '<ul class="clearfix cost-included">';
			while (have_rows('cost_includes', $pid)) {
				the_row();

				$html .= '<li><span class="icon-included"></span><p>' . get_sub_field("included", $pid) . '</p></li>';

			}
			$html .= '</ul>';
		}
		if (have_rows('excludes', $pid)):
			$html .= '<h4 class="section__heading">Price Does not Include</h4>';
			$html .= '<ul class="clearfix cost-excluded">';
			while (have_rows('excludes', $pid)): the_row();
				$html .= '<li><span class="icon-cross"></span><p>' . get_sub_field("excluded", $pid) . '</p></li>';
			endwhile;
			$html .= '</ul>';
		endif;
		$html .= '<div style="margin-top:20px;">' . get_field("include_exclude_note", $pid) . '</div>';
		//if(isset($pid)) {
		if (have_rows('sidebar_before_booking_a_trip_page_list', $pid)):
			while (have_rows('sidebar_before_booking_a_trip_page_list', $pid)): the_row();
				$page_link[] = get_sub_field('page_relative_url', $pid);
			endwhile;

			if (in_array("/before-booking-a-trip/your-leader/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/your-leaders');
				$post_content = get_post($page->ID);
				$html .= '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/travel-insurance/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/travel-insurance');
				$post_content = get_post($page->ID);
				$html .= '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/altitude-sickness-info/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/altitude-sickness-info');
				$post_content = get_post($page->ID);
				$altitude_sickness_info = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/nepal-international-flights/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/nepal-international-flights');
				$post_content = get_post($page->ID);
				$international_flights = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/india-international-flights/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/india-international-flights');
				$post_content = get_post($page->ID);
				$international_flights = 'india-international-flights<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/bhutan-international-flights/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/bhutan-international-flights');
				$post_content = get_post($page->ID);
				$international_flights = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/tibet-international-flights/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/tibet-international-flights');
				$post_content = get_post($page->ID);
				$international_flights = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/multi-country-international-flights/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/multi-country-international-flights');
				$post_content = get_post($page->ID);
				$international_flights = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/nepal-travel-guide/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/nepal-travel-guide');
				$post_content = get_post($page->ID);
				$travel_guide = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/india-travel-guide/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/india-travel-guide');
				$post_content = get_post($page->ID);
				$travel_guide = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/bhutan-travel-guide/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/bhutan-travel-guide');
				$post_content = get_post($page->ID);
				$travel_guide = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/tibet-travel-guide/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/tibet-travel-guide');
				$post_content = get_post($page->ID);
				$travel_guide = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
			if (in_array("/before-booking-a-trip/multi-country-travel-guide/", $page_link)) {
				$page = get_page_by_path('before-booking-a-trip/multi-country-travel-guide');
				$post_content = get_post($page->ID);
				$travel_guide = '<h4 class="section__heading">' . $post_content->post_title . '</h4>' . apply_filters('the_content', $post_content->post_content);
			}
		endif;

		// }
		if (get_field("equipment_description", $pid) || have_rows('equipment_description', $pid) || get_field('equipment_extra_description', $pid)) {
			$html .= '<h4 class="section__heading">Equipment</h4>' ;

			if (have_rows('equipment_description', $pid)):
				while (have_rows('equipment_description', $pid)): the_row();

					$html .= '<h5 class="section__heading">' . get_sub_field("title") . '</h5>' . get_sub_field("description");

				endwhile;
			endif;
			if (get_field('equipment_extra_description', $pid)) {

				$html .= '<div class="equipment-extra-description">' . get_field("equipment_extra_description", $pid) . '</div>';
			}
		}

		if ($altitude_sickness_info) {
			$html .= $altitude_sickness_info;
		}
		if ($international_flights) {
			$html .= $international_flights;
		}
		if ($travel_guide) {
			$html .= $travel_guide;
        }

        $faqs_list = get_field('faqs_list',$pid);
		if (have_rows('faqs_list', $faqs_list[0]->ID)):
			$html .= '<h4 class="section__heading">FAQs</h4>';
			while (have_rows('faqs_list', $faqs_list[0]->ID)): the_row();
				$html .= '<h6>' . get_sub_field("question") . '</h6>';
				$html .= '<p class="panel-body">' . get_sub_field("answer") . '</p>';
			endwhile;
		endif;
		if (get_field('trip_note', $pid)) {
			$html .= '<div class="extra-info">' . get_field('trip_note', $pid) . '</div><!--extra-info-->';
		}
		if (get_field('trip_distinct_features')) {
			$html .= '<div class="trip-speciality">' . get_field('trip_distinct_features', $pid) . '</div>';
		}
		$html .= '<h4 class="section__heading">Contact Us</h4>';
		$html .= '<h6>Head Office</h6>';

		$html .= '<div class="footer-contact--row">';
		$html .= '<div class="col">' . get_field('head_office', 'option') . '</div>';
		$html .= '<div class="col">' . get_field('north_america_office', 'option') . '</div>';
		$html .= '<div class="col">' . get_field('europe_office', 'option') . '</div>';
		$html .= '</div>';
		$html .= '<div class="footer-contact--row">';

		$html .= '<div class="col">' . get_field('south_africa_office', 'option') . '</div>';
		$html .= '<div class="col">' . get_field('indonesia_office', 'option') . '</div>';
		$html .= '<div class="col">' . get_field('russia_and_east_europe_office', 'option') . '</div>';
		if (get_field('b2b_email')) {
			$html .= '<span class="b2b-email">' . get_field('b2b_email') . '</span>';
		}
		$html .= '</div>';
		$map = get_field("trip_map");
		if ($map != '') {
			$html .= '<h4 class="section__heading map-title">Larger Map</h4>';
			$html .= '<img class="img-map" src="' . $map['url'] . '"  alt="' . $map['alt'] . '">';
        }
       $html .='</div>';
		return $html;
	//}
}

//get all data
$data = pdf_content($pid);
//debugger($data);



