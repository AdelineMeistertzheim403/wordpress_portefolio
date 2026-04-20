<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! function_exists( 'hotel26_above_header' ) ) {
	function hotel26_above_header() { ?>
		<div class="d-flex align-items-center justify-content-between">
				<div class="widget-left">						
					<?php 
					$hotel26_hide_show_hdr_cnct_left		= get_theme_mod( 'hide_show_hdr_cnct_left','1'); 					
					$hotel26_hdr_phone_lbl					= get_theme_mod( 'hdr_phone_lbl','1-800-458-56987'); 
					$hotel26_hdr_phone_link					= get_theme_mod( 'hdr_phone_link','1-800-458-56987'); 
					$hotel26_hdr_phone_icon					= get_theme_mod( 'hdr_phone_icon','fa-phone');  
					$hotel26_hdr_loc_lbl					= get_theme_mod( 'hdr_loc_lbl','123 Bakery Street, London, UK'); 
					$hotel26_hdr_loc_link					= get_theme_mod( 'hdr_loc_link',''); 
					$hotel26_hdr_loc_icon					= get_theme_mod( 'hdr_loc_icon','fa-map-marker-alt');
					
					if($hotel26_hide_show_hdr_cnct_left == '1') {
					?>
					<ul class="text-details contact-area">
						<li><a href="tel:<?php echo esc_attr($hotel26_hdr_phone_link); ?>"><i class="fa <?php echo esc_attr($hotel26_hdr_phone_icon); ?>"></i><span><?php echo esc_html($hotel26_hdr_phone_lbl); ?></span></a></li>
						<li><a href="<?php echo esc_url($hotel26_hdr_loc_link); ?>"><i class="fa <?php echo esc_attr($hotel26_hdr_loc_icon); ?>"></i><span><?php echo esc_html($hotel26_hdr_loc_lbl); ?></span></a></li>
					</ul> 						
					<?php }	hotel26_get_sidebars( 'hotel26-header-left' );
					?>
				</div>
				<div class="widget-right gap-4">
					<?php 
					
					hotel26_get_sidebars( 'hotel26-header-right' );
					
					$hotel26_hide_show_account_right		= get_theme_mod( 'hide_show_account_right','1');					 
					$hotel26_hdr_account_ttl_hs = get_theme_mod('hdr_account_ttl_hs','1');
					if($hotel26_hide_show_account_right == '1') {
					?>
					<div class="login-signup">
					<?php if(is_user_logged_in()): ?>
						<a href="<?php echo esc_url(wp_logout_url( home_url())); ?>" class="me-0"><i class="fa fa-sign-out"></i> <?php if($hotel26_hdr_account_ttl_hs == '1' ) { esc_html_e('Logout','clever-fox'); } ?></a>
					<?php else: ?>
						<a href="<?php echo esc_url( wp_login_url( home_url('/wp-admin'))); ?>"><i class="fa fa-user"></i> <?php if($hotel26_hdr_account_ttl_hs == '1' ) { esc_html_e('Log in','clever-fox'); } ?></a>
					<?php endif; ?>
					</div>
					<?php } ?>
				</div>
			</div>
		<?php
	}
}
add_action( 'hotel26_above_header', 'hotel26_above_header' );