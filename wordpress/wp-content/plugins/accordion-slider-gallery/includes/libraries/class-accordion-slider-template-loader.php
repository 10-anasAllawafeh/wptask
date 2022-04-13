<?php

if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
  require ACCORDION_SLIDER_LIBRARIES . 'class-gamajo-template-loader.php';
}

/**
 *
 * Template loader for Image Slider.
 *
 * Only need to specify class properties here.
 *
 */
class Accordion_Slider_Template_Loader extends Gamajo_Template_Loader {

  /**
   * Prefix for filter names.
   *
   * @since 1.0.1
   *
   * @var string
   */
  protected $filter_prefix = 'accordion-slider';

  /**
   * Directory name where custom templates for this plugin should be found in the theme.
   *
   * @since 1.0.1
   *
   * @var string
   */
  protected $theme_template_directory = 'accordion-slider';

  /**
   * Reference to the root directory path of this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * In this case, `ACCORDION_SLIDER_PATH` would be defined in the root plugin file as:
   *
   * @since 1.0.1
   *
   * @var string
   */
  protected $plugin_directory = ACCORDION_SLIDER_DIR;

  /**
   * Directory name where templates are found in this plugin.
   *
   * Can either be a defined constant, or a relative reference from where the subclass lives.
   *
   * @since 1.0.1
   *
   * @var string
   */
  protected $plugin_template_directory = 'includes/public/templates';
}