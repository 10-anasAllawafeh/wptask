<?php
function logbook_wp_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh))
    {
        $wp_customize
            ->selective_refresh
            ->add_partial('blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'logbook_wp_customize_partial_blogname',
        ));
        $wp_customize
            ->selective_refresh
            ->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'logbook_wp_customize_partial_blogdescription',
        ));
    }
    require get_template_directory() . '/backend/theme-settings.php';
}
add_action('customize_register', 'logbook_wp_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function logbook_wp_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function logbook_wp_customize_partial_blogdescription()
{
    bloginfo('description');
}
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function logbook_wp_customize_preview_js()
{
    wp_enqueue_script('logbook-wp-customizer', get_template_directory_uri() . '/styles/js/customizer.js', array(
        'customize-preview'
    ) , _LOGBOOK_VERSION, true);
}
add_action('customize_preview_init', 'logbook_wp_customize_preview_js');

if (!function_exists('logbook_wp_header_social_active_callback')):
    function logbook_wp_header_social_active_callback()
    {
        $show_social = get_theme_mod('logbook_wp_left_header_social_icon_display', true);

        if ($show_social)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
endif;

if (!function_exists('logbook_wp_footer_copyright_callback')):
    function logbook_wp_footer_copyright_callback()
    {

        $show_copyright = get_theme_mod('logbook_wp_footer_copyright_display', true);

        if (true == $show_copyright)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
endif;

if (!function_exists('logbook_wp_slider_callback')):
    function logbook_wp_slider_callback()
    {

        $show_copyright = get_theme_mod('logbook_wp_slider_display', true);

        if (true == $show_copyright)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
endif;