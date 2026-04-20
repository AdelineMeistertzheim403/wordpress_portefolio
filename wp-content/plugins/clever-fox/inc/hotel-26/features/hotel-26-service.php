<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hotel_26_service_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Service  Section
	=========================================*/
	$wp_customize->add_section(
		'service_setting', array(
			'title' => esc_html__( 'Service Section', 'clever-fox' ),
			'priority' => 4,
			'panel' => 'hotel_26_frontpage_sections',
		)
	);

	$wp_customize->add_setting(	'service_hs',
		array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control('service_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Show/Hide','clever-fox'),
			'section' => 'service_setting',
		)
	);
	
	// Service Header Section // 
	$wp_customize->add_setting(
		'service_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'service_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','clever-fox'),
			'section' => 'service_setting',
		)
	);
	
	$wp_customize->add_setting(
    	'service_header_hs',
    	array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'service_header_hs',
		array(
		    'label'   => __('Show/Hide','clever-fox'),
		    'section' => 'service_setting',
			'type' => 'checkbox',
		)  
	);
	
	// Service Title // 
	$wp_customize->add_setting(
    	'service_title',
    	array(
	        'default'			=> 'Facilities',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_title',
		array(
		    'label'   => __('Title','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	
	// Service Title // 
	$wp_customize->add_setting(
    	'service_subtitle',
    	array(
	        'default'			=> 'Hotel <span class="color-secondary">Services</span>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_subtitle',
		array(
		    'label'   => __('Subtitle','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	
	// Service Description // 
	$wp_customize->add_setting(
    	'service_description',
    	array(
	        'default'			=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'service_description',
		array(
		    'label'   => __('Description','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'textarea',
		)  
	);

	// Service content Section // 
	
	$wp_customize->add_setting(
		'service_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'service_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','clever-fox'),
			'section' => 'service_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add service
	 */
	
		$wp_customize->add_setting( 'service_contents', 
			array(
			 'sanitize_callback' => 'hotel_26_repeater_sanitize',
			 //'transport'         => $selective_refresh,
			 'priority' => 8,
			 'default' => hotel26_get_service_default()
			)
		);
		
		$wp_customize->add_control( 
			new Hotel_26_Repeater( $wp_customize, 
				'service_contents', 
					array(
						'label'   => esc_html__('Service','clever-fox'),
						'section' => 'service_setting',
						'add_field_label'                   => esc_html__( 'Add New Service', 'clever-fox' ),
						'item_name'                         => esc_html__( 'Service', 'clever-fox' ),
						'customizer_repeater_image2_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_description_control' => true,
						'customizer_repeater_button_text_control' => true,
						'customizer_repeater_button_link_control' => true,
						'customizer_repeater_newtab_control' => true,
						'customizer_repeater_nofollow_control' => true,
					) 
				) 
			);
	
		//Pro feature
		cleverfox_themes_section_upgrade_control( $wp_customize, array(
			'theme_slug' => 'hotel_26_',
			'setting_id' => 'service',
			'section'    => 'service_setting',
			'pro_url'    => hotel_26_premium_links(),
			'custom_text'    => __('Upgrade to Pro','clever-fox'),
		) );
		
	//  Image // 
    $wp_customize->add_setting( 
    	'service_bg_img' , 
    	array(
			'default' 			=> esc_url(CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_url',
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'service_bg_img' ,
		array(
			'label'          => esc_html__(  'Background Image', 'clever-fox'),
			'section'        => 'service_setting',
		) 
	));
	
	$wp_customize->add_setting(
		'service_background_attachment',
		array(
			'default'			=> 'fixed',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
		)
	);	

	$wp_customize->add_control(
		'service_background_attachment',
		array(
			'label'   		=> __('Background Attachment','clever-fox'),
			'section' 		=> 'service_setting',
			'settings'   	 => 'service_background_attachment',
			'type'			=> 'radio',
			'choices'        => 
			array(
				'scroll' => __( 'Scroll', 'clever-fox' ),
				'fixed' => __( 'Fixed', 'clever-fox' ),
				
			) 
		) 
	);
	
	// service column // 
	$wp_customize->add_setting(
    	'service_sec_column',
    	array(
	        'default'			=> '4',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control(
		'service_sec_column',
		array(
		    'label'   		=> __('Service Column','clever-fox'),
		    'section' 		=> 'service_setting',
			'settings'   	 => 'service_sec_column',
			'type'			=> 'select',
			'choices'        => 
			array(
				'3' => __( '3 Column', 'clever-fox' ),
				'4' => __( '4 Column', 'clever-fox' ),
				'5' => __( '5 Column', 'clever-fox' ),
			) 
		) 
	);
	
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'service_animation_speed',
			array(
				'default' => '5000',
				'capability'     	=> 'edit_theme_options',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'service_animation_speed', 
			array(
				'label'      => __( 'Slide Speed', 'clever-fox' ),
				'section'  => 'service_setting',
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
	
	
	// Service Autoplay
	$wp_customize->add_setting( 
		'service_autoplay', 
			array(
			'default' => 'true',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('service_autoplay', array(
    'label' => __('Slide Autoplay', 'clever-fox'),
    'section' => 'service_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'true'		=>__('Yes', 'clever-fox'),
				'false'=>__('No', 'clever-fox'),
			) 
	));
	
	// Service Loop
	$wp_customize->add_setting( 
		'service_loop_rewind' , 
			array(
			'default' => 'loop',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('service_loop_rewind', array(
    'label' => __('Loop/Rewind', 'clever-fox'),
    'section' => 'service_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'loop'		=>__('Loop', 'clever-fox'),
				'rewind'=>__('Rewind', 'clever-fox'),
			) 
	));
	
	//Spacing
	$wp_customize->add_setting(
		'service_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'service_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'service_setting',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'service_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'service_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'service_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'service_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'service_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'service_setting',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'service_locked',
		'section'    => 'service_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Unlock With Pro','clever-fox'),
	) );
}

add_action( 'customize_register', 'hotel_26_service_setting' );

// service selective refresh
function hotel_26_home_service_section_partials( $wp_customize ){	
	// service title
	$wp_customize->selective_refresh->add_partial( 'service_title', array(
		'selector'            => '#service-section .heading-default .sub-title',
		'settings'            => 'service_title',
		'render_callback'  => 'hotel_26_service_title_render_callback',
	
	) );
	
	// service Subtitle
	$wp_customize->selective_refresh->add_partial( 'service_subtitle', array(
		'selector'            => '#service-section .heading-default .title',
		'settings'            => 'service_subtitle',
		'render_callback'  => 'hotel_26_service_subtitle_render_callback',
	));
	// service description
	$wp_customize->selective_refresh->add_partial( 'service_description', array(
		'selector'            => '#service-section .heading-default .desc',
		'settings'            => 'service_description',
		'render_callback'  => 'hotel_26_service_desc_render_callback',	
	) );
	// service content
	$wp_customize->selective_refresh->add_partial( 'service_contents', array(
		'selector'            => '#service-section .service-service'	
	) );
	// service bg
	$wp_customize->selective_refresh->add_partial( 'service_bg_img', array(
		'selector'            => '#service-section'	
	) );	
}

add_action( 'customize_register', 'hotel_26_home_service_section_partials' );

// service title
function hotel_26_service_title_render_callback() {
	return get_theme_mod( 'service_title' );
}

// service subtitle
function hotel_26_service_subtitle_render_callback() {
	return get_theme_mod( 'service_subtitle' );
}

// service description
function hotel_26_service_desc_render_callback() {
	return get_theme_mod( 'service_description' );
}
