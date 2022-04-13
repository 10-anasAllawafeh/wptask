<?php
if (!defined('_LOGBOOK_VERSION'))
{
    // Replace the version number of the theme on each release.
    define('_LOGBOOK_VERSION', '1.0.0');
}

if (!function_exists('logbook_wp_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function logbook_wp_setup()
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
        */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Main Menu', 'logbook-wp') ,
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
        */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('logbook_wp_custom_background_args', array(
            'default-color' => 'fff7f3',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'logbook_wp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function logbook_wp_content_width()
{
    $GLOBALS['content_width'] = apply_filters('logbook_wp_content_width', 640);
}
add_action('after_setup_theme', 'logbook_wp_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function logbook_wp_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'logbook-wp') ,
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'logbook-wp') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer One', 'logbook-wp') ,
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'logbook-wp') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Two', 'logbook-wp') ,
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'logbook-wp') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Three', 'logbook-wp') ,
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'logbook-wp') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Four', 'logbook-wp') ,
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'logbook-wp') ,
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'logbook_wp_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function logbook_wp_scripts()
{
    wp_enqueue_style('logbook-wp-style', get_stylesheet_uri() , array() , _LOGBOOK_VERSION);

    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/styles/css/bootstrap.css');

    wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/styles/css/font-awesome.css');

    wp_enqueue_style('logbook-wp-responsive-css', get_template_directory_uri() . '/styles/css/responsive.css');

    wp_enqueue_style('logbook-wp-font', 'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap');

    //JS
    wp_enqueue_script('logbook-wp-main.js', get_template_directory_uri() . '/styles/js/logbook-wp-main.js', array(
        'jquery'
    ) , _LOGBOOK_VERSION, true);

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/styles/js/bootstrap.js', array(
        'jquery'
    ) , _LOGBOOK_VERSION, true);

    wp_enqueue_script('logbook-wp-navigation', get_template_directory_uri() . '/styles/js/navigation.js', array() , _LOGBOOK_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments'))
    {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'logbook_wp_scripts');

/**
 * Removal of dots in excerpt 
 */

function logbook_wp_excerpt_more($more)
{

    $more = '...';
    if (is_admin())
    {
        return $more;
    }

}
add_filter('excerpt_more', 'logbook_wp_excerpt_more');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/backend/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/backend/template-tags.php';

/**
 * Customizer controls
 */
require get_template_directory() . '/backend/customizer.php';

require get_template_directory() . '/backend/controls.php';

require get_template_directory()  . '/backend/tgm/class-tgm-plugin-activation.php';
require get_template_directory(). '/backend/tgm/hook-tgm.php';

/**
 * Added buttom in customizer 
 */
require_once( trailingslashit( get_template_directory() ) . '/backend/custom-button/class-customize.php' );

/**
 * Add theme admin page.
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'backend/about.php' );
}