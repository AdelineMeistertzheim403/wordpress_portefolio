<?php 
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_booking_hs = get_theme_mod('booking_hs','1');
	$hotel26_theme = wp_get_theme();
	if($hotel26_booking_hs == '1') {
?>
<section id="booking-section" class="booking-section style1 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">	
	<div class="container">
		<?php require CLEVERFOX_PLUGIN_DIR . 'inc/hotel-26/sections/booking-form.php'; ?>
	</div>
</section>
<?php } ?>