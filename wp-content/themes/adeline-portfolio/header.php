<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <?php
    $show_banner = (bool) get_theme_mod('show_header_banner', false);
    $banner_text = trim((string) get_theme_mod('header_banner_text', ''));
    $banner_url = trim((string) get_theme_mod('header_banner_url', ''));
    $banner_image = trim((string) get_theme_mod('header_banner_image', ''));
    $has_banner_content = ('' !== $banner_text) || ('' !== $banner_image);
        $header_banner_mode    = get_theme_mod('header_banner_mode', 'compact');

        if (! in_array($header_banner_mode, array('compact', 'full', 'edge'), true)) {
            $header_banner_mode = 'compact';
        }

        $banner_classes = 'site-header__banner site-header__banner--' . $header_banner_mode;
    ?>
    <?php if ($show_banner && $has_banner_content) : ?>
            <div class="<?php echo esc_attr($banner_classes); ?>" role="note">
            <?php if ($banner_url) : ?><a class="site-header__banner-link" href="<?php echo esc_url($banner_url); ?>"><?php endif; ?>
                <div class="site-header__banner-content">
                    <?php if ($banner_image) : ?>
                        <img
                            class="site-header__banner-image"
                            src="<?php echo esc_url($banner_image); ?>"
                            alt="<?php echo esc_attr($banner_text ? $banner_text : get_bloginfo('name')); ?>"
                        >
                    <?php endif; ?>

                    <?php if ($banner_text) : ?>
                        <span class="site-header__banner-text"><?php echo esc_html($banner_text); ?></span>
                    <?php endif; ?>
                </div>
            <?php if ($banner_url) : ?></a><?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="site-header__inner">
        <a class="site-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="site-brand__mark"></span>
            <span class="site-brand__text"><?php bloginfo('name'); ?></span>
        </a>
        <nav class="site-nav" aria-label="Primary Menu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'site-nav__list',
                'fallback_cb' => 'adeline_portfolio_primary_menu_fallback',
            ));
            ?>
        </nav>
    </div>
</header>
<main class="site-main">
