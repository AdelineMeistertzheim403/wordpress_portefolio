<?php   
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_team_hs 		= get_theme_mod('team_hs','1');
	$hotel26_team_header_hs 		= get_theme_mod('team_header_hs','1');
	$hotel26_team_title 			= get_theme_mod('team_title','Explore');
	$hotel26_team_subtitle 			= get_theme_mod('team_subtitle','Our <span class="color-secondary">Team</span>');
	$hotel26_team_description		= get_theme_mod('team_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); 
	$hotel26_team_contents			= get_theme_mod('team_contents',hotel26_team_default());
	
if( $hotel26_team_hs == '1' ) {
?>
<section id="team-section" class="team-section st-py-default">	
	<div class="container">
	<?php if($hotel26_team_header_hs == '1') { ?>
		<div class="heading-default text-center wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
			<div class="section-title">
				<?php if(!empty($hotel26_team_title)): ?>
					<h6 class="sub-title wow bounceInDown"><?php echo wp_kses_post($hotel26_team_title); ?></h6>				
				<?php endif; ?>
				<?php if(!empty($hotel26_team_subtitle)): ?>
					<h2 class="wow bounceIn title"><?php echo wp_kses_post($hotel26_team_subtitle); ?></h2>				
				<?php endif; ?>
				<?php if(!empty($hotel26_team_description)): ?>
					<p class="wow bounceInUp desc"><?php echo wp_kses_post($hotel26_team_description); ?></p>
				<?php endif; ?>				
			</div>
		</div>
		<?php } ?>
		<div class="team-slider owl-carousel">
			<?php
			if ( ! empty( $hotel26_team_contents ) ) {
				$hotel26_team_contents = json_decode( $hotel26_team_contents );
				foreach ( $hotel26_team_contents as $hotel26_team_item ) {
					$hotel26_repeater_title = ! empty( $hotel26_team_item->title ) ? apply_filters( 'Hotel26_translate_single_string', $hotel26_team_item->title, 'team section' ) : '';
					$hotel26_repeater_subtitle = ! empty( $hotel26_team_item->subtitle ) ? apply_filters( 'Hotel26_translate_single_string', $hotel26_team_item->subtitle, 'team section' ) : '';
					$hotel26_repeater_image = ! empty( $hotel26_team_item->image_url ) ? apply_filters( 'Hotel26_translate_single_string', $hotel26_team_item->image_url, 'team section' ) : '';
			?>
			<div class="team-item wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
				<div class="team-inner">
					<div class="team-img">
						<img src="<?php echo esc_url($hotel26_repeater_image); ?>" alt="Team Image">
						<div class="social-icon">
							<ul class="flex">
							<?php if ( ! empty( $hotel26_team_item->social_repeater ) ) :
							$hotel26_repeater_icons         = html_entity_decode( $hotel26_team_item->social_repeater );
							$hotel26_repeater_icons_decoded = json_decode( $hotel26_repeater_icons, true );
							if ( ! empty( $hotel26_repeater_icons_decoded ) ) : ?>
							<?php
								foreach ( $hotel26_repeater_icons_decoded as $hotel26_repeater_index_social=>$hotel26_repeater_value ) {
									$hotel26_repeater_social_icon = ! empty( $hotel26_repeater_value['icon'] ) ? apply_filters( 'Hotel26_translate_single_string', $hotel26_repeater_value['icon'], 'Team section' ) : '';
									$hotel26_repeater_social_link = ! empty( $hotel26_repeater_value['link'] ) ? apply_filters( 'Hotel26_translate_single_string', $hotel26_repeater_value['link'], 'Team section' ) : '';
									if ( ! empty( $hotel26_repeater_social_icon ) ) {
							?>
								<li style="transition: <?php echo esc_attr(($hotel26_repeater_index_social+1) * 0.2); ?>s;">
									<a href="<?php echo esc_url( $hotel26_repeater_social_link ); ?>" target="_blank"><i class="fab <?php echo esc_attr( $hotel26_repeater_social_icon ); ?>"></i></a>
								</li>
								<?php	} } endif; endif; ?>								
							</ul>
						</div>
					</div>
					<div class="team-content">
						<?php if(!empty($hotel26_repeater_title)){ ?><h6><?php echo esc_html( $hotel26_repeater_title ); ?></h6><?php } ?>
						<?php if(!empty($hotel26_repeater_subtitle)){ ?><p><?php echo esc_html( $hotel26_repeater_subtitle ); ?></p><?php } ?>
					</div>
				</div>
			</div>
			<?php }} ?>
		</div>
	</div>
</section>
<?php } ?>