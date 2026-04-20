<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function hotel_26_booking_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Booking  Section
	=========================================*/	
	$wp_customize->add_section(
        'booking_setting',
        array(
            'title' 		=> __('Room Booking','clever-fox'),
			'priority' => 2,
			'panel'  		=> 'hotel_26_frontpage_sections',
		)
    );
	
	$wp_customize->add_setting(	'booking_hs',
		array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control('booking_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Show/Hide','clever-fox'),
			'section' => 'booking_setting',
		)
	);
	
	// Shortcode // 
	$wp_customize->add_setting(
    	'hotel_form_shortcode',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',			
			'priority' => 6,
		)
	);	
	if(class_exists('WP_Hotel_Booking')):
	$wp_customize->add_control( 
		'hotel_form_shortcode',
		array(
		    'label'   => __('Shortcode','clever-fox'),
		    'section' => 'booking_setting',
			'input_attrs'		=> array(
				'placeholder'		=> '[hotel_booking]'
				),
			'type'           => 'text',
		)  
	);
	else:
	$wp_customize->add_control( 
		'hotel_form_shortcode',
		array(
		    'label'   => __('Shortcode','clever-fox'),
		    'section' => 'booking_setting',
			'input_attrs'		=> array(
				'placeholder'		=> 'First Activate "WP HOTEL PLUGIN"',
				'readonly'	=> 'readonly'
				),
			'type'           => 'text',
		)  
	);
	endif;
	
	//Spacing
	$wp_customize->add_setting(
		'booking_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'booking_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'booking_setting',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'booking_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'booking_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'booking_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'booking_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'booking_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'booking_setting',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'booking_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'booking_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'booking_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'booking_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'booking_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'booking_setting',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'booking_locked',
		'section'    => 'booking_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Unlock With Pro','clever-fox'),
	) );
}

add_action( 'customize_register', 'hotel_26_booking_setting' );

// booking selective refresh
function hotel_26_home_booking_section_partials( $wp_customize ){	
	// booking title
	$wp_customize->selective_refresh->add_partial( 'hotel_form_shortcode', array(
		'selector'            => '#booking-section form',
		'settings'            => 'hotel_form_shortcode',
		'render_callback'  => 'hotel_26_form_shortcode_render_callback',	
	) );	
}

add_action( 'customize_register', 'hotel_26_home_booking_section_partials' );

// booking title
function hotel_26_form_shortcode_render_callback() {
	return get_theme_mod( 'hotel_form_shortcode' );
}