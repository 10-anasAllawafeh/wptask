<?php
/**
 * LogBook Theme Options Panel
 */
$wp_customize->add_panel('logbook_wp_theme_options', array(
    'title' => esc_html__('LogBook Settings', 'logbook-wp') ,
    'priority' => 1,
));

/*Header Menu Section*/
$wp_customize->add_section('logbook_wp_header_menu_section', array(
    'title' => esc_html__('Sticky Menu Option', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10,
    'description' => esc_html__('Sticky Menu Enable And Disable Option .', 'logbook-wp') ,
));

/*enable sticky*/
$wp_customize->add_setting('logbook_wp_sticky_menu_enable', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox'
));

$wp_customize->add_control('logbook_wp_sticky_menu_enable', array(
    'label' => esc_html__('Enable Sticky Menu', 'logbook-wp') ,
    'section' => 'logbook_wp_header_menu_section',
    'settings' => 'logbook_wp_sticky_menu_enable',
    'type' => 'checkbox'
));

/*Blog Post Options Section*/
$wp_customize->add_section('logbook_wp_general_options', array(
    'title' => esc_html__('Log Book Read More and Excerpt Options', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10,
    'description' => esc_html__('Personalize the settings of your theme.', 'logbook-wp') ,
));

// Read More Label
$wp_customize->add_setting('logbook_wp_read_more_label', array(
    'default' => esc_html__('continue reading', 'logbook-wp'),
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('logbook_wp_read_more_label', array(
    'label' => esc_html__('Read More Label', 'logbook-wp') ,
    'section' => 'logbook_wp_general_options',
    'priority' => 1,
    'type' => 'text',
));

// Excerpt Length
$wp_customize->add_setting('logbook_wp_excerpt_length', array(
    'default' => esc_html__('55', 'logbook-wp'),
    'sanitize_callback' => 'absint',
));

$wp_customize->add_control('logbook_wp_excerpt_length', array(
    'label' => esc_html__('Excerpt Length', 'logbook-wp') ,
    'description' => esc_html__('0 will not show the excerpt.', 'logbook-wp') ,
    'section' => 'logbook_wp_general_options',
    'priority' => 2,
    'type' => 'number',
));

/*Blog Post Options*/
$wp_customize->add_section('logbook_wp_archive_content_options', array(
    'title' => esc_html__('Log Book Blog Post Options', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10,
    'description' => esc_html__('Setting will also apply on archieve and search page.', 'logbook-wp') ,
));

/*======================*/

// Post Author Display Control
$wp_customize->add_setting('logbook_wp_archive_co_post_author', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_archive_co_post_author', array(
    'label' => esc_html__('Display Author', 'logbook-wp') ,
    'section' => 'logbook_wp_archive_content_options',
    'priority' => 2,
    'type' => 'checkbox',
));

// Post Date Display Control
$wp_customize->add_setting('logbook_wp_archive_co_post_date', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_archive_co_post_date', array(
    'label' => esc_html__('Display Date', 'logbook-wp') ,
    'section' => 'logbook_wp_archive_content_options',
    'priority' => 3,
    'type' => 'checkbox',
));

// Featured Image Archive Control
$wp_customize->add_setting('logbook_wp_archive_co_featured_image', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_archive_co_featured_image', array(
    'label' => esc_html__('Display Featured Image', 'logbook-wp') ,
    'section' => 'logbook_wp_archive_content_options',
    'priority' => 5,
    'type' => 'checkbox',
));

/*Single Post Options*/
$wp_customize->add_section('logbook_wp_single_content_options', array(
    'title' => esc_html__('Log Book Single Post Options', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10,
    'description' => esc_html__('Setting will apply on the content of single posts.', 'logbook-wp') ,
));

// Post Author Display Control
$wp_customize->add_setting('logbook_wp_single_co_post_author', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_single_co_post_author', array(
    'label' => esc_html__('Display Author', 'logbook-wp') ,
    'section' => 'logbook_wp_single_content_options',
    'priority' => 2,
    'type' => 'checkbox',
));

// Post Date Display Control
$wp_customize->add_setting('logbook_wp_single_co_post_date', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_single_co_post_date', array(
    'label' => esc_html__('Display Date', 'logbook-wp') ,
    'section' => 'logbook_wp_single_content_options',
    'priority' => 3,
    'type' => 'checkbox',
));

// Single Post Tags Display Control
$wp_customize->add_setting('logbook_wp_single_co_post_tags', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_single_co_post_tags', array(
    'label' => esc_html__('Display Tags', 'logbook-wp') ,
    'section' => 'logbook_wp_single_content_options',
    'priority' => 5,
    'type' => 'checkbox',
));

// Single Post Category Display Control
$wp_customize->add_setting('logbook_wp_single_co_post_category', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_single_co_post_category', array(
    'label' => esc_html__('Display Category', 'logbook-wp') ,
    'section' => 'logbook_wp_single_content_options',
    'priority' => 5,
    'type' => 'checkbox',
));

// Featured Image Post Display Control
$wp_customize->add_setting('logbook_wp_single_co_featured_image_post', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_single_co_featured_image_post', array(
    'label' => esc_html__('Display Featured Image', 'logbook-wp') ,
    'section' => 'logbook_wp_single_content_options',
    'priority' => 7,
    'type' => 'checkbox',
));

//Sidebar Section
$wp_customize->add_section('logbook_wp_sidebar_section', array(
    'title' => esc_html__('LogBook Sidebar Setting', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10
));

// Main Sidebar Position
$wp_customize->add_setting('logbook_wp_sidebar_position', array(
    'default' => esc_html__('grid', 'logbook-wp') ,
    'sanitize_callback' => 'logbook_wp_sanitize_select',
));

$wp_customize->add_control('logbook_wp_sidebar_position', array(
    'label' => esc_html__('Sidebar Position', 'logbook-wp') ,
    'section' => 'logbook_wp_sidebar_section',
    'priority' => 2,
    'type' => 'select',
    'choices' => array(
        'right' => esc_html__('Right Sidebar', 'logbook-wp') ,
        'left' => esc_html__('Left Sidebar', 'logbook-wp') ,
        'no' => esc_html__('No Sidebar', 'logbook-wp') ,
        'grid' => esc_html__('Grid Layout', 'logbook-wp')
    ) ,
));

//Footer Section
$wp_customize->add_section('logbook_wp_footer_section', array(
    'title' => esc_html__('LogBook Footer Setting', 'logbook-wp') ,
    'panel' => 'logbook_wp_theme_options',
    'priority' => 10
));

//Footer bottom Copyright Display Control
$wp_customize->add_setting('logbook_wp_footer_copyright_display', array(
    'default' => true,
    'sanitize_callback' => 'logbook_wp_sanitize_checkbox',
));

$wp_customize->add_control('logbook_wp_footer_copyright_display', array(
    'label' => esc_html__('Display Copyright Footer', 'logbook-wp') ,
    'section' => 'logbook_wp_footer_section',
    'priority' => 1,
    'type' => 'checkbox',
));

// Copyright Control
$wp_customize->add_setting('logbook_wp_copyright', array(
    'default' => esc_html__('Proudly Powered By WordPress', 'logbook-wp'),
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('logbook_wp_copyright', array(
    'label' => esc_html__('Copyright', 'logbook-wp') ,
    'section' => 'logbook_wp_footer_section',
    'priority' => 2,
    'type' => 'textarea',
    'active_callback' => 'logbook_wp_footer_copyright_callback'
));