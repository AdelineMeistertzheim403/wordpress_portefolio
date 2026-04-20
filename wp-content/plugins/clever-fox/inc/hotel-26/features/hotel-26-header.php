<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function hotel_26_lite_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_section', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header', 'clever-fox'),
		) 
	);
	
	/*=========================================
	Fiona Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','clever-fox'),
			'panel'  		=> 'header_section',
		)
    );

	// Logo Width // 
	if ( class_exists( 'Cleverfox_Customizer_Range_Slider_Control' ) ) {
		$wp_customize->add_setting(
			'logo_width',
			array(
				'default'			=> '250',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'hotel_26_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new Cleverfox_Customizer_Range_Slider_Control( $wp_customize, 'logo_width', 
			array(
				'label'      => __( 'Logo Width', 'clever-fox' ),
				'section'  => 'title_tagline',
				'input_attrs' => array(
				'min'    => 0,
				'max'    => 500,
				'step'   => 1,
				//'suffix' => 'px', //optional suffix
			),
			) ) 
		);
	}
/*=========================================
	Above Header Section
	=========================================*/
	$wp_customize->add_section(
        'above_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Above Header','clever-fox'),
			'panel'  		=> 'header_section',
		)
    );
	
	
	/*=========================================
	Email
	=========================================*/
	$wp_customize->add_setting( 
		'hide_show_hdr_cnct_left' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_hdr_cnct_left', 
		array(
			'label'	      => esc_html__( 'Hide/Show Contact', 'clever-fox' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);
		
	/*=========================================
	Mobile
	=========================================*/
	$wp_customize->add_setting(
		'hdr_top_mbl'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'hdr_top_mbl',
		array(
			'type' => 'hidden',
			'label' => __('Phone','clever-fox'),
			'section' => 'above_header',
			
		)
	);
	
		
	// icon // 
	$wp_customize->add_setting(
    	'hdr_phone_icon',
    	array(
	        'default' => 'fa-phone',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Hotel_26_Icon_Picker_Control($wp_customize, 
		'hdr_phone_icon',
		array(
		    'label'   		=> __('Icon','clever-fox'),
		    'section' 		=> 'above_header',
			'iconset' => 'fa',
			
		))  
	);	
	// Email title // 
	$wp_customize->add_setting(
    	'hdr_phone_lbl',
    	array(
	        'default'			=> __('1-800-458-56987','clever-fox'),
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 13,
		)
	);	

	$wp_customize->add_control( 
		'hdr_phone_lbl',
		array(
		    'label'   		=> __('Title','clever-fox'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	// Email Link // 
	$wp_customize->add_setting(
    	'hdr_phone_link',
    	array(
			'default'			=> __('1-800-458-56987','clever-fox'),
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 14,
		)
	);	

	$wp_customize->add_control( 
		'hdr_phone_link',
		array(
		    'label'   		=> __('Link','clever-fox'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	
	
	/*=========================================
	Mobile
	=========================================*/
	$wp_customize->add_setting(
		'hdr_top_loc'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'hdr_top_loc',
		array(
			'type' => 'hidden',
			'label' => __('Location','clever-fox'),
			'section' => 'above_header',
			
		)
	);
	// icon // 
	$wp_customize->add_setting(
    	'hdr_loc_icon',
    	array(
	        'default' => 'fa-map-marker-alt',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control(new Hotel_26_Icon_Picker_Control($wp_customize, 
		'hdr_loc_icon',
		array(
		    'label'   		=> __('Icon','clever-fox'),
		    'section' 		=> 'above_header',
			'iconset' => 'fa',
			
		))  
	);
	
	// Mobile title // 
	$wp_customize->add_setting(
    	'hdr_loc_lbl',
    	array(
	        'default'			=> __('123 Bakery Street, London, UK','clever-fox'),
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 18,
		)
	);	

	$wp_customize->add_control( 
		'hdr_loc_lbl',
		array(
		    'label'   		=> __('Title','clever-fox'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'hdr_loc_link',
    	array(
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
			'priority' => 19,
		)
	);	

	$wp_customize->add_control( 
		'hdr_loc_link',
		array(			
		    'label'   		=> __('Link','clever-fox'),
		    'section' 		=> 'above_header',
			'type'		 =>	'text'
		)  
	);
	
	//* Account *//
	$wp_customize->add_setting(
		'hdr_top_account'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'hdr_top_account',
		array(
			'type' => 'hidden',
			'label' => __('Account','clever-fox'),
			'section' => 'above_header',
			
		)
	);
		
	$wp_customize->add_setting( 
		'hide_show_account_right' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'hide_show_account_right', 
		array(
			'label'	      => esc_html__( 'Hide/Show Account', 'clever-fox' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);
	
	$wp_customize->add_setting( 
		'hdr_account_ttl_hs' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'hdr_account_ttl_hs', 
		array(
			'label'	      => esc_html__( 'Account Title', 'clever-fox' ),
			'section'     => 'above_header',
			'type'        => 'checkbox'
		) 
	);
	
	
}
add_action( 'customize_register', 'hotel_26_lite_header_settings' );