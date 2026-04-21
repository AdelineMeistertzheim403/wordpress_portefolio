<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $show_hero = adeline_portfolio_is_section_visible(get_the_ID(), 'show_hero', true);
    $show_page_content = adeline_portfolio_is_section_visible(get_the_ID(), 'show_page_content', true);
    $show_featured_image = adeline_portfolio_is_section_visible(get_the_ID(), 'show_featured_image', true);
    $show_entry_navigation = adeline_portfolio_is_section_visible(get_the_ID(), 'show_entry_navigation', true);
    ?>
    <?php if ($show_hero) : ?>
        <section class="site-shell page-hero page-hero--articles">
            <div class="page-hero__content">
                <p class="front-section__eyebrow"><?php esc_html_e('Article technique', 'adeline-portfolio'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p class="content-entry__meta">
                    <span><?php echo esc_html(get_the_date()); ?></span>
                    <?php
                    $categories = get_the_category_list(', ');
                    if ($categories) {
                        echo ' <span aria-hidden="true">•</span> '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        echo wp_kses_post($categories);
                    }
                    ?>
                </p>
                <?php if (has_excerpt()) : ?>
                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($show_page_content) : ?>
        <section class="site-shell front-section page-content-section page-content-section--articles">
            <article <?php post_class('content-entry post-entry'); ?>>
                <?php if ($show_featured_image && has_post_thumbnail()) : ?>
                    <div class="content-entry__media">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php if ($show_entry_navigation) : ?>
                    <footer class="entry-navigation">
                        <div class="entry-navigation__item">
                            <?php previous_post_link('%link', '← %title'); ?>
                        </div>
                        <div class="entry-navigation__item entry-navigation__item--next">
                            <?php next_post_link('%link', '%title →'); ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>
        </section>
    <?php endif; ?>
<?php endwhile; ?>
<?php
get_footer();
