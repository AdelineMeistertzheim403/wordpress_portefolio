<?php
if ( ! defined( 'ABSPATH' ) ) exit;
// Load core files
require_once CLEVERFOX_PLUGIN_DIR . 'inc/upgrade/core/class-upgrade-control.php';
require_once CLEVERFOX_PLUGIN_DIR . 'inc/upgrade/core/helpers.php';

// Load only active theme files
add_action( 'init', function() {

    $current_theme = get_stylesheet();
    $parent_theme  = get_template();

    $theme_path = CLEVERFOX_PLUGIN_DIR . 'inc/themes/' . $current_theme . '/';

    // fallback to parent theme
    if ( ! is_dir( $theme_path ) ) {
        $theme_path = CLEVERFOX_PLUGIN_DIR . 'inc/themes/' . $parent_theme . '/';
    }

    if ( is_dir( $theme_path ) ) {
        foreach ( glob( $theme_path . '*.php' ) as $file ) {
            require_once $file;
        }
    }

});