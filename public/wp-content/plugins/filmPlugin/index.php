<?php
/*
Plugin Name: Movie View
Plugin URI: http://wp.tutsplus.com/
Description: Declares a plugin that will create a custom post type displaying movie reviews.
Version: 1.0
Author: Andrew7792
Author URI: http://wp.tutsplus.com/
License: GPLv2
*/



add_action("the_content", "add_advance_film_info");

function add_advance_film_info($content)
{

    var_dump( $post );

    $advance_info = '----------------------------';

    return $content . $advance_info;

    if ( (is_page() && $options["co"]) )
    {
        return $content . $advance_info;
    } else {
        return $content;
    }
}





