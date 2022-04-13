<?php

/**
 *
 */
class Accordion_Slider_WP_CPT_Fields_Helper {

	public static function get_tabs() {

		return apply_filters( 'accordion_slider_gallery_tabs', array(
			'general' => array(
				'label'       => esc_html__( 'General', 'accordion-slider' ),
				'title'       => esc_html__( 'General Settings', 'accordion-slider' ),
				'description' => 'Select General Settings of the Accordion Slider',
				"icon"        => "dashicons dashicons-admin-generic",
				'priority'    => 10,
			),
			
			'captions' => array(
				'label'       => esc_html__( 'Captions', 'accordion-slider' ),
				'title'       => esc_html__( 'Caption Settings', 'accordion-slider' ),
				'description' => 'The settings shown below adjust how the image title/description will appear on the front-end Accordion Slider',
				"icon"        => "dashicons dashicons-menu-alt3",
				'priority'    => 20,
			),
			
			'phpcode' => array(
				'label'       => esc_html__( 'Shortcode / PHP Code', 'accordion-slider' ),
				'title'       => esc_html__( '', 'accordion-slider' ),
				/*'description' => $phpcode_description,*/
				"icon"        => "dashicons dashicons-editor-code",
				'priority'    => 70,
			),
			
			'customizations' => array(
				'label'       => esc_html__( 'Custom CSS', 'accordion-slider' ),
				'title'       => esc_html__( 'Custom CSS', 'accordion-slider' ),
				'description' => 'Add custom CSS to Accordion Slider for advanced modifications',
				"icon"        => "dashicons dashicons-admin-tools",
				'priority'    => 90,
			),
            
		) );

	}

