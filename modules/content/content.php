<?php
/**
 * This file work as data modal.
 * Contains all trips related query and variables from ACF.
 *
 */
    $trip_type                   = get_field('trip_type');
    //Trip Options
    $trip_cost                   = get_field('trip_cost');
    $trip_discount_percentage    = get_field('discount_percentage');
    $trip_offer_starts           = get_field('offer_starts');
    $trip_offer_ends             = get_field('offer_ends');
    $trip_featured               = get_field('featured');
    $trip_bestseller             = get_field('bestseller');    
    $trip_thumbnail              = get_field('trip_thumbnail');    
    //Overview   
    $trip_code                   = get_field('code');
    $trip_days                   = get_field('days');
    $trip_group_size             = get_field('group_size');
    $trip_trip_level             = get_field('trip_level');
    $trip_max_altitude           = get_field('max_altitude');
    $trip_country_visited        = get_field('country_visited');
    $trip_trip_starts_at         = get_field('trip_starts_at');
    $trip_trip_ends_at           = get_field('trip_ends_at');
    $trip_destination            = get_field('destination');
    $trip_best_season            = get_field('best_season');
    $trip_activity               = get_field('activity');
    $trip_activity_per_day       = get_field('activity_per_day');
    $trip_trip_route             = get_field('trip_route');
    $trip_highlights             = get_field('highlights');
    //Itinerary
    $trip_outline_itinerary      = get_field('outline_itinerary');
    $trip_day_to_day_itinerary   = get_field('day_to_day_itinerary');//repeater
    //Departure
    $trip_departure_type         = get_field('departure_type');
    $trip_group_discount         = get_field('group_discount');
    $trip_departure_content      = get_field('departure_content');//repeater
    //Include
    $trip_include_description    = get_field('include_description');
    $trip_excludes               = get_field('excludes');
    $trip_departure_type         = get_field('departure_type');
    $trip_include_content        = get_field('include_content');//repeater
    //Equipment
    $trip_equipment_description  = get_field('equipment_description');//repeater
    //Faqs
    $trip_faqs_list              = get_field('faqs_list');//relationship
    //Gallery
    $trip_shortcode              = get_field('shortcode');
    //Other Info
    $trip_map                    = get_field('map');
    $trip_other_info_content     = get_field('other_info_content');//repeater
    //Related Trips/Article
    $trip_related_trips          = get_field('related_trips');//relationship
    $trip_related_article        = get_field('related_article');//relationship