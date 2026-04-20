<?php
if ( ! defined( 'ABSPATH' ) ) exit;
 
function hotel_26_award_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Award  Section
	=========================================*/
	$wp_customize->add_section(
		'award_setting', array(
			'title' => esc_html__( 'Award Section', 'clever-fox' ),
			'priority' => 15,
			'panel' => 'hotel_26_frontpage_sections',
		)
	);
	
	$wp_customize->add_setting(	'award_hs',
		array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control('award_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Show/Hide','clever-fox'),
			'section' => 'award_setting',
		)
	);
	
	// Award content Section // 	
	$wp_customize->add_setting(
		'award_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'award_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','clever-fox'),
			'section' => 'award_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add award
	 */
	
		$wp_customize->add_setting( 'award_contents', 
			array(
			 'sanitize_callback' => 'hotel_26_repeater_sanitize',
			 //'transport'         => $selective_refresh,
			 'priority' => 8,
			 'default' => hotel26_award_default()
			)
		);
		
		$wp_customize->add_control( 
			new Hotel_26_Repeater( $wp_customize, 
				'award_contents', 
					array(
						'label'   => esc_html__('Award','clever-fox'),
						'section' => 'award_setting',
						'add_field_label'                   => esc_html__( 'Add New Award', 'clever-fox' ),
						'item_name'                         => esc_html__( 'Award', 'clever-fox' ),
						'customizer_repeater_image_control' => true,
					) 
				) 
			);
			
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'award',
		'section'    => 'award_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Upgrade to Pro','clever-fox'),
	) );
	
	// award column // 
	$wp_customize->add_setting(
    	'award_sec_column',
    	array(
	        'default'			=> '6',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control(
		'award_sec_column',
		array(
		    'label'   		=> __('Award Column','clever-fox'),
		    'section' 		=> 'award_setting',
			'settings'   	 => 'award_sec_column',
			'type'			=> 'select',
			'choices'        => 
			array(
				'4' => __( '4 Column', 'clever-fox' ),
				'5' => __( '5 Column', 'clever-fox' ),
				'6' => __( '6 Column', 'clever-fox' ),
				'7' => __( '7 Column', 'clever-fox' ),
				'8' => __( '8 Column', 'clever-fox' ),
			) 
		) 
	);
	
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'award_animation_speed',
			array(
				'default' => '5000',
				'capability'     	=> 'edit_theme_options',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'award_animation_speed', 
			array(
				'label'      => __( 'Slide Speed', 'clever-fox' ),
				'section'  => 'award_setting',
				'input_attrs'    => array(
						'min'           => 2000,
						'max'           => 10000,
						'step'          => 500,
						'default_value' => 5000,
					),
				) 
			) 
		);
	}
	
	
	// Award Autoplay
		$wp_customize->add_setting( 
			'award_autoplay', 
				array(
				'default' => 'true',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'hotel_26_sanitize_select',
				'priority' => 10,
			) 
		);
		$wp_customize->add_control('award_autoplay', array(
		'label' => __('Slide Autoplay', 'clever-fox'),
		'section' => 'award_setting',
		'type'			=> 'select',
		'choices'        => 
				array(
					'true'		=>__('Yes', 'clever-fox'),
					'false'=>__('No', 'clever-fox'),
				) 
		));
		
		// Award Loop
		$wp_customize->add_setting( 
			'award_loop_rewind' , 
				array(
				'default' => 'loop',
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'hotel_26_sanitize_select',
				'priority' => 10,
			) 
		);
		$wp_customize->add_control('award_loop_rewind', array(
		'label' => __('Loop/Rewind', 'clever-fox'),
		'section' => 'award_setting',
		'type'			=> 'select',
		'choices'        => 
			array(
				'loop'		=>__('Loop', 'clever-fox'),
				'rewind'=>__('Rewind', 'clever-fox'),
			) 
	));
	
	//Spacing
	$wp_customize->add_setting(
		'award_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'award_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'award_setting',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'award_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'award_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'award_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'award_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'award_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'award_setting',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'award_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'award_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'award_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'award_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'award_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'award_setting',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'award_locked',
		'section'    => 'award_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Unlock With Pro','clever-fox'),
	) );
}

add_action( 'customize_register', 'hotel_26_award_setting' );

// award selective refresh
function hotel_26_home_award_section_partials( $wp_customize ){	
	// award title
	$wp_customize->selective_refresh->add_partial( 'award_title', array(
		'selector'            => '#award-section .heading-default .sub-title',
		'settings'            => 'award_title',
		'render_callback'  => 'hotel_26_award_title_render_callback',
	
	) );
	
	// award Subtitle
	$wp_customize->selective_refresh->add_partial( 'award_subtitle', array(
		'selector'            => '#award-section .heading-default .title',
		'settings'            => 'award_subtitle',
		'render_callback'  => 'hotel_26_award_subtitle_render_callback',
	));
	// award description
	$wp_customize->selective_refresh->add_partial( 'award_description', array(
		'selector'            => '#award-section .heading-default .desc',
		'settings'            => 'award_description',
		'render_callback'  => 'hotel_26_award_desc_render_callback',	
	) );
	// award description
	$wp_customize->selective_refresh->add_partial( 'award_contents', array(
		'selector'            => '#award-section .award-slider',			
	) );	
}

add_action( 'customize_register', 'hotel_26_home_award_section_partials' );

// award title
function hotel_26_award_title_render_callback() {
	return get_theme_mod( 'award_title' );
}

// award subtitle
function hotel_26_award_subtitle_render_callback() {
	return get_theme_mod( 'award_subtitle' );
}

// award description
function hotel_26_award_desc_render_callback() {
	return get_theme_mod( 'award_description' );
}