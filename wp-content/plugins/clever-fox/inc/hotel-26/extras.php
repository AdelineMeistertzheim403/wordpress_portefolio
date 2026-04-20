<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
 *
 * Slider Default
 */
	function hotel_26_get_slider_default() {
		return apply_filters(
			'hotel_26_get_slider_default', json_encode(
					 array(
					array(
						'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/slider01.jpg',
						'title'           => esc_html__( 'Welcome To Nayra Luxury Hotel', 'clever-fox' ),
						'subtitle'         => esc_html__( 'A New Vision of <span>Luxury</span>', 'clever-fox' ),
						'description'       => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>gallery of type and scrambled it to make a type specimen book.', 'clever-fox' ),
						'button_text'	  =>  esc_html__( 'Discover Rooms', 'clever-fox' ),
						'button_link'	  =>  '',
						'button2_text'	  =>  esc_html__( 'Book Now', 'clever-fox' ),
						'button2_link'	  =>  '',
						'link'	  =>  '#',
						'newtab'		=>	'1',
						'nofollow'		=>	'1',
						'text'	  =>  esc_html__( '4', 'clever-fox' ),
						'id'              => 'customizer_repeater_slider_001'					
					),				
				)
			)
		);
	}
	
/*
 *
 * Service Default
 */
 function hotel26_get_service_default() {
	return apply_filters(
		'hotel26_get_service_default', json_encode(
				 array(
				array(
					'title'           => esc_html__( 'Swimming Pool', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post1.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-1.png',
					'icon_value' => 'fa-swimmer',
					'id'              => 'customizer_repeater_service_001',
				),
				array(
					'title'           => esc_html__( 'High Speed Wifi', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  => '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post2.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-2.png',
					'icon_value' => 'fa-wifi',
					'id'              => 'customizer_repeater_service_002',
				),
				array(
					'title'           => esc_html__( 'Bar & Restaurant', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post3.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-3.png',
					'icon_value' => 'fa-utensils',
					'id'              => 'customizer_repeater_service_003',
				),
				array(
					'title'           => esc_html__( 'Private Parking', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post2.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-4.png',
					'icon_value' => 'fa-parking',
					'id'              => 'customizer_repeater_service_004',
				),
				array(
					'title'           => esc_html__( 'Swimming Pool', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post1.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-1.png',
					'icon_value' => 'fa-swimmer',
					'id'              => 'customizer_repeater_service_005',
				),
				array(
					'title'           => esc_html__( 'High Speed Wifi', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  => '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post3.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-2.png',
					'icon_value' => 'fa-wifi',
					'id'              => 'customizer_repeater_service_006',
				),
				array(
					'title'           => esc_html__( 'Bar & Restaurant', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post1.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-3.png',
					'icon_value' => 'fa-utensils',
					'id'              => 'customizer_repeater_service_007',
				),
				array(
					'title'           => esc_html__( 'Private Parking', 'clever-fox' ),
					'description'         => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'clever-fox' ),
					'button_text'	  =>  esc_html__( 'Read More', 'clever-fox' ),
					'button_link'	  =>  '',
					'newtab'		=>	'',
					'nofollow'		=>	'',
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/blog/post2.jpg',
					'image_url2'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/service-4.png',
					'icon_value' => 'fa-parking',
					'id'              => 'customizer_repeater_service_008',
				),			
			)
		)
	);
}

/*
 *
 * Award Default
 */
 function hotel26_award_default() {
	return apply_filters(
		'hotel26_award_default', json_encode(
				 array(
				array(
					'image_url'		=> esc_url(CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/awards/award1.png'),					
					'id'            => 'customizer_repeater_award_001',
				),
				array(
					'image_url'		=> esc_url(CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/awards/award2.png'),
					'id'            => 'customizer_repeater_award_002',
				),
				array(
					'image_url'		=> esc_url(CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/awards/award3.png'),
					'id'            => 'customizer_repeater_award_003',
				),
				array(
					'image_url'		=> esc_url(CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/awards/award4.png'),
					'id'            => 'customizer_repeater_award_004',
				),
			)								
		)

	);
}

/*
 *
 * Team Default
 */
 function hotel26_team_default() {
	return apply_filters(
		'hotel26_team_default', json_encode(
					  array(
				array(
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/team/team1.jpg',
					'title'           => esc_html__( 'Steven Lucy', 'clever-fox' ),
					'subtitle'        => esc_html__( 'Executive','clever-fox' ),
					'id'              => 'customizer_repeater_team_0001',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-team_001',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_002',
								'link' => 'googleplus.com',
								'icon' => 'fa-google-plus',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_003',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_004',
								'link' => 'instagram.com',
								'icon' => 'fa-instagram',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_005',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							)
						)
					),
				),
				array(
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/team/team2.jpg',
					'title'           => esc_html__( 'Glenn Maxwell', 'clever-fox' ),
					'subtitle'        => esc_html__( 'Project Manager', 'clever-fox' ),
					'id'              => 'customizer_repeater_team_0002',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0011',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0012',
								'link' => 'googleplus.com',
								'icon' => 'fa-google-plus',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0013',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0014',
								'link' => 'pinterest.com',
								'icon' => 'fa-instagram',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0015',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
						)
					),
				),
				array(
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/team/team3.jpg',
					'title'           => esc_html__( 'Aoron Finch', 'clever-fox' ),
					'subtitle'        => esc_html__( 'Manager and director', 'clever-fox' ),
					'id'              => 'customizer_repeater_team_0003',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0021',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0022',
								'link' => 'googleplus.com',
								'icon' => 'fa-google-plus',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0023',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0024',
								'link' => 'linkedin.com',
								'icon' => 'fa-instagram',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0025',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
						)
					),
				),
				array(
					'image_url'       => CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/team/team4.jpg',
					'title'           => esc_html__( 'Christiana Ena', 'clever-fox' ),
					'subtitle'        => esc_html__( 'Executive Officer', 'clever-fox' ),
					'id'              => 'customizer_repeater_team_0004',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0031',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0032',
								'link' => 'googleplus.com',
								'icon' => 'fa-google-plus',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0033',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0034',
								'link' => 'linkedin.com',
								'icon' => 'fa-instagram',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-team_0035',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
						)
					),
				)
			)
		)
	);
}



/**
 * 
 * Hotel 26 Premium Links
 * 
 */
 
 if ( ! function_exists( 'hotel_26_premium_links' ) ) :
	function hotel_26_premium_links() {
		
		$theme = wp_get_theme(); // gets the current theme
		if( 'Hotelchild1' == $theme->name){
			$hotel_26_premium_url= 'https://www.nayrathemes.com/hotel-26-c1-pro/';
		
		}else if( 'Hotelchild2' == $theme->name){
			$hotel_26_premium_url= 'https://www.nayrathemes.com/hotel-26-c2-pro/';
		
		}else if( 'Hotelchild3' == $theme->name){
			$hotel_26_premium_url= 'https://www.nayrathemes.com/hotel-26-c3-pro/';
		
		}else{
			$hotel_26_premium_url= 'https://www.nayrathemes.com/hotel-26-pro/';
		}	
		return $hotel_26_premium_url;
	}
endif;