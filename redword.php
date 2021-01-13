<?php

/*
Plugin Name: Reading Time and wordcount
Plugin URI: https://wpcustometheme.com
Description: Count Words from any WordPress Post
Version: 1.0
Author: Sazin
Author URI: https://sazin.me
License: GPLv2 or later
Text Domain: word-count
Domain Path: /languages/
*/

// function wordcount_activation_hook(){}
// register_activation_hook(__FILE__,"wordcount_activation_hook");

// function wordcount_deactivation_hook(){}
// register_deactivation_hook(__FILE__,"wordcount_deactivation_hook");




// plugin text doamin  loaded 
function wordcount_load_textdomain()
{
    load_plugin_textdomain('word-count', false, dirname(__FILE__) . "/languages");
}

add_action("plugins_loaded", 'wordcount_load_textdomain');



// Word Count function 

function word_count_jf($content)
{

    $remove_html = strip_tags($content);
    $numberofword = str_word_count($remove_html);
    $label =  __('The Number of word:', 'word-count');
    $label =  apply_filters("number_heading", $label);
    $tag =  apply_filters("number_tag", h2);

    $content .= sprintf('<%s> %s %s </%s>', $tag, $label, $numberofword, $tag);
    return $content;
}
add_filter('the_content', 'word_count_jf');




function jfreading_timte($content)
{
    $remove_html = strip_tags($content);
    $numberofword = str_word_count($remove_html);
    $label =  __('Total Reading time:', 'word-count');
    $reading_minutes = floor($numberofword / 200);
    $reading_seconds = floor($numberofword % 200 / (200 / 60));
    $label =  apply_filters("readingtime_heading", $label);
    $tag =  apply_filters("reading_tag", h5);

    $content .= sprintf('<%s> %s: %s Minutes %s Seconds </%s>', $tag, $label, $reading_minutes, $reading_seconds, $tag);
    return $content;
}

add_filter('the_content', 'jfreading_timte');
