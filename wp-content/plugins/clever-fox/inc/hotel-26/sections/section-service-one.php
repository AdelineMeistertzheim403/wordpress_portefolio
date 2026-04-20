<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_service_hs 			= get_theme_mod('service_hs','1');
	$hotel26_service_header_hs 		= get_theme_mod('service_header_hs','1');
	$hotel26_service_title 			= get_theme_mod('service_title','Facilities');
	$hotel26_service_subtitle 		= get_theme_mod('service_subtitle','Hotel <span class="color-secondary">Services</span>');
	$hotel26_service_description	= get_theme_mod('service_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); 
	$hotel26_service_contents		= get_theme_mod('service_contents',hotel26_get_service_default());
if( $hotel26_service_hs == '1' ) {	
?>	
<section id="service-section" class="service-section home st-py-default ripple-area">
	<div class="container">
	<?php if($hotel26_service_header_hs == '1') { ?>
		<div class="heading-default text-center wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
			<div class="section-title">
				<?php if(!empty($hotel26_service_title)): ?>
					<h6 class="sub-title wow bounceInDown"><?php echo wp_kses_post($hotel26_service_title); ?></h6>				
				<?php endif; ?>
				<?php if(!empty($hotel26_service_subtitle)): ?>
					<h2 class="wow bounceIn title"><?php echo wp_kses_post($hotel26_service_subtitle); ?></h2>				
				<?php endif; ?>
				<?php if(!empty($hotel26_service_description)): ?>
					<p class="wow bounceInUp desc"><?php echo wp_kses_post($hotel26_service_description); ?></p>
				<?php endif; ?>				
			</div>
		</div>
		<?php } ?>
		<div class="service-slider owl-carousel">
			<?php
				if ( ! empty( $hotel26_service_contents ) ) {
				$hotel26_service_contents = json_decode( $hotel26_service_contents );
				foreach ( $hotel26_service_contents as $hotel26_index => $hotel26_service_item ) {
					$hotel26_repeater_title = ! empty( $hotel26_service_item->title ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->title, 'Service section' ) : '';
					$hotel26_repeater_description = ! empty( $hotel26_service_item->description ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->description, 'Service section' ) : '';
					$hotel26_repeater_button = ! empty( $hotel26_service_item->button_text ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->button_text, 'Service section' ) : '';
					$hotel26_repeater_link = ! empty( $hotel26_service_item->button_link ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->button_link, 'Service section' ) : '';
					$hotel26_repeater_newtab = ! empty( $hotel26_service_item->newtab ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->newtab, 'Service section' ) : '';
					$hotel26_repeater_nofollow = ! empty( $hotel26_service_item->nofollow ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->nofollow, 'Service section' ) : '';
					$hotel26_repeater_image = ! empty( $hotel26_service_item->image_url2 ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->image_url2, 'Service section' ) : '';
					$hotel26_repeater_icon = ! empty( $hotel26_service_item->icon_value ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_service_item->icon_value, 'Service section' ) : '';
				?>
			<div class="service-item wow flipInY wow fadeIn" data-wow-delay="<?php echo esc_attr($hotel26_index * 100); ?>ms" data-wow-duration="1500ms">
				<?php if(!empty($hotel26_repeater_image)): ?>
					<div class="service-img">
						<img src="<?php echo esc_url($hotel26_repeater_image); ?>" alt="Service Image">
					</div>
				<?php endif; ?>
				<?php if(!empty($hotel26_repeater_title)): ?>
					<h5 class="service-title"><?php echo esc_html( $hotel26_repeater_title ); ?></h5>
				<?php endif; ?>
				<?php if(!empty($hotel26_repeater_description)): ?>
					<p class="service-description"><?php echo esc_html( $hotel26_repeater_description ); ?></p>
				<?php endif; ?>
				<?php if(!empty($hotel26_repeater_button)): ?>								
					<a href="<?php echo esc_url($hotel26_repeater_link); ?>" class="btn btn-secondary" <?php if($hotel26_repeater_newtab == '1') {echo 'target="_blank"'; } ?> rel="<?php if($hotel26_repeater_newtab == '1') {echo 'noreferrer noopener'; } ?> <?php if($hotel26_repeater_nofollow == '1') {echo 'nofollow'; } ?>" ><?php echo esc_html( $hotel26_repeater_button ); ?></a>
				<?php endif; ?>
			</div>
			<?php } } ?>			
		</div>
	</div>
</section>
<?php } ?>