<?php

if (!defined('ABSPATH')) {
    exit;
}

function adeline_portfolio_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'adeline-portfolio'),
        'footer' => __('Footer Menu', 'adeline-portfolio'),
    ));
}
add_action('after_setup_theme', 'adeline_portfolio_setup');

function adeline_portfolio_enqueue_assets() {
    wp_enqueue_style(
        'adeline-portfolio-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'adeline-portfolio-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'adeline_portfolio_enqueue_assets');
