<?php 
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_award_hs 				= get_theme_mod('award_hs','1');
	$hotel26_award_title 			= get_theme_mod('award_title','Explore');
	$hotel26_award_subtitle 		= get_theme_mod('award_subtitle','Hotel <span class="color-secondary">Awards');
	$hotel26_award_description		= get_theme_mod('award_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); 
	$hotel26_award_contents			= get_theme_mod('award_contents',hotel26_award_default());
	
if($hotel26_award_hs == '1' ) {
?>	
<section id="award-section" class="award-section st-py-default wow fadeIn">
	<div class="container">
		<div class="award-slider owl-carousel">
		<?php
			if ( ! empty( $hotel26_award_contents ) ) {
			$hotel26_award_contents = json_decode( $hotel26_award_contents );
			foreach ( $hotel26_award_contents as $hotel26_index => $hotel26_award_item ) {
				$hotel26_repeater_image = ! empty( $hotel26_award_item->image_url ) ? apply_filters( 'hotel_26_translate_single_string', $hotel26_award_item->image_url, 'Award section' ) : '';
				if( !empty($hotel26_repeater_image) ):
			?>
			<div class="award-item st-media-hover wow zoomIn">			
				<img src="<?php echo esc_url($hotel26_repeater_image); ?>" alt="<?php echo esc_attr__('Award','clever-fox'); ?>">
				<img src="<?php echo esc_url($hotel26_repeater_image); ?>" alt="<?php echo esc_attr__('Award','clever-fox'); ?>">
				</div>
			<?php  endif; } } ?>
		</div>
	</div>
</section>
<?php } ?>