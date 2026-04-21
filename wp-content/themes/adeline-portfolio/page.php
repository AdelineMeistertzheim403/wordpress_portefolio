<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php
while (have_posts()) :
    the_post();
    $show_hero = adeline_portfolio_is_section_visible(get_the_ID(), 'show_hero', true);
    $show_page_content = adeline_portfolio_is_section_visible(get_the_ID(), 'show_page_content', true);
    $show_featured_image = adeline_portfolio_is_section_visible(get_the_ID(), 'show_featured_image', true);
    $show_contextual_blocks = adeline_portfolio_is_section_visible(get_the_ID(), 'show_contextual_blocks', true);
    $variant = adeline_portfolio_get_page_variant_data(get_the_ID());
    $variant_key = isset($variant['key']) ? sanitize_html_class($variant['key']) : 'default';
    $variant_eyebrow = isset($variant['eyebrow']) ? $variant['eyebrow'] : __('Page', 'adeline-portfolio');
    $variant_subtitle = isset($variant['subtitle']) ? $variant['subtitle'] : '';
    $variant_highlights = isset($variant['highlights']) && is_array($variant['highlights']) ? $variant['highlights'] : array();
    $variant_blocks = adeline_portfolio_get_key_page_blocks($variant_key);
    $intro = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 30);
    ?>
    <?php if ($show_hero) : ?>
        <section class="site-shell page-hero page-hero--<?php echo esc_attr($variant_key); ?>">
            <div class="page-hero__content">
                <p class="front-section__eyebrow"><?php echo esc_html($variant_eyebrow); ?></p>
                <h1><?php the_title(); ?></h1>
                <?php if ($intro) : ?>
                    <p><?php echo esc_html($intro); ?></p>
                <?php elseif ($variant_subtitle) : ?>
                    <p><?php echo esc_html($variant_subtitle); ?></p>
                <?php endif; ?>

                <?php if (!empty($variant_highlights)) : ?>
                    <div class="page-hero__chips" aria-label="Highlights">
                        <?php foreach ($variant_highlights as $highlight) : ?>
                            <span class="page-hero__chip"><?php echo esc_html($highlight); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($show_page_content) : ?>
        <section class="site-shell front-section page-content-section page-content-section--<?php echo esc_attr($variant_key); ?>">
            <article <?php post_class('content-entry page-entry'); ?>>
                <?php if ($show_featured_image && has_post_thumbnail()) : ?>
                    <div class="content-entry__media">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </section>
    <?php endif; ?>

    <?php if ($show_contextual_blocks && !empty($variant_blocks)) : ?>
        <section class="site-shell front-section page-variant-notes page-variant-notes--<?php echo esc_attr($variant_key); ?>">
            <div class="front-grid front-grid--editorial">
                <?php foreach ($variant_blocks as $block) : ?>
                    <article class="front-card">
                        <p class="front-card__kicker"><?php echo esc_html($variant_eyebrow); ?></p>
                        <h2><?php echo esc_html($block['title']); ?></h2>
                        <p><?php echo esc_html($block['text']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
    <?php
endwhile;
?>
<?php
get_footer();
