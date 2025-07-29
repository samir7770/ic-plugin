<?php 

// Plugin Name: Jquery learn
// Description: A simple plugin to generate Short codes  
// Version: 1.0
// Author: Samir New


class Jquerypr{

    public function __construct(){
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_shortcode('jquery_greet_box', [$this, 'render']);
        add_action('wp_ajax_ajax_form_submit', [$this, 'ajax_form_submit_callback']);
        add_action('wp_ajax_nopriv_ajax_form_submit', [$this, 'ajax_form_submit_callback']);
    }

    public function enqueue_scripts(){
        wp_enqueue_script(
            'enqueue_js',
            plugin_dir_url( __FILE__) . 'app.js',
            ['jquery'],
            1.0,
            true
        );
        wp_localize_script('enqueue_js', 'ajax_object', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);
        wp_enqueue_style(
            'enqueue_css',
            plugin_dir_url(__FILE__) . '/style.css',
            [],
            1.0,
            'all'
        );

    }

    public function render(){
        ob_start();
        ?>
        <!-- Name Email form error check -->
            <!-- <form id="simpleForm" novalidate>
                <label>Name: <input type="text" id="userName" /></label>
                <div class="error" id="nameError"></div>

                <label>Email: <input type="email" id="userEmail" /></label>
                <div class="error" id="emailError"></div>

                <button type="submit">Submit</button>
            </form>

            <div id="formMessage"></div> -->
        <!-- Comment Check -->
            <!-- <form id="simpleForm" novalidate>
                <textarea id="userComment" placeholder="Write your comment..." rows="4" cols="50" ></textarea>
                <p id="charCount">0 / 100</p>
                <button type="submit">Submit</button>

                <div id="commentError" class="error"></div>
                <div id="commentSuccess" class="success"></div>
            </form> -->
        
        
        
        <!-- AJAX Started -->
        <form id="ajaxForm">
            <input type="text" id="name" placeholder="Enter your name" />
            <input type="email" id="email" placeholder="Enter your email" />
            <span id="loading" style="display:none; color:blue;">Sending...</span>
            <button type="submit">Send</button>
        </form>

        <div id="ajaxResponse"></div>
        
        <?php 
        return ob_get_clean();
    }


    public function ajax_form_submit_callback(){
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);

        if(empty($name) || empty($email)) {
            wp_send_json([
                'success' => false,
                'message' => 'Both fields are required'
            ]);
        } 

        if(!is_email($email)) {
            wp_send_json([
                'success' => false,
                'message' => 'Use a valid mail address.'
            ]);
        } 

        update_option('jquery_last_submissions', [
            'name' => $name,
            'email' => $email,
            'time' => current_time('mysql')
        ]);
        
        wp_send_json([
            'success' => true,
            'message' => "Hello {$name}! Your email is: {$email}"
        ]);

        wp_die();
    }

}

new Jquerypr();