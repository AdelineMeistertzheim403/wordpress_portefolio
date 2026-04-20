<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	$hotel26_form_shortcode= get_theme_mod('hotel_form_shortcode');
	if(!empty($hotel26_form_shortcode)): echo do_shortcode($hotel26_form_shortcode); else: 
?>

<form id="hb-form-search-page" name="hb-search-form" action="#" class="hb-search-form-694111fc86e4a">
	<h3><?php echo esc_html__('Check Availability','clever-fox'); ?></h3>
	<ul class="hb-form-table">
		<li class="hb-form-field">
			<label><?php echo esc_html__('Check-in','clever-fox'); ?></label>				
			<div class="hb-form-field-input hb_input_field">
				<input type="date" name="check_in_date" id="check_in_date_694111fc86e4a" class="hb_input_date_check flatpickr-input" value="" placeholder="<?php echo esc_attr__('Check-in Date','clever-fox'); ?>" autocomplete="on">
			</div>
		</li>

		<li class="hb-form-field">
			<label><?php echo esc_html__('Check-out','clever-fox'); ?></label>				
			<div class="hb-form-field-input hb_input_field">
				<input type="date" name="check_out_date" id="check_out_date_694111fc86e4a" class="hb_input_date_check flatpickr-input" value="" placeholder="<?php echo esc_attr__('Check-out Date','clever-fox'); ?>" autocomplete="on">
			</div>
		</li>

		<li class="hb-form-field">
			<label><?php echo esc_html__('Adults','clever-fox'); ?></label>				
			<div class="hb-form-field-input">
				<select name="adults_capacity"><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option></select>				
				<?php echo wp_kses_post(guests_nav()); ?>
			</div>
		</li>

		<li class="hb-form-field">
			<label><?php echo esc_html__('Children','clever-fox'); ?></label>				
			<div class="hb-form-field-input">
				<select name="max_child"><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option></select>				
				<?php echo wp_kses_post(guests_nav()); ?>
			</div>
		</li>
		<li class="hb-form-field">
			<label><?php echo esc_html__('Number of rooms','clever-fox'); ?></label>				
			<div class="hb-form-field-input">
				<select name="number-of-rooms"><option value=""><?php echo esc_html__('Number of rooms','clever-fox'); ?></option><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option></select>				
			</div>
		</li>
	</ul>
	<input type="hidden" id="nonce" name="nonce" value="eebf0813ef">
	<input type="hidden" name="_wp_http_referer" value="#">		
	<input type="hidden" name="hotel-booking" value="results">
	<input type="hidden" name="widget-search" value="">
	<input type="hidden" name="action" value="hotel_booking_parse_search_params">
	<input type="hidden" name="paged" value="1">
	<p class="hb-submit">
		<button type="submit" class="wphb-button"><?php echo esc_html__('Check Availability','clever-fox'); ?></button>
	</p>
</form>
<?php endif; ?>