<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	function cleverfox_themes_section_upgrade_control( $wp_customize, $args = array() ) {

    $defaults = array(
        'setting_id' => '',
        'section'    => '',
        // 'priority'   => 5,
        'pro_url'    => '#',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( empty( $args['setting_id'] ) || empty( $args['section'] ) ) {
        return;
    }

    // Add setting
    $wp_customize->add_setting( $args['theme_slug'].$args['setting_id'].'_upgrade_to_pro', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        // 'priority'          => $args['priority'],
    ) );

    // Add control
    $wp_customize->add_control(
        new CleverFox_Themes_Upgrade_Control(
            $wp_customize,
            $args['theme_slug'].$args['setting_id'].'_upgrade_to_pro',
            array(
                'section' => $args['section'],
                'pro_url' => $args['pro_url'],
				'custom_text' => $args['custom_text'],
				'setting_id' => $args['setting_id'],
            )
        )
    );
}