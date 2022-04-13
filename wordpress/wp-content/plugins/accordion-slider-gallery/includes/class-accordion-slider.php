<?php
/**
 * The core plugin class.
 *
 * This is used to define admin-specific hooks, internationalization, and
 * public-facing site hooks.
 *
 * 
 */
class Accordion_Slider{
    

    private function load_dependencies() {

        require_once ACCORDION_SLIDER_INCLUDES . 'libraries/class-accordion-slider-template-loader.php';
        require_once ACCORDION_SLIDER_INCLUDES . 'helper/class-accordion-slider-helper.php';
        
        require_once ACCORDION_SLIDER_INCLUDES . 'admin/class-accordion-slider-image.php';
       
        require_once ACCORDION_SLIDER_INCLUDES . 'admin/class-accordion-slider-cpt.php';
       
        require_once ACCORDION_SLIDER_INCLUDES . 'admin/class-accordion-slider-admin.php';

        require_once ACCORDION_SLIDER_INCLUDES . 'public/class-accordion-slider-shortcode.php';


    }

    private function define_admin_hooks() {
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 20 );
        new Accordion_Slider_CPT();
    }

    private function define_public_hooks() {}
    
       
	/* Enqueue Admin Scripts */
	public function admin_scripts( $hook ) {

		global $id, $post;

        // Get current screen.
        $screen = get_current_screen();

        // Check if is Image Slider custom post type
        if ( 'accordion_slider' !== $screen->post_type ) {
            return;
        }

        // Set the post_id
        $post_id = isset( $post->ID ) ? $post->ID : (int) $id;

		if ( 'post-new.php' == $hook || 'post.php' == $hook ) {

			/* CPT Styles & Scripts */
			// Media Scripts
			wp_enqueue_media( array(
	            'post' => $post_id,
	        ) );

	        $accordion_slider_helper = array(
	        	'items' => array(),
	        	'settings' => array(),
	        	'strings' => array(
	        		'limitExceeded' => sprintf( __( 'You excedeed the limit of 30 photos. You can remove an image or %supgrade to pro%s', 'accordion-slider' ), '<a href="#" target="_blank">', '</a>' ),
	        	),
	        	'id' => $post_id,
	        	'_wpnonce' => wp_create_nonce( 'accordion-slider-ajax-save' ),
	        	'ajax_url' => admin_url( 'admin-ajax.php' ),
	        );

	        // Get all items from current gallery.
	        $images = get_post_meta( $post_id, 'slider-images', true );
	        
	        if ( is_array( $images ) && ! empty( $images ) ) {
	        	foreach ( $images as $image ) {
	        		if ( ! is_numeric( $image['id'] ) ) {
	        			continue;
	        		}

	        		$attachment = wp_prepare_attachment_for_js( $image['id'] );
	        		$image_url  = wp_get_attachment_image_src( $image['id'], 'large' );
					$image_full = wp_get_attachment_image_src( $image['id'], 'full' );

					$image['full']        = $image_full[0];
					$image['thumbnail']   = $image_url[0];
					$image['orientation'] = $attachment['orientation'];

					$accordion_slider_helper['items'][] = $image;

	        	}
	        } 
	        else 
	        {   
	        	/*default image*/
	        	$accordion_slider_helper['items'] =  get_option('rpg-slider-images-default');
	        }

	        // Get current gallery settings.
	        $settings = get_post_meta( $post_id, 'accordion-slider-settings', true );
	        if ( is_array( $settings ) ) {
	        	$accordion_slider_helper['settings'] = wp_parse_args( $settings, Accordion_Slider_WP_CPT_Fields_Helper::get_defaults() );
	        }else{
	        	$accordion_slider_helper['settings'] = Accordion_Slider_WP_CPT_Fields_Helper::get_defaults();
	        }

			wp_enqueue_style( 'wp-color-picker' );
			
			wp_enqueue_style( 'accordion-slider-cpt-',           ACCORDION_SLIDER_ASSETS . 'css/accordion-slider-cpt.css', null, ACCORDION_SLIDER_CURRENT_VERSION );
			wp_enqueue_style( 'bootstrap-css', ACCORDION_SLIDER_ASSETS . 'css/bootstrap.css', null, ACCORDION_SLIDER_CURRENT_VERSION );
			
			/*fontawesome*/
			wp_enqueue_style('rpg-font-awesome-5.0.8', ACCORDION_SLIDER_ASSETS.'css/font-awesome-latest/css/fontawesome-all.min.css');

			wp_enqueue_script( 'accordion-slider-resize-senzor', ACCORDION_SLIDER_ASSETS . 'js/resizesensor.js', array( 'jquery' ), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-packery',       ACCORDION_SLIDER_ASSETS . 'js/packery.min.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-droppable', 'jquery-ui-resizable', 'jquery-ui-draggable' ), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-settings',      ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-settings.js', array( 'jquery', 'jquery-ui-slider', 'wp-color-picker', 'jquery-ui-sortable' ), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-save',          ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-save.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-items',         ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-items.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-modal',         ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-modal.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-upload-media',        ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-upload.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-gallery',       ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-gallery.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_enqueue_script( 'accordion-slider-conditions',    ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-conditions.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );

			

			do_action( 'accordion_slider_scripts_before_accordion_slider' );

			wp_enqueue_script( 'accordion-slider', ACCORDION_SLIDER_ASSETS . 'js/accordion-slider.js', array(), ACCORDION_SLIDER_CURRENT_VERSION, true );
			wp_localize_script( 'accordion-slider', 'AccordionSliderHelper', $accordion_slider_helper );

			do_action( 'accordion_slider_scripts_after_accordion_slider' );

		}
	}


    // loading language files
    public function accordion_slider_load_plugin_textdomain() {
        $rs = load_plugin_textdomain('accordion-slider', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }

    
    public function __construct() {
        
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();

        
        //loading plugin translation files
        add_action('plugins_loaded', array($this, 'accordion_slider_load_plugin_textdomain'));

        if ( is_admin() ) {
            $plugin = plugin_basename(__FILE__);
            
        }
    }

}
