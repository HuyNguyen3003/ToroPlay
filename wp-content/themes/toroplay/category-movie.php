<?php
get_header();

// Lấy category_id từ query
$category_id = get_query_var('category_id');

// Lấy danh sách các bộ phim có id_category tương ứng
global $wpdb;
$movies = $wpdb->get_results($wpdb->prepare("SELECT * FROM movies WHERE id_category = %d", $category_id));

if ($movies) {
    echo '<h1>Movies in Category ID: ' . esc_html($category_id) . '</h1>';
    echo '<ul>';
    foreach ($movies as $movie) {
        echo '<li>';
        echo '<h2>' . esc_html($movie->title) . '</h2>';
        echo '<img src="' . esc_url($movie->path_img) . '" alt="' . esc_attr($movie->title) . '">';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No movies found in this category.</p>';
}

get_footer();