	public static function get_fields( $tab ) {

		$fields = apply_filters( 'accordion_slider_gallery_fields', 
			array(
				'general' => array(
					'font_family' => array(
					"name"        => esc_html__( 'Font Family', 'accordion-slider' ),
					"type"        => "select",
					"description" => esc_html__( 'Select the font family you want to use', 'accordion-slider' ),
					'default'     => 'Arial',
					"values"      => array(
						'Times New Roman' => esc_html__( 'Default', 'accordion-slider' ),
						'Arial' 		  => esc_html__( 'Arial', 'accordion-slider' ),
						'Arial Black'     => esc_html__( 'Arial Black', 'accordion-slider' ),
						'Calibri'	 	  => esc_html__( 'Calibri', 'accordion-slider' ),
						'Candara'	 	  => esc_html__( 'Candara', 'accordion-slider' ),
						'Courier New'	  => esc_html__( 'Courier New', 'accordion-slider' ),
						'Georgia'		  => esc_html__( 'Georgia', 'accordion-slider' ),
						'Grande'		  => esc_html__( 'Grande', 'accordion-slider' ),
						'Helvetica'		  => esc_html__( 'Helvetica', 'accordion-slider' ),
						'Impact' 		  => esc_html__( 'Impact', 'accordion-slider' ),
						'Lucida' 		  => esc_html__( 'Lucida', 'accordion-slider' ),
						'Lucida Grande'   => esc_html__( 'Lucida Grande', 'accordion-slider' ),
						'Open Sans'       => esc_html__( 'Open Sans', 'accordion-slider' ),
						'OpenSansBold'    => esc_html__( 'OpenSansBold', 'accordion-slider' ),
						'Optima'  		  => esc_html__( 'Optima', 'accordion-slider' ),
						'Palatino Linotype' => esc_html__( 'Palatino', 'accordion-slider' ),
						'Sans' 			  => esc_html__( 'Sans', 'accordion-slider' ),
						'sans-serif'	  => esc_html__( 'Sans-serif', 'accordion-slider' ),
						'Tahom'           => esc_html__( 'Tahom', 'accordion-slider' ),
						'Tahoma'          => esc_html__( 'Tahoma', 'accordion-slider' ),
						'Tahoma'          => esc_html__( 'Tahoma', 'accordion-slider' ),
						'Verdana' 		  => esc_html__( 'Verdana', 'accordion-slider' ),
					),
					'priority' => 30,
				),

				"width"          => array(
					"name"        => esc_html__( 'Width', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Set the width of the Accordion Slider, Can be in pixels.', 'accordion-slider' ),
					'default'     => '1000px',
					'priority' => 35,
				),

				"height"          => array(
					"name"        => esc_html__( 'Height', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Set the Height of the Accordion Slider, Can be in pixels.', 'accordion-slider' ),
					'default'     => '400px',
					'priority' => 40,
				),

				'orientation' => array(
					"name"        => esc_html__( 'Orientation', 'accordion-slider' ),
					"type"        => "select",
					"description" => esc_html__( 'Select the orientation of Accordion Slider', 'accordion-slider' ),
					'default'     => 'horizontal',
					"values"      => array(
						'horizontal' 	=> esc_html__( 'Horizontal', 'accordion-slider' ),
						'vertical' 		=> esc_html__( 'Vertical', 'accordion-slider' ),
					),
					'priority' => 45,
				),

				"visible_images"          => array(
					"name"        => esc_html__( 'Visible Accordion Images', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Number of images shown in each slide of Accordion Slider.', 'accordion-slider' ),
					'default'     => '3',
					'priority' => 50,
				),

				"image_distance"          => array(
					"name"        => esc_html__( 'Space Between Images', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Space between images of Accordion Slider, Can be in pixels.', 'accordion-slider' ),
					'default'     => '1',
					'priority' => 55,
				),

				"max_opened_image_size"          => array(
					"name"        => esc_html__( 'Max Opened Image Size', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Open image size of Accordion Slider, Can be in %.', 'accordion-slider' ),
					'default'     => '80%',
					'priority' => 55,
				),

				'open_image_on' => array(
					"name"        => esc_html__( 'Open Accordion Image On', 'accordion-slider' ),
					"type"        => "select",
					"description" => esc_html__( 'Image will be opened in', 'accordion-slider' ),
					'default'     => 'hover',
					"values"      => array(
						'hover'   => esc_html__( 'Hover', 'accordion-slider' ),
						'click'   => esc_html__( 'Click', 'accordion-slider' ),
					),
					'priority' => 60,
				),

				'close_panel_on_mouse_out' => array(
					"name"        => esc_html__( 'Close Panel on Mouse Out', 'accordion-slider' ),
					"type"        => "select",
					"description" => esc_html__( 'Close Panel on Mouse Out', 'accordion-slider' ),
					'default'     => 'hover',
					"values"      => array(
						'true'   => esc_html__( 'True', 'accordion-slider' ),
						'false'   => esc_html__( 'False', 'accordion-slider' ),
					),
					'priority' => 60,
				),

				'autoplay_direction' => array(
					"name"        => esc_html__( 'Autoplay Direction', 'accordion-slider' ),
					"type"        => "select",
					"description" => esc_html__( 'Autoplay Direction', 'accordion-slider' ),
					'default'     => 'forward',
					"values"      => array(
						'normal'   => esc_html__( 'Normal', 'accordion-slider' ),
						'backwards'   => esc_html__( 'Backward', 'accordion-slider' ),
					),
					'priority' => 60,
				),

				"autoplay_delay"          => array(
					"name"        => esc_html__( 'Autoplay Delay', 'accordion-slider' ),
					"type"        => "text",
					"description" => esc_html__( 'Autoplay Delay in Milliseconds', 'accordion-slider' ),
					'default'     => '5000',
					'priority' => 61,
				),

				"close_panel_on_mouse_out"        => array(
					"name"        => esc_html__( 'Close Panel on Mouse Out', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 1,
					"description" => esc_html__( 'Close Panel on Mouse Out', 'accordion-slider' ),
					'priority'    => 62,
				),

				"shadow"        => array(
					"name"        => esc_html__( 'Shadow', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 1,
					"description" => esc_html__( 'Image Shadow of Accordion Slider', 'accordion-slider' ),
					'priority'    => 65,
				),

				"autoplay"        => array(
					"name"        => esc_html__( 'Autoplay', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 1,
					"description" => esc_html__( 'Autoplay of Accordion Slider', 'accordion-slider' ),
					'priority'    => 70,
				),


				"mouse_wheel"        => array(
					"name"        => esc_html__( 'Mouse Wheel', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 1,
					"description" => esc_html__( 'Image scroll using mouse wheel', 'accordion-slider' ),
					'priority'    => 75,
				),
			
			),
			

			'captions' => array(
				"titleColor"     => array(
					"name"        => esc_html__( 'Title Color', 'accordion-slider' ),
					"type"        => "color",
					"description" => esc_html__( 'Set the title color', 'accordion-slider' ),
					"default"     => "#ffffff",
					'priority'    => 5,
				),
				"titleBgColor"     => array(
					"name"        => esc_html__( 'Title Background Color', 'accordion-slider' ),
					"type"        => "color",
					"description" => esc_html__( 'Set the title background color', 'accordion-slider' ),
					"default"     => "",
					'priority'    => 10,
				),
				"captionColor"     => array(
					"name"        => esc_html__( 'Caption Color', 'accordion-slider' ),
					"type"        => "color",
					"description" => esc_html__( 'Set the caption color', 'accordion-slider' ),
					"default"     => "#ffffff",
					'priority'    => 15,
				),
				"captionBgColor"     => array(
					"name"        => esc_html__( 'Caption Background Color', 'accordion-slider' ),
					"type"        => "color",
					"description" => esc_html__( 'Set the caption background color', 'accordion-slider' ),
					"default"     => "",
					'priority'    => 20,
				),
				
				"hide_title"        => array(
					"name"        => esc_html__( 'Hide Title', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 0,
					"description" => esc_html__( 'Hide/Show image title from Accordion Slider', 'accordion-slider' ),
					'priority'    => 40,
				),
				"hide_description"        => array(
					"name"        => esc_html__( 'Hide Caption', 'accordion-slider' ),
					"type"        => "toggle",
					"default"     => 0,
					"description" => esc_html__( 'Hide/Show image caption from Accordion Slider', 'accordion-slider' ),
					'priority'    => 50,
				),
				"titleFontSize"    => array(
					"name"        => esc_html__( 'Title Font Size', 'accordion-slider' ),
					"type"        => "ui-slider",
					"min"         => 0,
					"max"         => 50,
					"default"     => 18,
					"description" => esc_html__( 'Set the title font size in pixels', 'accordion-slider' ),
					'priority'    => 60,
				),
				"captionFontSize"  => array(
					"name"        => esc_html__( 'Caption Font Size', 'accordion-slider' ),
					"type"        => "ui-slider",
					"min"         => 0,
					"max"         => 50,
					"default"     => 14,
					"description" => esc_html__( 'Set the caption font size in pixels', 'accordion-slider' ),
					'priority'    => 70,
				),
                
			),

			'phpcode'  => array(
				"php_short"         => array(
					"name"        => esc_html__( 'Shortcode', 'accordion-slider' ),
					"type"        => "text_short",
					"description" => esc_html__( 'Copy Shortcode from here', 'accordion-slider' ),
					'priority' => 5,
				),

				"php_code"         => array(
					"name"        => esc_html__( 'PHP Code', 'accordion-slider' ),
					"type"        => "text_php",
					"description" => esc_html__( 'Copy PHP Code from here', 'accordion-slider' ),
					'priority' => 10,
				),
			),
			
			
			'customizations' => array(
				"style"  => array(
					"name"        => esc_html__( 'Custom CSS', 'accordion-slider' ),
					"type"        => "custom_code",
					"syntax"      => 'css',
					"description" => '<strong>' . esc_html__( 'Just write the code without using the &lt;style&gt;&lt;/style&gt; tags', 'accordion-slider' ) . '</strong>',
					'priority' => 20,
				),
			),
		) );

		

		if ( 'all' == $tab ) {
			return $fields;
		}

		if ( isset( $fields[ $tab ] ) ) {
			return $fields[ $tab ];
		} else {
			return array();
		}

	}

	public static function get_defaults() {
		return apply_filters( 'accordion_slider_lite_default_settings', array(
            'type'                      => 'custom-grid',
            'width'                     => '1000px',
            'height' 					=> '400px',
			'titleColor'                => '#ffffff',
            'captionColor'              => '#ffffff',
            'wp_field_caption'          => 'none',
            'wp_field_title'            => 'none',
            'hide_title'                => 0,
            'image_distance'			=> 0,
            'hide_description'          => 0,
            'captionFontSize'           => '14',
            'titleFontSize'             => '18',
            'style'                     => '',
            'gutter'                    => 8,
            'max_opened_image_size'  => '80%',
            'open_image_on'				=> 'hover',
            'shadow'					=> 1,
            'autoplay'					=> 1,
            'mouse_wheel'				=> 1,
        ) );
	}

}
