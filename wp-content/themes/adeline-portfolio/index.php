<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php $show_archive_hero = adeline_portfolio_get_archive_setting('show_articles_archive_hero', true); ?>
<?php $show_archive_pagination = adeline_portfolio_get_archive_setting('show_articles_archive_pagination', true); ?>

<?php if ($show_archive_hero) : ?>
    <section class="site-shell page-hero page-hero--articles">
        <div class="page-hero__content">
            <p class="front-section__eyebrow"><?php esc_html_e('Blog', 'adeline-portfolio'); ?></p>
            <h1><?php esc_html_e('Articles techniques', 'adeline-portfolio'); ?></h1>
            <p><?php esc_html_e('Retrouve ici les articles, retours d’experience et notes techniques du portfolio.', 'adeline-portfolio'); ?></p>
        </div>
    </section>
<?php endif; ?>

<section class="site-shell front-section page-content-section page-content-section--articles">
    <?php if (have_posts()) : ?>
        <div class="front-grid front-grid--posts">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('front-card front-card--post'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <a class="front-card__media" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    <?php endif; ?>
                    <p class="front-card__meta">
                        <span><?php echo esc_html(get_the_date()); ?></span>
                    </p>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 26)); ?></p>
                    <a class="front-card__link" href="<?php the_permalink(); ?>">
                        <?php esc_html_e('Lire l’article', 'adeline-portfolio'); ?>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

        <?php if ($show_archive_pagination) : ?>
            <div class="front-section__footer site-pagination">
                <?php the_posts_pagination(); ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <article class="front-card front-card--placeholder">
            <p class="front-card__kicker"><?php esc_html_e('Blog', 'adeline-portfolio'); ?></p>
            <h2><?php esc_html_e('Aucun article publie pour le moment', 'adeline-portfolio'); ?></h2>
            <p><?php esc_html_e('Ajoute ton premier article pour alimenter cette section automatiquement.', 'adeline-portfolio'); ?></p>
        </article>
    <?php endif; ?>
</section>
<?php
get_footer();
