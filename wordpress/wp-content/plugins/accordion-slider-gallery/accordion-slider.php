<?php
/*
Plugin Name: Accordion Slider Gallery
Plugin URI: http://onlinenewswebsite.com/demo/accordion-slider-gallery/
Description: Responsive Accorion Slider plugin is an easy way to create responsive accordion slider.
Author: wpdiscover
Author URI: #
Version: 2.2
Text Domain: accordion-slider
*/

/** Configuration **/

if ( !defined( 'ACCORDION_SLIDER_CURRENT_VERSION' ) ) {
    define( 'ACCORDION_SLIDER_CURRENT_VERSION', '2.2' );
}
define( 'ACCORDION_SLIDER_NAME'             , 'accordion_slider' );
define( 'ACCORDION_SLIDER_DIR'              , plugin_dir_path(__FILE__) );
define( 'ACCORDION_SLIDER_URL'              , plugin_dir_url(__FILE__) );

define( 'ACCORDION_SLIDER_INCLUDES'  		, ACCORDION_SLIDER_DIR  . 'includes'    . DIRECTORY_SEPARATOR );
define( 'ACCORDION_SLIDER_ADMIN'            , ACCORDION_SLIDER_INCLUDES   . 'admin'       . DIRECTORY_SEPARATOR );
define( 'ACCORDION_SLIDER_LIBRARIES'        , ACCORDION_SLIDER_INCLUDES   . 'libraries'   . DIRECTORY_SEPARATOR );

define( 'ACCORDION_SLIDER_ASSETS'           , ACCORDION_SLIDER_URL . 'assets/' );
define( 'ACCORDION_SLIDER_JS'               , ACCORDION_SLIDER_URL . 'assets/js/' );
define( 'ACCORDION_SLIDER_IMAGES'           , ACCORDION_SLIDER_URL . 'assets/images/' );
define( 'ACCORDION_SLIDER_RESOURCES'        , ACCORDION_SLIDER_URL . 'assets/resources/' );


/**
* Activating plugin and adding some info
*/
function accordion_slider_activate() {
    update_option( "accordion-slider-v", ACCORDION_SLIDER_CURRENT_VERSION );
    update_option("accordion-slider-type","FREE");
    update_option("accordion-slider-installDate",date('Y-m-d h:i:s') );

    require_once ACCORDION_SLIDER_DIR.'default_image.php';
}

/**
 * Deactivate the plugin
 */
function accordion_slider_deactivate() {
    // Do nothing
} 

// Installation and uninstallation hooks
register_activation_hook(__FILE__, 'accordion_slider_activate' );
register_deactivation_hook(__FILE__, 'accordion_slider_deactivate' );



add_image_size( 'as_accordion_slider',1600,900,true);


/**
 * The core plugin class that is used to define admin-specific hooks,
 * internationalization, and public-facing site hooks.
 */

require ACCORDION_SLIDER_INCLUDES . 'class-accordion-slider.php';


/**
 * Start execution of the plugin.
*/
function accordion_slider_run() {
	//instantiate the plugin class
    $AccordionSlider = new Accordion_Slider();
}
accordion_slider_run();




