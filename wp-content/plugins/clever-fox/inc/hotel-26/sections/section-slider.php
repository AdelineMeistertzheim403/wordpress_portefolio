<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_slider_hs 		= get_theme_mod('slider_hs','1');
	$hotel26_slider 		= get_theme_mod('slider',hotel_26_get_slider_default());
	if($hotel26_slider_hs == '1') {
?>
	<section id="slider-section" class="slider-wrapper style1">
		<div class="main-slider owl-carousel owl-theme">
		<?php
				if ( ! empty( $hotel26_slider ) ) {
				$hotel26_allowed_html = array(
							'br'     => array(),
							'em'     => array(),
							'strong' => array(),
							'b'      => array(),
							'i'      => array(),
							'span'   => array('class' => array()),
							);
				$hotel26_slider = json_decode( $hotel26_slider );
				foreach ( $hotel26_slider as $hotel26_slide_item ) {
					$hotel26_repeater_title = ! empty( $hotel26_slide_item->title ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->title, 'slider section' ) : '';
					$hotel26_repeater_subtitle = ! empty( $hotel26_slide_item->subtitle ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->subtitle, 'slider section' ) : '';				
					$hotel26_repeater_description = ! empty( $hotel26_slide_item->description ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->description, 'slider section' ) : '';
					$hotel26_repeater_button = ! empty( $hotel26_slide_item->button_text) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->button_text,'slider section' ) : '';
					$hotel26_repeater_button_link = ! empty( $hotel26_slide_item->button_link ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->button_link, 'slider section' ) : '';
					$hotel26_repeater_text = ! empty( $hotel26_slide_item->text) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->text,'slider section' ) : '';			
					$hotel26_repeater_image = ! empty( $hotel26_slide_item->image_url ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->image_url, 'slider section' ) : '';
					$hotel26_repeater_newtab = ! empty( $hotel26_slide_item->newtab ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->newtab, 'slider section' ) : '';
					$hotel26_repeater_nofollow = ! empty( $hotel26_slide_item->nofollow ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_slide_item->nofollow, 'slider section' ) : '';
					
			?>
			<div class="item">
				<?php if(!empty($hotel26_repeater_image)): ?><img src="<?php echo esc_url($hotel26_repeater_image); ?>" data-img-url="<?php echo esc_url($hotel26_repeater_image); ?>" alt="<?php echo esc_attr__('Slider Image Here','clever-fox'); ?>" ><?php endif; ?>
				<div class="theme-slider">
					<div class="theme-table">
						<div class="theme-table-cell">
							<div class="container">                                
								<div class="theme-content text-center">
									<div class="star-rating" data-animation="fadeInDown" data-delay="100ms">
										<?php
										 if (!empty($hotel26_repeater_text)) {	
											$hotel26_rating = floatval($hotel26_repeater_text);
											$hotel26_full_stars = floor($hotel26_rating);
											$hotel26_half_star = ($hotel26_rating - $hotel26_full_stars) >= 0.5 ? true : false;
											for ($hotel26_i = 0; $hotel26_i < $hotel26_full_stars; $hotel26_i++) {
												echo '<i class="fa fa-star"></i> ';
											}
											if ($hotel26_half_star) {
												echo '<i class="fa fa-star-half-alt"></i> ';
											} 
										} 
									?>
									</div>
									<?php if(!empty($hotel26_repeater_title)) { ?><h3 data-animation="fadeInDown" data-delay="150ms"><?php echo wp_kses( html_entity_decode( $hotel26_repeater_title ), $hotel26_allowed_html ); ?></h3><?php } ?>
									<?php if(!empty($hotel26_repeater_subtitle)) { ?><h1 data-animation="flipInX" data-delay="200ms"><?php echo wp_kses( html_entity_decode( $hotel26_repeater_subtitle ), $hotel26_allowed_html ); ?></h1><?php } ?>
									<?php if(!empty($hotel26_repeater_description)) { ?><p data-animation="fadeInUp" data-delay="500ms"><?php echo wp_kses_post( html_entity_decode($hotel26_repeater_description ), $hotel26_allowed_html ); ?></p><?php } ?>
									<?php if(!empty($hotel26_repeater_button)) { ?><a href="<?php echo esc_url($hotel26_repeater_button_link); ?>" <?php if($hotel26_repeater_newtab =='1') {echo 'target="_blank"'; } ?> rel="<?php if($hotel26_repeater_newtab =='1') {echo 'noreferrer noopener';} ?> <?php if($hotel26_repeater_nofollow =='1') {echo 'nofollow';} ?>" class="btn btn-secondary" data-animation="fadeInUp" data-delay="600ms"><?php echo wp_kses_post( $hotel26_repeater_button ); ?></a><?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } } ?>		
		</div>
	</section>
<?php } ?>