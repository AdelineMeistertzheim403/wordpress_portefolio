<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php $show_archive_hero = adeline_portfolio_get_archive_setting('show_projects_archive_hero', true); ?>
<?php $show_archive_pagination = adeline_portfolio_get_archive_setting('show_projects_archive_pagination', true); ?>

<section class="site-shell front-section">
    <?php if ($show_archive_hero) : ?>
        <div class="front-section__heading">
            <p class="front-section__eyebrow"><?php esc_html_e('Portfolio', 'adeline-portfolio'); ?></p>
            <h1><?php post_type_archive_title(); ?></h1>
            <p><?php esc_html_e('Retrouve ici les projets publies dans le portfolio. Chaque fiche peut presenter le contexte, les choix de conception et le resultat final.', 'adeline-portfolio'); ?></p>
        </div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>
        <div class="front-grid front-grid--projects">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('front-card front-card--project'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <a class="front-card__media" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    <?php endif; ?>
                    <p class="front-card__kicker"><?php esc_html_e('Projet', 'adeline-portfolio'); ?></p>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 26)); ?></p>
                    <a class="front-card__link" href="<?php the_permalink(); ?>">
                        <?php esc_html_e('Voir le detail', 'adeline-portfolio'); ?>
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
            <p class="front-card__kicker"><?php esc_html_e('Portfolio', 'adeline-portfolio'); ?></p>
            <h2><?php esc_html_e('Aucun projet publie pour le moment', 'adeline-portfolio'); ?></h2>
            <p><?php esc_html_e('Ajoute ton premier projet dans l’admin WordPress pour alimenter automatiquement cette archive et la page d’accueil.', 'adeline-portfolio'); ?></p>
            <?php if (current_user_can('edit_posts')) : ?>
                <a class="front-card__link" href="<?php echo esc_url(admin_url('post-new.php?post_type=project')); ?>">
                    <?php esc_html_e('Ajouter un projet', 'adeline-portfolio'); ?>
                </a>
            <?php endif; ?>
        </article>
    <?php endif; ?>
</section>
<?php
get_footer();