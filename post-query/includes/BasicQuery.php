<?php 

if(!defined("ABSPATH")){
    exit();
}

$args = [
    'post_type' => ['post'],
    'posts_per_page' => '2',
    'tax_query' => [
        [
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => 'cat-1'
        ]
    ]
];

$query = new WP_Query($args);

if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        
        // Output post details
        ?>
            <div class="bq-post-grid">
                <a class="bq-post-title" href="<?php the_permalink();?>"> <?php the_title() ; ?></a>
                <p class="bq-post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15) ; ?></p>
                <a class="bq-post-read-more" href="<?php the_permalink();?>"> Read More </a>
            </div>
        <?php
    }
} else {
    echo 'No posts found.';
}

// Reset post data to avoid conflicts
wp_reset_postdata();
?>
