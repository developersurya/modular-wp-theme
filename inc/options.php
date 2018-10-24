<?php

// Options Pages
$postTypesForOptions = array(
    'news-analysis',
    'resources',
    'in-the-news',
);

if (function_exists('acf_add_options_page')) {
    acf_add_options_page('General');
    acf_add_options_page('Homepage');

    // Example for adding in a child options page
    // Success Stories Options
    foreach ($postTypesForOptions as $postTypesForOption):
        acf_add_options_page(
            array(
                'page_title' => ucwords(str_replace('-', ' ', $postTypesForOption)).' Options',
                'parent_slug' => 'edit.php?post_type='.$postTypesForOption
            )
        );
    endforeach;


}
