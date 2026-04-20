<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hotel_26_slider_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	
	$wp_customize->add_section(
		'slider_setting', array(
			'title' => esc_html__( 'Slider Section', 'clever-fox' ),
			'panel' => 'hotel_26_frontpage_sections',
			'priority' => 1,
		)
	);
	
	$wp_customize->add_setting(	'slider_hs',
		array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control('slider_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Show/Hide','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	// slider Contents
	$wp_customize->add_setting(
		'slider_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Contents','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add slides
	 */
	
		$wp_customize->add_setting( 'slider', 
			array(
			 'sanitize_callback' => 'hotel_26_repeater_sanitize',
			 'priority' => 5,
			  'default' => hotel_26_get_slider_default()
			)
		);
		
		$wp_customize->add_control( 
			new Hotel_26_Repeater( $wp_customize, 
				'slider', 
					array(
						'label'   => esc_html__('Slide','clever-fox'),
						'section' => 'slider_setting',
						'add_field_label'                   => esc_html__( 'Add New Slide', 'clever-fox' ),
						'item_name'                         => esc_html__( 'Slide', 'clever-fox' ),						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_description_control' => true,
						'customizer_repeater_text_control' => true,				
						'customizer_repeater_button_text_control' => true,
						'customizer_repeater_button_link_control' => true,
						'customizer_repeater_image_control' => true,
						'customizer_repeater_newtab_control' => true,
						'customizer_repeater_nofollow_control' => true,
					) 
				) 
			);
	
		//Pro feature
		cleverfox_themes_section_upgrade_control( $wp_customize, array(
			'theme_slug' => 'hotel_26_',
			'setting_id' => 'slider',
			'section'    => 'slider_setting',
			'pro_url'    => hotel_26_premium_links(),
			'custom_text'    => __('Upgrade to Pro','clever-fox'),
		) );
	
	//Overlay Enable //
	$wp_customize->add_setting( 
		'slider_overlay_enable' , 
			array(
			'default' => '1',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 6,
		) 
	);
	
	$wp_customize->add_control(
	'slider_overlay_enable', 
		array(
			'label'	      => esc_html__( 'Overlay Enable?', 'clever-fox' ),
			'section'     => 'slider_setting',
			'type'        => 'checkbox'
		) 
	);	
	
	
	// slider opacity
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'slider_opacity',
			array(
				'default'	      => '0.6',
				'capability'     	=> 'edit_theme_options',
				// 'sanitize_callback' => 'hotel_26_sanitize_range_value',
				'priority' => 7,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'slider_opacity', 
			array(
				'label'      => __( 'opacity', 'clever-fox' ),
				'section'  => 'slider_setting',
				'input_attrs'    => array(
						'min'           => 0,
						'max'           => 0.95,
						'step'          => 0.05,
						'default_value' => 0.6,					
				),
			) ) 
		);
	}
	
	 // Overlay Color
	$wp_customize->add_setting(
	'slide_overlay_color', 
	array(
		'default'	      => '#000000',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slide_overlay_color', 
			array(
				'label'      => __( 'Overlay Color', 'clever-fox' ),
				'section'    => 'slider_setting'
			) 
		) 
	);
		
	
	// Title Color
	$wp_customize->add_setting(
	'slider_ttl_clr', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#ffffff'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slider_ttl_clr', 
			array(
				'label'      => __( 'Title Color', 'clever-fox' ),
				'section'    => 'slider_setting',
			) 
		) 
	);
	
	// Subtitle Color
	$wp_customize->add_setting(
	'slider_subttl_clr', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#ffffff'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slider_subttl_clr', 
			array(
				'label'      => __( 'Subtitle Color', 'clever-fox' ),
				'section'    => 'slider_setting',
			) 
		) 
	);
	
	// Description Color
	$wp_customize->add_setting(
	'slider_desc_clr', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#ffffff'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'slider_desc_clr', 
			array(
				'label'      => __( 'Description Color', 'clever-fox' ),
				'section'    => 'slider_setting',
			) 
		) 
	);
	
		
	// slider opacity
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'slider_animation_speed',
			array(
				'default' => '9000',
				'capability'     	=> 'edit_theme_options',
				// 'sanitize_callback' => 'hotel_26_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'slider_animation_speed', 
			array(
				'label'      => __( 'Slider Speed', 'clever-fox' ),
				'section'  => 'slider_setting',			 
				'input_attrs'    => array(
						'min'           => 500,
						'max'           => 10000,
						'step'          => 500,
						'default_value' => 9000,
					),
				),
			) 
		);
	}
	
	
	// Slider Autoplay
	$wp_customize->add_setting( 
		'slider_autoplay', 
			array(
			'default' => 'true',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('slider_autoplay', array(
    'label' => __('Slider Autoplay', 'clever-fox'),
    'section' => 'slider_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'true'		=>__('Yes', 'clever-fox'),
				'false'=>__('No', 'clever-fox'),
			) 
	));
	
	// Slider Loop
	$wp_customize->add_setting( 
		'slider_loop_rewind' , 
			array(
			'default' => 'loop',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('slider_loop_rewind', array(
    'label' => __('Loop', 'clever-fox'),
    'section' => 'slider_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'loop'		=>__('True', 'clever-fox'),
				'no'=>__('False', 'clever-fox'),
			) 
	));	
	
	//Spacing
	$wp_customize->add_setting(
		'slider_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'slider_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'slider_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'slider_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'slider_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'slider_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'slider_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'slider_setting',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
		cleverfox_themes_section_upgrade_control( $wp_customize, array(
			'theme_slug' => 'hotel_26_',
			'setting_id' => 'slider_locked',
			'section'    => 'slider_setting',
			'pro_url'    => hotel_26_premium_links(),
			'custom_text'    => __('Unlock with Pro','clever-fox'),
		) );
}

add_action( 'customize_register', 'hotel_26_slider_setting' );


function hotel_26_slider_partials( $wp_customize ){	
	// Slider controls
	$wp_customize->selective_refresh->add_partial(
		'slider', array(
			'selector' => '#slider-section .theme-content',
			'container_inclusive' => true,
			'render_callback' => 'hotel_26_slider_callback',
			'fallback_refresh' => true,
		)
	);
}

add_action( 'customize_register', 'hotel_26_slider_partials' );

function hotel_26_slider_callback() {
	return get_theme_mod( 'slider' );
}