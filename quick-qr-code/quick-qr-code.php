<?php

// Plugin Name: Quick QR Code
// Description: A simple plugin to generate QR codes for WordPress posts and pages  
// Version: 1.0
// Author: Samir New

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


// Admin Menu Setup 
function qqrc_admin_panel(){
    add_menu_page('Quick QR Code', 'Quick QR Code', 'manage_options', 'qqrc-admin', 'qqrc_admin_panel_display', '');
}

add_action('admin_menu', 'qqrc_admin_panel');

// Admin Menu Page content 
function qqrc_admin_panel_display(){
    echo "<div class='wrap'><h1>Quick QR Code Options</h1>";
    include_once plugin_dir_path(__FILE__) . 'template/form.php';
    echo "</div>";
}

// Admin Panel Style 
function qqrc_admin_scripts($hook){
    if( 'toplevel_page_qqrc-admin' != $hook ) return;
    wp_enqueue_script('qqrc-admin-js', plugins_url('assets/js/main.js', __FILE__), ['jquery'], '1.0', true);
    wp_enqueue_style('qqrc-style', plugins_url('assets/css/admin-style.css', __FILE__), [], time(), 'all');
}
add_action('admin_enqueue_scripts', 'qqrc_admin_scripts');


// Admin post 

// function qqrc_settings_save() {
//     $settings = $_POST;

//     //Remove '#' before saving
//     if (!empty($settings['bgcolor'])) {
//         $settings['bgcolor'] = ltrim($settings['bgcolor'], '#');
//     }
//     if (!empty($settings['color'])) {
//         $settings['color'] = ltrim($settings['color'], '#');
//     }

//     update_option('qqrc_settings', $settings);
//     wp_safe_redirect(admin_url('admin.php?page=qqrc-admin'));
//     exit;
// }

// add_action('admin_post_qqrc_settings', 'qqrc_settings_save');


function qqrc_ajax_save_settings() {
    $settings = $_POST;

    //Remove '#' before saving
    if (!empty($settings['bgcolor'])) {
        $settings['bgcolor'] = ltrim($settings['bgcolor'], '#');
    }
    if (!empty($settings['color'])) {
        $settings['color'] = ltrim($settings['color'], '#');
    }

    update_option('qqrc_settings', $settings);
    wp_send_json_success('Settings saved successfully.');

}

add_action('wp_ajax_qqrc_ajax_save_settings', 'qqrc_ajax_save_settings');


// ==========================
// Frontend Sytle Calling Start
// ==========================

// Style Enqueue
function qqrc_enqueue_styles() {
    wp_enqueue_style(
        'qqrc-style',
        plugins_url( 'assets/css/style.css', __FILE__ ),
        array(),
        '1.0.0',
    );
}

add_action( 'wp_enqueue_scripts', 'qqrc_enqueue_styles' );


// QR Code Display in Post 
function qqrc_display($content) {
   if(is_single() || is_page() ){
       $url = get_permalink();

       $settings = get_option('qqrc_settings');
    
    // custotm filters
        $size     = apply_filters('qqrc_display_size', $settings['size'] ?? '150');
        $bgcolor  = apply_filters('qqrc_display_bgcolor', $settings['bgcolor'] ?? 'ffffff');
        $color    = apply_filters('qqrc_display_color', $settings['color'] ?? '000000');
        $position = apply_filters('qqrc_display_position', $settings['position'] ?? 'bottom_right');
        $api = "https://api.qrserver.com/v1/create-qr-code/?bgcolor={$bgcolor}&color={$color}&size={$size}x{$size}&data={$url}";
        $qr_code = "<img class=\"qqrc-img $position\" src='{$api}'>";
        $content = $content . "<p>{$qr_code}</p>";
   }
   return $content ;
}

add_filter('the_content', 'qqrc_display');




