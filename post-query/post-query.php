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
        add_action( 'init', [$this, 'cptui_register_my_cpts'] );
        add_shortcode('books', [$this, 'display_books']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_style']);
    }

    public function enqueue_style(){
        wp_enqueue_style(
            'book-style',
            plugin_dir_url(__FILE__). 'assets/book-style.css',
            [],
            '1.0.0'
        );
    }

    public function display_books(){
        ob_start();
        include_once plugin_dir_path(__FILE__) . 'includes/CustomPostQuery.php';
        return ob_get_clean();
    }

    public function post_query_shortcode(){
        ob_start();
        include_once plugin_dir_path(__FILE__) . 'includes/BasicQuery.php';
        return ob_get_clean();
    }


    /*==================
     * Post Type: Books.
     ===================*/
    function cptui_register_my_cpts() {

        $labels = [
            "name" => esc_html__( "Books", "twentytwentyfive" ),
            "singular_name" => esc_html__( "Book", "twentytwentyfive" ),
        ];

        $args = [
            "label" => esc_html__( "Books", "twentytwentyfive" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => [ "slug" => "book", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
            "show_in_graphql" => false,
        ];

        register_post_type( "book", $args );
    }
    /*==================
     * END Post Type: Books.
     ===================*/
}

$post_query = new PostQuery();