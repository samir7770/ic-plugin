<?php 

if(!defined("ABSPATH")){
    exit();
}

$args = [
    'post_type' => ['post'],
    'posts_per_page' => '6'
];

$query = new WP_Query($args);

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        
        // Output post details
        the_title('<h2>', '</h2>');
        the_excerpt();
    }
} else {
    echo 'No posts found.';
}

// Reset post data to avoid conflicts
wp_reset_postdata();
?>
