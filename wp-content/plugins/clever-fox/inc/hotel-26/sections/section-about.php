<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
$hotel26_about_hs	= get_theme_mod('hs_pg_about','1'); 
$hotel26_pg_about_first_img	= get_theme_mod('pg_about_first_img',esc_url(CLEVERFOX_PLUGIN_URL .'inc/hotel-26/images/about/about-1.jpg')); 
$hotel26_pg_about_second_img	= get_theme_mod('pg_about_second_img',esc_url(CLEVERFOX_PLUGIN_URL .'inc/hotel-26/images/about/about-2.jpg')); 
$hotel26_about_pg_title 		= get_theme_mod('pg_about_title','Explore');
$hotel26_about_pg_subtitle 		= get_theme_mod('pg_about_subtitle','About <span class="color-secondary">Us</span>');
$hotel26_about_pg_description	= get_theme_mod('pg_about_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');	
$hotel26_about_title			= get_theme_mod('about_title','"Welcome to The Elegance of <span class="color-secondary">Nayra Hotel</span> & Resort"');	
$hotel26_about_description		= get_theme_mod('about_description','At our hotel luxury is more that just a word it a tradition From exquisite Design to personalized service. every detail is thoughtfully curated to create unforgetable experiences. whether youre here for relaxation or celebration.');
$hotel26_about_video_link		= get_theme_mod('about_video_link','https://www.youtube.com/watch?v=1iIZeIy7TqM');
$hotel26_about_btn_lbl		= get_theme_mod('about_btn_lbl','Learn More');
$hotel26_about_btn_link		= get_theme_mod('about_btn_link');
$hotel26_about_btn_newtab		= get_theme_mod('about_btn_newtab');
$hotel26_about_btn_nofollow		= get_theme_mod('about_btn_nofollow');
$hotel26_pg_about_content		= get_theme_mod('pg_about_content','<div class="row about-services-boxes"><div class="col-6"><div class="service-box st-tilt"><div class="service-icon"><i class="fa fa-bed" aria-hidden="true"></i></div><h6>Airport Shuttle Service</h6></div></div><div class="col-6"><div class="service-box st-tilt"><div class="service-icon"><i class="fa fa-bed" aria-hidden="true"></i></div><h6>Luxury Spa & Wellness</h6></div></div></div><ul class="about-features-list mb-3 mb-sm-4"><li><i class="fa fa-check-circle"></i> Modern & Comfortable Rooms</li><li><i class="fa fa-check-circle"></i> Business Lounge & Meeting Rooms</li><li><i class="fa fa-check-circle"></i> Laundry & Dry Cleaning Services</li></ul>'); 

if($hotel26_about_hs == '1' ) {
?>
<section id="about-section" class="about-section st-py-default">
	<div class="container">
		<div class="heading-default text-center wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
			<div class="section-title">
				<?php if(!empty($hotel26_about_pg_title)): ?>
					<h6 class="sub-title wow bounceInDown"><?php echo wp_kses_post($hotel26_about_pg_title); ?></h6>				
				<?php endif; ?>
				<?php if(!empty($hotel26_about_pg_subtitle)): ?>
					<h2 class="wow bounceIn title"><?php echo wp_kses_post($hotel26_about_pg_subtitle); ?></h2>				
				<?php endif; ?>
				<?php if(!empty($hotel26_about_pg_description)): ?>
					<p class="wow bounceInUp desc"><?php echo wp_kses_post($hotel26_about_pg_description); ?></p>
				<?php endif; ?>				
				</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="row">
					<?php if(!empty($hotel26_pg_about_first_img)){ ?>
					<div class="col-7">
						<div class="about-image1 st-autoptimize-right wow fadeIn" data-wow-delay="100ms" data-wow-duration="1500ms">
						<img src="<?php echo esc_url($hotel26_pg_about_first_img); ?>" alt="<?php echo esc_attr('Image 1','clever-fox'); ?>"/>
						</div>
					</div>
					<?php } ?>
					<?php if(!empty($hotel26_pg_about_second_img)){ ?>
					<div class="col-5 position-relative">
						<div class="about-image2 position-relative wow fadeIn" data-wow-delay="200ms" data-wow-duration="1500ms">
							<div class="st-autoptimize-left">
								<img src="<?php echo esc_url($hotel26_pg_about_second_img); ?>" alt="<?php echo esc_attr('Image 2','clever-fox'); ?>"/>
							</div>
						</div>
						<?php if(!empty($hotel26_about_video_link)) { ?>
						<div class="about-video-badge wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
							<div class="rotating-text"><?php echo esc_html__('VIDEO PLAY - VIDEO PLAY - VIDEO PLAY - VIDEO PLAY -','clever-fox'); ?></div>
							<div class="video-center">
								<a href="<?php echo esc_url($hotel26_about_video_link); ?>" class="play-icon popup-youtube"><i class="fa fa-play-circle"></i></a>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="about-content wow fadeIn" data-wow-delay="300ms" data-wow-duration="1500ms">
					<?php if(!empty($hotel26_about_title)){ ?>
						<h3 class="about-title"><?php echo wp_kses_post($hotel26_about_title); ?></h3>
					<?php } ?>
					<?php if(!empty($hotel26_about_description)){ ?>
						<p class="about-description"><?php echo esc_html($hotel26_about_description); ?></p>
					<?php } ?>
					<?php if(!empty($hotel26_pg_about_content)): echo do_shortcode($hotel26_pg_about_content);  endif; ?>
					<?php if(!empty($hotel26_about_btn_lbl)): ?><a href="<?php echo esc_url($hotel26_about_btn_link); ?>" <?php if($hotel26_about_btn_newtab =='1') {echo 'target="_blank"'; } ?> rel="<?php if($hotel26_about_btn_newtab =='1') {echo 'noreferrer noopener';} ?> <?php if($hotel26_about_btn_nofollow =='1') {echo 'nofollow';} ?>" class="btn btn-secondary"><?php echo esc_html($hotel26_about_btn_lbl); ?></a><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>