<?php

/**
 *
 */
class Accordion_Slider_Shortcode {


	private $loader;

	function __construct() {

		$this->loader  = new Accordion_Slider_Template_Loader();

		add_shortcode( 'accordion-slider', array( $this, 'accordion_slider_shortcode_handler' ) );
		add_shortcode( 'Accordion-Slider', array( $this, 'accordion_slider_shortcode_handler' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'accordion_slider_scripts' ) );

	}

	public function accordion_slider_scripts() {

		wp_enqueue_style( 'accordion-slider-css', ACCORDION_SLIDER_ASSETS . 'css/accordion-slider.css', null, ACCORDION_SLIDER_CURRENT_VERSION );


		wp_enqueue_script( 'jquery-accordion-slider-js', ACCORDION_SLIDER_ASSETS . 'js/accordion-slider-js.js', array('jquery'), ACCORDION_SLIDER_CURRENT_VERSION, true ); 

	}


	public function accordion_slider_shortcode_handler( $Id ) {
		// Id return id

		ob_start();	
		if(!isset($Id['id'])) 
		 {
			$WPSM_Gallery_ID = "";
		 } 
		else 
		{
			$WPSM_Gallery_ID = $Id['id'];
		}

		$post_type = "accordion_slider";
		$AllTeams = array(  'p' => $WPSM_Gallery_ID, 'post_type' => $post_type, 'orderby' => 'ASC');
	    $loop = new WP_Query( $AllTeams );
		
		while ( $loop->have_posts() ) : $loop->the_post();
			
			$PostId = get_the_ID();
			$settings = get_post_meta( $PostId, 'accordion-slider-settings', true );
			$default  = Accordion_Slider_WP_CPT_Fields_Helper::get_defaults();
			$settings = wp_parse_args( $settings, $default );

			/*$All_data = get_post_meta( $PostId, 'slider-images', true); //image data
			$TotalCount = sizeof($All_data);*/

			$images = apply_filters( 'accordion_slider_before_shuffle_images', get_post_meta( $PostId, 'slider-images', true ), $settings );
			
			//$url = wp_get_attachment_image_src($id, 'as_accordion_slider', true);

			require "templates/design/accordion-slider/accordion-slider.php";

		endwhile;

		wp_reset_query();
    return ob_get_clean();
	  
	}
	
}

new Accordion_Slider_Shortcode();