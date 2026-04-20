<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if( ! function_exists( 'cleverfox_hotel_26_dynamic_styles' ) ):
    function cleverfox_hotel_26_dynamic_styles() {
		$output_css = '';
		
		
		/**
		 * Logo Width 
		 */
		 $logo_width			= get_theme_mod('logo_width','250');		 
		if($logo_width !== '') { 
				$output_css .=".logo img, .mobile-logo img {
					max-width: " .esc_attr($logo_width). "px;
				}\n";
			}
		
		/**
		 *  Typography Body
		 */
		 $hotel_26_body_text_transform	 	 = get_theme_mod('hotel_26_body_text_transform','inherit');
		 $hotel_26_body_font_style	 		 = get_theme_mod('hotel_26_body_font_style','inherit');
		 $hotel_26_body_font_size	 		 = get_theme_mod('hotel_26_body_font_size','15');
		 $hotel_26_body_line_height		 = get_theme_mod('hotel_26_body_line_height','1.5');
		
		 $output_css .=" body{ 
			font-size: " .esc_attr($hotel_26_body_font_size). "px;
			line-height: " .esc_attr($hotel_26_body_line_height). ";
			text-transform: " .esc_attr($hotel_26_body_text_transform). ";
			font-style: " .esc_attr($hotel_26_body_font_style). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {	
			 $hotel_26_heading_text_transform 	= get_theme_mod('hotel_26_h' . $i . '_text_transform','inherit');
			 $hotel_26_heading_font_style	 	= get_theme_mod('hotel_26_h' . $i . '_font_style','inherit');
			 $hotel_26_heading_font_size	 		 = get_theme_mod('hotel_26_h' . $i . '_font_size');
			 $hotel_26_heading_line_height		 	 = get_theme_mod('hotel_26_h' . $i . '_line_height');
			 
			 $output_css .=" h" . $i . "{ 
				font-size: " .esc_attr($hotel_26_heading_font_size). "px;
				line-height: " .esc_attr($hotel_26_heading_line_height). ";
				text-transform: " .esc_attr($hotel_26_heading_text_transform). ";
				font-style: " .esc_attr($hotel_26_heading_font_style). ";
			}\n";
		 }
		 
		 
		
		/**
		 * Slider
		 */
		$hotel26_slider_overlay_enable 		= get_theme_mod('slider_overlay_enable','1');
		$hotel26_slide_overlay_color 		= get_theme_mod('slide_overlay_color','#000000');
		$hotel26_slider_opacity				= get_theme_mod('slider_opacity','0.6');
		list($br, $bg, $bb) = sscanf($hotel26_slide_overlay_color, "#%02x%02x%02x");
		if($hotel26_slider_overlay_enable == '1') { 
				$output_css .=".theme-slider {
					background: rgba($br, $bg, $bb, $hotel26_slider_opacity);
				}\n";
			}
		/**
		 * Services
		 */
		 $hotel26_service_bg_img	= get_theme_mod('service_bg_img', CLEVERFOX_PLUGIN_URL. 'inc/hotel-26/images/services/bg.jpg');
			$output_css .=".service-section.home {
					background-image: url(".esc_url($hotel26_service_bg_img).");					
			}\n";
					
	 wp_add_inline_style( 'hotel-26-style', $output_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'cleverfox_hotel_26_dynamic_styles' );