<?php
if ( ! defined( 'ABSPATH' ) ) exit;
 
function hotel_26_about_page_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About Page
	=========================================*/
	
	$wp_customize->add_section(
		'about_pg_Settings', array(
			'title' => esc_html__( 'About Section', 'clever-fox' ),
			'priority' => 3,
			'panel' => 'hotel_26_frontpage_sections',
		)
	);
	
	// Settings
	$wp_customize->add_setting(
		'about_pg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'about_pg_head',
		array(
			'type' => 'hidden',
			'label' => __('About Content','clever-fox'),
			'section' => 'about_pg_Settings',
		)
	);
	
	// About Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'hs_pg_about' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'hotel_26_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'hs_pg_about', 
		array(
			'label'	      => esc_html__( 'Hide/Show', 'clever-fox' ),
			'section'     => 'about_pg_Settings',
			'type'        => 'checkbox'
		) 
	);
	
	// About Section Title // 
	$wp_customize->add_setting(
    	'pg_about_title',
    	array(
	        'default'			=> __('Explore','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'pg_about_title',
		array(
		    'label'   => __('Section Title','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	
	// About Section Subtitle // 
	$wp_customize->add_setting(
    	'pg_about_subtitle',
    	array(
	        'default'			=> __('About <span class="color-secondary">Us</span>','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			// 'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'pg_about_subtitle',
		array(
		    'label'   => __('Section Subtitle','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	
	// About Section Description // 
	$wp_customize->add_setting(
    	'pg_about_description',
    	array(
	        'default'			=> __('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			// 'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'pg_about_description',
		array(
		    'label'   => __('Section Description','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'textarea',
		)  
	);
	

	//  Image // 
    $wp_customize->add_setting( 
    	'pg_about_first_img' , 
    	array(
			'default' 			=> esc_url(CLEVERFOX_PLUGIN_URL .'inc/hotel-26/images/about/about-1.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_url',	
			'priority' => 3,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'pg_about_first_img' ,
		array(
			'label'          => esc_html__( 'Left Image', 'clever-fox'),
			'section'        => 'about_pg_Settings',
		) 
	));
	
	//  Image // 
    $wp_customize->add_setting( 
    	'pg_about_second_img' , 
    	array(
			'default' 			=> esc_url(CLEVERFOX_PLUGIN_URL .'inc/hotel-26/images/about/about-2.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_url',	
			'priority' => 3,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'pg_about_second_img' ,
		array(
			'label'          => esc_html__( 'Right Image', 'clever-fox'),
			'section'        => 'about_pg_Settings',
		) 
	));
	
	// Play Link // 
	$wp_customize->add_setting(
    	'about_video_link',
    	array(
			'default'			=> 'https://www.youtube.com/watch?v=1iIZeIy7TqM',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'about_video_link',
		array(
		    'label'   		=> __('Video Link','clever-fox'),
		    'section' 		=> 'about_pg_Settings',
			'type'		 =>	'text'
		)  
	);
	
	// About Title // 
	$wp_customize->add_setting(
    	'about_title',
    	array(
	        'default'			=> __('"Welcome to The Elegance of <span class="color-secondary">Nayra Hotel</span> & Resort"','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			// 'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'about_title',
		array(
		    'label'   => __('Title','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	
	// About Subtitle // 
	$wp_customize->add_setting(
    	'about_description',
    	array(
	        'default'			=> __('At our hotel luxury is more that just a word it a tradition From exquisite Design to personalized service. every detail is thoughtfully curated to create unforgetable experiences. whether youre here for relaxation or celebration.','clever-fox'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			// 'transport'         => $selective_refresh,
			'priority' => 5,
		)
	);	
	
	$wp_customize->add_control( 
		'about_description',
		array(
		    'label'   => __('Description','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'textarea',
		)  
	);
	
	$page_editor_path = trailingslashit( get_template_directory() ) . 'inc/custom-controls/editor/customizer-page-editor.php';
		if ( file_exists( $page_editor_path ) ) {
			require_once( $page_editor_path );
		}
	if ( class_exists( 'Hotel_26_Page_Editor' ) ) {
		$frontpage_id = get_option( 'page_on_front' );
		$default = '';
		if ( ! empty( $frontpage_id ) ) {
			$default = get_post_field( 'post_content', $frontpage_id );
		}
		$wp_customize->add_setting(
			'pg_about_content', array(
				'default' => '<div class="row about-services-boxes"><div class="col-6"><div class="service-box st-tilt"><div class="service-icon"><i class="fa fa-bed" aria-hidden="true"></i></div><h6>Airport Shuttle Service</h6></div></div><div class="col-6"><div class="service-box st-tilt"><div class="service-icon"><i class="fa fa-bed" aria-hidden="true"></i></div><h6>Luxury Spa & Wellness</h6></div></div></div><ul class="about-features-list mb-3 mb-sm-4"><li><i class="fa fa-check-circle"></i> Modern & Comfortable Rooms</li><li><i class="fa fa-check-circle"></i> Business Lounge & Meeting Rooms</li><li><i class="fa fa-check-circle"></i> Laundry & Dry Cleaning Services</li></ul>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 6,
				
			)
		);

		$wp_customize->add_control(
			new Hotel_26_Page_Editor(
				$wp_customize, 'pg_about_content', array(
					'label' => esc_html__( 'Content', 'clever-fox' ),
					'section' => 'about_pg_Settings',
					'needsync' => true,
				)
			)
		);
	}
	
	// About BUtton // 
	$wp_customize->add_setting(
    	'about_btn_lbl',
    	array(
			'default'			=> __('Learn More','clever-fox'),
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'about_btn_lbl',
		array(
		    'label'   		=> __('Button Label','clever-fox'),
		    'section' 		=> 'about_pg_Settings',
			'type'		 =>	'text'
		)  
	);	
	
	$wp_customize->add_setting(
    	'about_btn_link',
    	array(
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'about_btn_link',
		array(
		    'label'   		=> __('Button Link','clever-fox'),
		    'section' 		=> 'about_pg_Settings',
			'type'		 =>	'text'
		)  
	);
	$wp_customize->add_setting(
    	'about_btn_newtab',
    	array(
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'about_btn_newtab',
		array(
		    'label'   		=> __('Open In New Tab','clever-fox'),
		    'section' 		=> 'about_pg_Settings',
			'type'		 =>	'checkbox'
		)  
	);
	$wp_customize->add_setting(
    	'about_btn_nofollow',
    	array(
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'about_btn_nofollow',
		array(
		    'label'   		=> __('Add "nofollow" To Link','clever-fox'),
		    'section' 		=> 'about_pg_Settings',
			'type'		 =>	'checkbox'
		)  
	);	
	
	//Spacing
	$wp_customize->add_setting(
		'about_spacing_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'about_spacing_head',
		array(
			'type' => 'hidden',
			'label' => __('Section Spacing','clever-fox'),
			'section' => 'about_pg_Settings',
		)
	);
	
	// Padding // 
	$wp_customize->add_setting(
    	'about_padding_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'about_padding_top',
		array(
		    'label'   => __('Padding Top','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'about_padding_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'about_padding_bottom',
		array(
		    'label'   => __('Padding Bottom','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	
	// Margin // 
	$wp_customize->add_setting(
    	'about_margin_top',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'about_margin_top',
		array(
		    'label'   => __('Margin Top','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	$wp_customize->add_setting(
    	'about_margin_bottom',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'hotel_26_sanitize_html',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'about_margin_bottom',
		array(
		    'label'   => __('Margin Bottom','clever-fox'),
		    'section' => 'about_pg_Settings',
			'type'           => 'text',
		)  
	);
	
	//Pro feature
	cleverfox_themes_section_upgrade_control( $wp_customize, array(
		'theme_slug' => 'hotel_26_',
		'setting_id' => 'about_locked',
		'section'    => 'about_pg_Settings',
		'pro_url'    => hotel_26_premium_links(),
		'custom_text'    => __('Unlock With Pro','clever-fox'),
	) );
}

add_action( 'customize_register', 'hotel_26_about_page_setting' );

// selective refresh
function hotel_26_about_page_partials( $wp_customize ){
	
	 // pg_about_title
	$wp_customize->selective_refresh->add_partial( 'pg_about_title', array(
		'selector'            => '#about-section .sub-title',
		'settings'            => 'pg_about_title',
		'render_callback'  => 'hotel_26_pg_about_title_render_callback',	
	) );
	
	 // pg_about_subtitle
	$wp_customize->selective_refresh->add_partial( 'pg_about_subtitle', array(
		'selector'            => '#about-section .title',
		'settings'            => 'pg_about_subtitle',
		'render_callback'  => 'hotel_26_pg_about_subtitle_render_callback',	
	) );
	
	 // pg_about_description
	$wp_customize->selective_refresh->add_partial( 'pg_about_description', array(
		'selector'            => '#about-section .desc',
		'settings'            => 'pg_about_description',
		'render_callback'  => 'hotel_26_pg_about_description_render_callback',
	) );
	
	 // pg_about_image1
	$wp_customize->selective_refresh->add_partial( 'pg_about_first_img', array(
		'selector'            => '#about-section .about-image1',
		'settings'            => 'pg_about_first_img',
		'render_callback'  => 'hotel_26_pg_about_first_img_render_callback',
	) );
	
	 // pg_about_second_img
	$wp_customize->selective_refresh->add_partial( 'pg_about_second_img', array(
		'selector'            => '#about-section .about-image2',
		'settings'            => 'pg_about_second_img',
		'render_callback'  => 'hotel_26_pg_about_second_img_render_callback',
	) );
	
	 // about_video_link
	$wp_customize->selective_refresh->add_partial( 'about_video_link', array(
		'selector'            => '#about-section .about-video-badge a',
		'settings'            => 'about_video_link',
		'render_callback'  => 'hotel_26_pg_about_second_img_render_callback',
	) );
			
	 // about_title
	$wp_customize->selective_refresh->add_partial( 'about_title', array(
		'selector'            => '#about-section .about-content .about-title',
		'settings'            => 'about_title',
		'render_callback'  => 'hotel_26_about_title_render_callback',	
	) );
	
	 // about_description
	$wp_customize->selective_refresh->add_partial( 'about_description', array(
		'selector'            => '#about-section .about-content .about-description',
		'settings'            => 'about_description',
		'render_callback'  => 'hotel_26_about_desc_render_callback',
	) );
	
	 // about_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'about_btn_lbl', array(
		'selector'            => '#about-section .about-content a',
		'settings'            => 'about_btn_lbl',
		'render_callback'  => 'hotel_26_about_btn_lbl_render_callback',
	) );	
}
add_action( 'customize_register', 'hotel_26_about_page_partials' );

// pg_about_title
function hotel_26_pg_about_title_render_callback() {
	return get_theme_mod( 'pg_about_title' );
}

// pg_about_subtitle
function hotel_26_pg_about_subttl_render_callback() {
	return get_theme_mod( 'pg_about_subtitle' );
}

// pg_about_description
function hotel_26_pg_about_description_render_callback() {
	return get_theme_mod( 'pg_about_description' );
}

// pg_about_description
function hotel_26_pg_about_first_img_render_callback() {
	return get_theme_mod( 'pg_about_first_img' );
}

// pg_about_description
function hotel_26_pg_about_second_img_render_callback() {
	return get_theme_mod( 'pg_about_second_img' );
}

// pg_about_description
function hotel_26_about_video_link_render_callback() {
	return get_theme_mod( 'about_video_link' );
}

// about_title
function hotel_26_about_title_render_callback() {
	return get_theme_mod( 'about_title' );
}

// about_description
function hotel_26_about_desc_render_callback() {
	return get_theme_mod( 'about_description' );
}

// about_btn_lbl
function hotel_26_about_btn_lbl_render_callback() {
	return get_theme_mod( 'about_btn_lbl' );
}