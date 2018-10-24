<?php

function lds_travel_add_print_templates( $post_templates, $wp_theme, $post, $post_type ) {
    //add the absolute folders name and template name.
    $post_templates['modules/print/page-templates/page-template-print.php'] = 'Print Page';

    return $post_templates;
}
add_filter( 'theme_page_templates', 'lds_travel_add_print_templates', 10, 4 );