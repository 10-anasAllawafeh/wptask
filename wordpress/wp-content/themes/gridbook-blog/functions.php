<?php
function gridbook_blog_enqueue_scripts(){

    wp_enqueue_script( 'gridbook-blog-main', get_stylesheet_directory_uri() . '/styles/js/gridbook-blog-main.js',array('jquery'),true);
    wp_enqueue_style('logbook-wp-parent-style', get_template_directory_uri() . '/style.css');  
    wp_enqueue_style('gridbook-blog-style',get_stylesheet_uri());
    wp_enqueue_style('gridbook-blog-font', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Yellowtail&display=swap');
}
add_action('wp_enqueue_scripts','gridbook_blog_enqueue_scripts');