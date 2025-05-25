<?php 

// Plugin Name: Post ID
// Description: A simple plugin to display the post ID of a WordPress post  
// Version: 1.0
// Author: Samir
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_filter('the_title', 'add_post_id_to_title', 10, 2);

function add_post_id_to_title($title, $id) {
    if(is_admin() && get_post_type($id) == 'post') {
        return " $id - $title";
    }else {
        return $title;
    }
}