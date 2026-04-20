<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hotel_26_team_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Team  Section
	=========================================*/
	$wp_customize->add_section(
		'team_setting', array(
			'title' => esc_html__( 'Team Section', 'clever-fox' ),
			'priority' => 8,
			'panel' => 'hotel_26_frontpage_sections',
		)
	);

	$wp_customize->add_setting(	'team_hs',
		array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control('team_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Show/Hide','clever-fox'),
			'section' => 'team_setting',
		)
	);
	
	// Team Header Section // 
	$wp_customize->add_setting(
		'team_headings'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'team_headings',
		array(
			'type' => 'hidden',
			'label' => __('Header','clever-fox'),
			'section' => 'team_setting',
		)
	);
	
	$wp_customize->add_setting(
    	'team_header_hs',
    	array(
			'default'	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'team_header_hs',
		array(
		    'label'   => __('Show/Hide','clever-fox'),
		    'section' => 'team_setting',
			'type' => 'checkbox',
		)  
	);
	
	// Team Title // 
	$wp_customize->add_setting(
    	'team_title',
    	array(
	        'default'			=> 'Explore',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_title',
		array(
		    'label'   => __('Title','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
	);
	
	// Team Title // 
	$wp_customize->add_setting(
    	'team_subtitle',
    	array(
	        'default'			=> 'Our <span class="color-secondary">Team</span>',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_subtitle',
		array(
		    'label'   => __('Subtitle','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
		);
	
	// Team Description // 
	$wp_customize->add_setting(
    	'team_description',
    	array(
	        'default'			=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'team_description',
		array(
		    'label'   => __('Description','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'textarea',
		)  
	);

	// Team content Section // 
	
	$wp_customize->add_setting(
		'team_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'team_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Content','clever-fox'),
			'section' => 'team_setting',
		)
	);
	
	/**
	 * Customizer Repeater for add team
	 */
	
		$wp_customize->add_setting( 'team_contents', 
			array(
			 'sanitize_callback' => 'hotel_26_repeater_sanitize',
			 'priority' => 8,
			 'default' => hotel26_team_default()
			)
		);
		
		$wp_customize->add_control( 
			new Hotel_26_Repeater( $wp_customize, 
				'team_contents', 
					array(
						'label'   => esc_html__('Team','clever-fox'),
						'section' => 'team_setting',
						'add_field_label'                   => esc_html__( 'Add New Team', 'clever-fox' ),
						'item_name'                         => esc_html__( 'Team', 'clever-fox' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_repeater_control' => true,
					) 
				) 
			);
			
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'team',
		'section'    => 'team_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Upgrade to Pro','clever-fox'),
	) );
		
	// team column // 
	$wp_customize->add_setting(
    	'team_sec_column',
    	array(
	        'default'			=> '4',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 9,
		)
	);	

	$wp_customize->add_control(
		'team_sec_column',
		array(
		    'label'   		=> __('Team Column','clever-fox'),
		    'section' 		=> 'team_setting',
			'settings'   	 => 'team_sec_column',
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
			'team_animation_speed',
			array(
				'default' => '5000',
				'capability'     	=> 'edit_theme_options',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'team_animation_speed', 
			array(
				'label'      => __( 'Slide Speed', 'clever-fox' ),
				'section'  => 'team_setting',
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
	
	
	// Team Autoplay
	$wp_customize->add_setting( 
		'team_autoplay', 
			array(
			'default' => 'true',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('team_autoplay', array(
    'label' => __('Slide Autoplay', 'clever-fox'),
    'section' => 'team_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'true'		=>__('Yes', 'clever-fox'),
				'false'=>__('No', 'clever-fox'),
			) 
	));
	
	// Team Loop
	$wp_customize->add_setting( 
		'team_loop_rewind' , 
			array(
			'default' => 'loop',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_select',
			'priority' => 10,
		) 
	);
	$wp_customize->add_control('team_loop_rewind', array(
    'label' => __('Loop/Rewind', 'clever-fox'),
    'section' => 'team_setting',
	'type'			=> 'select',
	'choices'        => 
			array(
				'loop'		=>__('Loop', 'clever-fox'),
				'rewind'=>__('Rewind', 'clever-fox'),
			) 
	));
		
	//Spacing
	$wp_customize->add_setting(
		'team_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'team_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'team_setting',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'team_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'team_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'team_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'team_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'team_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'team_setting',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'team_locked',
		'section'    => 'team_setting',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Unlock With Pro','clever-fox'),
	) );
}

add_action( 'customize_register', 'hotel_26_team_setting' );

// team selective refresh
function hotel_26_home_team_section_partials( $wp_customize ){	
	// team title
	$wp_customize->selective_refresh->add_partial( 'team_title', array(
		'selector'            => '#team-section .heading-default .sub-title',
		'settings'            => 'team_title',
		'render_callback'  => 'hotel_26_team_title_render_callback',	
	) );
	
	// team Subtitle
	$wp_customize->selective_refresh->add_partial( 'team_subtitle', array(
		'selector'            => '#team-section .heading-default .title',
		'settings'            => 'team_subtitle',
		'render_callback'  => 'hotel_26_team_subtitle_render_callback',
	));
	// team description
	$wp_customize->selective_refresh->add_partial( 'team_description', array(
		'selector'            => '#team-section .heading-default .desc',
		'settings'            => 'team_description',
		'render_callback'  => 'hotel_26_team_desc_render_callback',	
	) );
	// team content
	$wp_customize->selective_refresh->add_partial( 'team_contents', array(
		'selector'            => '#team-section .team-slider'	
	) );
	// team bg
	$wp_customize->selective_refresh->add_partial( 'team_bg_img', array(
		'selector'            => '#team-section'	
	) );	
}

add_action( 'customize_register', 'hotel_26_home_team_section_partials' );

// team title
function hotel_26_team_title_render_callback() {
	return get_theme_mod( 'team_title' );
}

// team subtitle
function hotel_26_team_subtitle_render_callback() {
	return get_theme_mod( 'team_subtitle' );
}

// team description
function hotel_26_team_desc_render_callback() {
	return get_theme_mod( 'team_description' );
}
