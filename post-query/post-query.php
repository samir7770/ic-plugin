<?php 
/*
* Plugin Name: Basic Post Query
* Description: A simple post query practice plugin 
* Author: Samir
* Version: 1.0
*/

if(!defined('ABSPATH')){
    exit();
}

class PostQuery{
    public function __construct(){
        add_shortcode( 'post_query',[$this ,'post_query_shortcode']);
    }

    public function post_query_shortcode(){
        ob_start();
        include_once plugin_dir_path(__FILE__) . 'includes/BasicQuery.php';
        return ob_get_clean();
    }
}

$post_query = new PostQuery();