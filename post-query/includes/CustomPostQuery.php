<?php 

if (!defined('ABSPATH')){
    exit();
}
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = [
    'post_type' => 'book',
    'posts_per_page' => 2,
    'paged' => 2,
    // 'tax_query' => [
    //     'relation' => 'or',
    //     [
    //         'taxonomy' => 'genre',
    //         'field' => 'slug',
    //         'terms' => 'romantic'
    //     ],
    //     [
    //         'taxonomy' => 'genre',
    //         'field' => 'slug',
    //         'terms' => 'sci-fi'
    //     ]
    // ]
];

$query = new WP_Query($args);?> 

<div class="book-grid"> 
    <?php if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
            ?>
                <div class="book-card">
                    <div class="book-thumb"><?php has_post_thumbnail() ? the_post_thumbnail() : 'No thumb' ; ?></div>
                    <div class="book-content">
                        <div class="book-genre">
                            <?php $terms = the_terms(get_the_ID(), 'genre', '', ',');?>
                        </div>
                        <div class="book-title"><?php the_title('<h2>', "</h2>");  ?></div>
                        <div class="book-rating">
                            <?php  
                                for($i=0; $i<get_field('rating') ; $i++){
                                    echo '<span class="star">★</span>';
                                }
                            ?></div>
                        <div class="book-author"><?php the_field('author') ; ?></div>
                        <div class="book-excerpt"><?php the_content(); ?></div>
                        <button class="read-more"><a href="<?php the_permalink() ; ?>" class="read-more-link">Read More</a></button>
                    </div>
                </div>
            <?php
        }
    }else{
        echo "No Books found !!";
    }?> 
</div>

<div class="book-pagination">
    <?php  
        echo paginate_links([
            'total' => $query->max_num_pages,
            'prev_text' => 'Piche ja',
            'next_text' => 'Samne ja'
        ]);
    ?>
</div>

<?php // var_dump($query);

wp_reset_postdata();
?>