<?php

################################################################################
##### CONSTANTS ################################################################
//Define directory constants.
define('STYLEDIR', get_bloginfo('stylesheet_directory'));
define('IMAGES', STYLEDIR . "/images");
define('IMAGES_SERVER', lds_travel_get_stylesheet_path() . "/images");
define('JSDIR', STYLEDIR . "/js");
define('CSSDIR', STYLEDIR . "/css");
define('FONTS', STYLEDIR . "/fonts");
define('MODDIR', STYLEDIR . "/modules");
define('MODDIR_SERVER', lds_travel_get_stylesheet_path() . "/modules");


### https://codex.wordpress.org/Function_Reference/get_home_path
### get_home_path() is a Wordpress core function located in wp-admin/includes/file.php
### lds_travel_get_home_path() is the exact same function, except in name.
### I have to use it to set up the IMAGES_SERVER constant, which makes including SVGs a bit easier.
### Why did I redo that function? - Because it's apparently only available on the Dashboard.
### Why didn't I wrap the original function name in a conditional with !function_exists()? - Because it didn't fucking work.
function lds_travel_get_home_path()
{
    $home = set_url_scheme(get_option('home'), 'http');
    $siteurl = set_url_scheme(get_option('siteurl'), 'http');
    if (!empty($home) && 0 !== strcasecmp($home, $siteurl)) {
        $wp_path_rel_to_home = str_ireplace($home, '', $siteurl); /* $siteurl - $home */
        $pos = strripos(str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']), trailingslashit($wp_path_rel_to_home));
        $home_path = substr($_SERVER['SCRIPT_FILENAME'], 0, $pos);
        $home_path = trailingslashit($home_path);
    } else {
        $home_path = ABSPATH;
    }

    return str_replace('\\', '/', $home_path);
}

### This uses the above function and adds onto the string to get the full path to the stylesheet directory
function lds_travel_get_stylesheet_path()
{
    $return = false;
    $home_path = lds_travel_get_home_path();
    $style_dir = get_bloginfo('stylesheet_directory');

    $wp_content_strpos = strpos($style_dir, 'wp-content');

    if ($wp_content_strpos !== false) {
        $full_path = $home_path . substr($style_dir, $wp_content_strpos);
        $return = $full_path;
    }

    return $return;
}

function lds_travel_get_article_topics($articleId, $returnType = 'name')
{
    $articleTopics = array();
    $allTopics = get_the_terms($articleId, 'article-topic');
    if (!empty($allTopics)):
        foreach ($allTopics as $topic):
            if ($returnType == 'name'):
                $articleTopics[] = $topic->name;
            else:
                $articleTopics[] = $topic->term_id;
            endif;
        endforeach;
    endif;

    return $articleTopics;
}

function lds_travel_site_search_results()
{
    parse_str($_POST['formData'], $searchData);
    $searchData['searchQuery'] = htmlspecialchars(strip_tags($searchData['searchQuery']));
    $content = '<h2>Showing results for &lsquo;' . $searchData['searchQuery'] . '&rsquo;</h2>';

    $searchArgs = array(
        'post_type' => array(
            'post',
            'page',
            'news-analysis',
            'in-the-news',
        ),
        'posts_per_page' => 99,
        's' => $searchData['searchQuery'],
    );
    $searchItems = new WP_Query($searchArgs);

    if ($searchItems->have_posts()):
        while ($searchItems->have_posts()): $searchItems->the_post();
            $content .= '<a href="'.get_the_permalink().'" class="result__item">
                <h3>' . get_the_title() . '</h3>
                <p>
                ' . get_the_excerpt() . '
                </p>
            </a>';
        endwhile;
    else:
        $content .= '<div class="result__item">
                <h3>Sorry, no results were found for your term(s). Please try again.</h3>
            </div>';
    endif;
    wp_reset_query();

    echo $content;

    wp_die();
}

add_action('wp_ajax_nopriv_lds_travel_site_search_results', 'lds_travel_site_search_results');
add_action('wp_ajax_lds_travel_site_search_results', 'lds_travel_site_search_results');