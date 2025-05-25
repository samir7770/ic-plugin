<?php

// Plugin Name: Secure Plugin
// Description: Secure Plugin is usinf for checking form data.
// Version: 1.0.0
// Author: Samir

function secure_plugin_form_shortcode(){

    return "<div>===============<br>Secure Plugin<br>===============</div>";
}

add_shortcode('secure_plugin','secure_plugin_form_shortcode');