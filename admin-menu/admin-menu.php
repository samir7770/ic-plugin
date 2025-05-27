<?php

// Plugin Name: Admin Menu
// Descrition: Admin Menu 
// Version: 1.0
// Author: Samir 

if (!defined('ABSPATH')){
    exit;
}

function admin_panel_menu(){
    add_menu_page(
        'Admin Menu',
        'Admin Menu',
        'manage_options',
        'admin-menu',
        'admin_menu_callback',
        null,
    );
}

add_action('admin_menu', 'admin_panel_menu');

function admin_menu_callback(){
    echo "<div class='wrap'><h1>Admin Menu Test</h1>";
    include_once plugin_dir_path(__FILE__) .'templates/form.php';
    echo "</div>";
}

function admin_menu_scripts($hook){
    if('toplevel_page_admin-menu' != $hook) return;
    wp_enqueue_style(
        'admin_menu_style', plugins_url('assets/css/style.css', __FILE__), [], time(), 'all'
    );
}

add_action('admin_enqueue_scripts','admin_menu_scripts');



function admin_menu_settings_save(){
    update_option('admin_menu_settings', $_POST);
    wp_safe_redirect(admin_url('admin.php?page=admin-menu'));
}

add_action('admin_post_admin_menu_settings', 'admin_menu_settings_save');