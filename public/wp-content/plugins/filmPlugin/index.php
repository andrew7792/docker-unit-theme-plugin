<?php

add_action( 'init', 'create_movie_review' );

function create_movie_review() {
    register_post_type( 'movie_reviews',
        array(
            'labels' => array(
        'name' => 'Movie Reviews',
                'singular_name' => 'Movie Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Movie Review',
                'edit' => 'Edit',
                'edit_item' => 'Edit Movie Review',
                'new_item' => 'New Movie Review',
                'view' => 'View',
                'view_item' => 'View Movie Review',
                'search_items' => 'Search Movie Reviews',
                'not_found' => 'No Movie Reviews found',
                'not_found_in_trash' => 'No Movie Reviews found in Trash',
                'parent' => 'Parent Movie Review'
            ),
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-media-video',
            'has_archive' => true
        )
    );
}


add_action( 'init', 'tru_register_products' ); // Использовать функцию только внутри хука init

function tru_register_products() {
    $labels = array(
        'name' => '',
        'singular_name' => 'Films', // админ панель Добавить->Функцию
        'add_new' => 'Add films',
        'add_new_item' => 'Add new film', // заголовок тега <title>
        'edit_item' => 'Edit film',
        'new_item' => 'New film',
        'all_items' => 'All films',
        'view_item' => 'Watch the film on the site',
        'search_items' => 'Search film',
        'not_found' =>  'The film was not found.',
        'not_found_in_trash' => 'There are no movies in the basket.',
        'menu_name' => 'Films' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true, // благодаря этому некоторые параметры можно пропустить
        'menu_icon' => 'dashicons-format-video', // иконка фильмов
        'menu_position' => 15,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments')
    );
    register_post_type('product',$args);
}

