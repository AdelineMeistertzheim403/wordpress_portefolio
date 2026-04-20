<?php
/**
 * @package   Hotel 26
 */
if ( ! defined( 'ABSPATH' ) ) exit;

require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/extras.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/dynamic-style.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/above-header.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-header.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-slider.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-booking.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-about.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-service.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-team.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-award.php';
require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/features/hotel-26-typography.php';

if ( ! function_exists( 'cleverfox_hotel_26_frontpage_sections' ) ) :
	function cleverfox_hotel_26_frontpage_sections() {
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-slider.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-booking.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-about.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-service-one.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-team.php';
		require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/section-award.php';
    }
endif;
add_action( 'hotel_26_sections', 'cleverfox_hotel_26_frontpage_sections' );