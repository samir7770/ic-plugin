<?php

// Plugin Name: Quick QR Code
// Description: A simple plugin to generate QR codes for WordPress posts and pages  
// Version: 1.0
// Author: Samir

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


add_action( 'wp_enqueue_scripts', 'qqrc_enqueue_styles' );
function qqrc_enqueue_styles() {
    wp_enqueue_style(
    'qqrc-style',
    plugins_url( 'assets/css/style.css', __FILE__ ),
    array(),
    '1.0.0',
);
}

function qqrc_display($content) {
   if(is_single() || is_page() ){
       $url = get_permalink();
    // custotm filters
        $size = apply_filters('qqrc_display_size', '150x150');
        $bgcolor = apply_filters('qqrc_display_bgcolor', 'ff0000');
        $color = apply_filters('qqrc_display_color', 'ffffff');
        $position = apply_filters('qqrc_display_position', 'bottom');
        $api = "https://api.qrserver.com/v1/create-qr-code/?bgcolor={$bgcolor}&color={$color}&size={$size}&data={$url}";
        $qr_code = "<img class=\"qqrc-img\" src='{$api}'>";
        $content = $content . "<p>{$qr_code}</p>";
   }
   return $content;
}

add_filter('the_content', 'qqrc_display');