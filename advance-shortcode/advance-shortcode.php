<?php 

// Plugin Name: Advance Shortcode
// Description: A simple plugin to generate Short codes  
// Version: 1.0
// Author: Samir New


if( !defined("ABSPATH")){
    exit();
}

class AdvanceShortcode{
    function __construct(){
        add_shortcode('advance-shortcode', [$this, 'render']);
    }

    public function render($atts){
        $atts = shortcode_atts([
            'name' => "Something",
            'age'=> '45',
            'color'=>'Green',
        ], $atts);

        ob_start();
        ?>
            <p style="color: <?php echo $atts['color'];?>;">You are <?php echo $atts['name'];?>, and you are <?php echo $atts['age'];?> years old ?</p>
        <?php
        return ob_get_clean();
    }
}

new AdvanceShortcode();