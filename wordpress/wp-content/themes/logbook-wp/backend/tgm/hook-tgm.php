<?php
/**
 * Recommended plugins
 *
 * @package Logbook WP
 */

if ( ! function_exists( 'logbook_wp_recommended_plugins' ) ) :

    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function logbook_wp_recommended_plugins() {

         $plugins = array(
			array(
                'name'     => esc_html__( 'Photo Gallery Builder', 'logbook-wp' ),
                'slug'     => 'photo-gallery-builder',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Accordion Slider Gallery', 'logbook-wp' ),
                'slug'     => 'accordion-slider-gallery',
                'required' => false,
            ),
			array(
                'name'     => esc_html__( 'Timeline', 'logbook-wp' ),
                'slug'     => 'timeline-event-history',
                'required' => false,
            ),
        );

        tgmpa( $plugins );

    }

endif;

add_action( 'tgmpa_register', 'logbook_wp_recommended_plugins' );