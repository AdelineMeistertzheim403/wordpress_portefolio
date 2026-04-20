<?php
	
if ( ! class_exists( 'CleverFox_Themes_Upgrade_Control' ) ) {

	class CleverFox_Themes_Upgrade_Control extends WP_Customize_Control {

		public $type = 'cleverfox-theme-upgrade';
		public $pro_url = '';
		public $custom_text = '';
		public $setting_id = '';

		public function render_content() {

			if ( empty( $this->pro_url ) ) return;

			// $class = sanitize_html_class( $this->id );
			?>
			<a class="customizer_<?php echo esc_attr( $this->setting_id ); ?>_upgrade_section up-to-pro" href="<?php echo esc_url( $this->pro_url ); ?>" target="_blank" <?php if ( strpos($this->custom_text, 'Unlock') === false ) { echo 'style="display: none;"';} ?>><?php echo esc_html($this->custom_text); ?></a>
			<?php
		}
	}
}