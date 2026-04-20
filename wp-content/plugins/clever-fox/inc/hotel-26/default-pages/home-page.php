<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	//post status and options
	$post = array(
		  'comment_status' => 'closed',
		  'ping_status' =>  'closed' ,
		  'post_author' => 1,
		  'post_date' => gmdate('Y-m-d H:i:s'),
		  'post_name' => 'Home',
		  'post_status' => 'publish' ,
		  'post_title' => 'Home',
		  'post_type' => 'page',
	);  
	//insert page and save the id
	$cleverfox_newvalue = wp_insert_post( $post, false );
	if ( $cleverfox_newvalue && ! is_wp_error( $cleverfox_newvalue ) ){
		update_post_meta( $cleverfox_newvalue, '_wp_page_template', 'templates/template-homepage.php' );
		
		// Use a static front page
		$cleverfox_array_of_objects = get_posts([
			'title' => 'Home',
			'post_type' => 'any',
		]);
		$page = $cleverfox_array_of_objects[0];//Be sure you have an array with single post or page
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $page->ID );
		
	}
	
	
	set_theme_mod('hdr_nav_btn_lbl','Book Now');
	set_theme_mod('business_call_ttl_one','Reservation:');
	set_theme_mod('business_call_num_one','+91 123 5555 789');
	set_theme_mod('business_call_ttl_two','Booking:');
	set_theme_mod('business_call_num_two','+91 123 5555 222');
	set_theme_mod('business_location_ttl','Find Us On Google');
	set_theme_mod('business_location_subttl','View Business Details');