<?php
/**
 * excerpt lenth.
 */
if (!function_exists('logbook_wp_custom_excerpt_length')) :
    function logbook_wp_custom_excerpt_length($length)
    {
        if (is_admin()) {
            return $length;
        }
        $ext_length = get_theme_mod('logbook_wp_excerpt_length','55', 'logbook-wp');
        if (!empty($ext_length)) {
            return $ext_length;
        }
        return 50;
    }
endif;
add_filter( 'excerpt_length', 'logbook_wp_custom_excerpt_length', 999 );

function logbook_wp_sanitize_select( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function logbook_wp_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}