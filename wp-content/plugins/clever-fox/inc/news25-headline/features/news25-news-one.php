<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function news25_headline_one_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	
	$wp_customize->add_setting(
		'slider_content_middle'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'news25_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'slider_content_middle',
		array(
			'type' => 'hidden',
			'label' => __('Left Column','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	//Video Upload
	$wp_customize->add_setting(
		'slider_video_url'
			,array(
			'default'     	=> 'https://www.youtube.com/watch?v=bTqVqk7FSmY',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'news25_sanitize_html',
		)
	);
	
	$wp_customize->add_control(
	'slider_video_url',
		array(
			'type' => 'textarea',
			'label' => __('Video Url','clever-fox'),
			'section' => 'slider_setting',
		)
	);
		
	$wp_customize->add_setting( 
		'news25_middle_top_news_title' , 
			array(
			'default' => __('Top 10 News','clever-fox'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'news25_sanitize_text',
		) 
	);

	$wp_customize->add_control(
	'news25_middle_top_news_title', 
		array(
			'label'	      => esc_html__( 'Title', 'clever-fox' ),
			'section'     => 'slider_setting',
		) 
	);

	$wp_customize->add_setting(
    'news25_middle_top_news_cats',
		array(
		'default'	=>	['2','4'],
		'capability' => 'edit_theme_options',	
		'sanitize_callback' => 'sanitize_categories',
		)
	);	
	$wp_customize->add_control( new News25_Category_Dropdown_Custom_Control( $wp_customize, 
	'news25_middle_top_news_cats', 
		array(
		'label'   => __('Select Categories','clever-fox'),
		'section' => 'slider_setting',
		) 
	) );
	
	
	// slider Contents
	$wp_customize->add_setting(
		'slider_content_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'news25_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_content_head',
		array(
			'type' => 'hidden',
			'label' => __('Middle Column','clever-fox'),
			'section' => 'slider_setting',
		)
	);
	
	
	// Slider Category
	$wp_customize->add_setting(
    'slider_category_id',
		array(
		'default'	=>	'2',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_categories',
		)
	);	
	$wp_customize->add_control( new News25_Category_Dropdown_Custom_Control( $wp_customize, 
	'slider_category_id', 
		array(
		'label'   => __('Select Categories','clever-fox'),
		'section' => 'slider_setting',
		) 
	) );
	
}

add_action( 'customize_register', 'news25_headline_one_setting' );