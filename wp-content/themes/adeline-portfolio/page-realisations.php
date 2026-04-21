<?php
/**
 * Template Name: Mes realisations - Case studies
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();
    $show_hero = adeline_portfolio_is_section_visible(get_the_ID(), 'show_hero', true);
    $show_page_content = adeline_portfolio_is_section_visible(get_the_ID(), 'show_page_content', true);
    $show_case_studies = adeline_portfolio_is_section_visible(get_the_ID(), 'show_case_studies', true);
    $show_case_meta = adeline_portfolio_is_section_visible(get_the_ID(), 'show_case_meta', true);
    $is_friendly = adeline_portfolio_is_friendly_tone();

    $projects_query = new WP_Query(array(
        'post_type'      => 'project',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
    ));
    ?>
    <?php if ($show_hero) : ?>
        <section class="site-shell page-hero page-hero--projects">
            <div class="page-hero__content">
                <p class="front-section__eyebrow"><?php esc_html_e('Mes realisations', 'adeline-portfolio'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p>
                    <?php
                    echo esc_html(
                        $is_friendly
                            ? __('Une lecture simple de chaque projet: le besoin de depart, l approche choisie et ce que cela a change au final.', 'adeline-portfolio')
                            : __('Une presentation orientee etude de cas pour comprendre rapidement le contexte, les choix de conception et les resultats.', 'adeline-portfolio')
                    );
                    ?>
                </p>
                <div class="page-hero__chips" aria-label="Highlights realisations">
                    <span class="page-hero__chip"><?php esc_html_e('Contexte', 'adeline-portfolio'); ?></span>
                    <span class="page-hero__chip"><?php esc_html_e('Approche', 'adeline-portfolio'); ?></span>
                    <span class="page-hero__chip"><?php esc_html_e('Impact', 'adeline-portfolio'); ?></span>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($show_page_content && '' !== trim(wp_strip_all_tags(get_the_content()))) : ?>
        <section class="site-shell front-section page-content-section page-content-section--projects">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($show_case_studies) : ?>
    <section class="site-shell front-section page-content-section page-content-section--projects case-study-shell">
        <div class="front-section__heading">
            <p class="front-section__eyebrow"><?php esc_html_e('Portfolio', 'adeline-portfolio'); ?></p>
            <h2><?php esc_html_e('Case studies recents', 'adeline-portfolio'); ?></h2>
            <p>
                <?php
                echo esc_html(
                    $is_friendly
                        ? __('Chaque fiche montre ce qui a ete fait, pourquoi, et le benefice concret obtenu.', 'adeline-portfolio')
                        : __('Chaque fiche explique ce qui a ete fait, pourquoi cela a ete fait, et ce que cela a concretement ameliore.', 'adeline-portfolio')
                );
                ?>
            </p>
        </div>

        <?php if ($projects_query->have_posts()) : ?>
            <div class="front-grid front-grid--projects case-study-grid">
                <?php while ($projects_query->have_posts()) : $projects_query->the_post(); ?>
                    <?php $case_meta = adeline_portfolio_get_case_study_meta(get_the_ID()); ?>
                    <article <?php post_class('front-card front-card--project case-study-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a class="front-card__media" href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        <?php endif; ?>

                        <p class="front-card__kicker"><?php esc_html_e('Projet', 'adeline-portfolio'); ?></p>
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(wp_strip_all_tags(get_the_content()), 30)); ?></p>

                        <?php if ($show_case_meta) : ?>
                            <dl class="case-study-meta">
                                <div>
                                    <dt><?php esc_html_e('Contexte', 'adeline-portfolio'); ?></dt>
                                    <dd><?php echo esc_html($case_meta['context'] ?: __('Refonte ou evolution d un site existant avec un objectif clair de clarte, performance et coherence.', 'adeline-portfolio')); ?></dd>
                                </div>
                                <div>
                                    <dt><?php esc_html_e('Role', 'adeline-portfolio'); ?></dt>
                                    <dd><?php echo esc_html($case_meta['role'] ?: __('Conception, integration front-end, validation et accompagnement a la mise en ligne.', 'adeline-portfolio')); ?></dd>
                                </div>
                                <div>
                                    <dt><?php esc_html_e('Stack', 'adeline-portfolio'); ?></dt>
                                    <dd><?php echo esc_html($case_meta['stack'] ?: __('WordPress, PHP, CSS, Docker, GitHub Actions', 'adeline-portfolio')); ?></dd>
                                </div>
                                <div>
                                    <dt><?php esc_html_e('Impact', 'adeline-portfolio'); ?></dt>
                                    <dd><?php echo esc_html($case_meta['result'] ?: __('Experience plus lisible, deploiement fiable et meilleure autonomie de publication pour la suite.', 'adeline-portfolio')); ?></dd>
                                </div>
                                <div>
                                    <dt><?php esc_html_e('Duree', 'adeline-portfolio'); ?></dt>
                                    <dd><?php echo esc_html($case_meta['duration'] ?: __('Cycle iteratif court avec livraisons progressives et ajustements rapides.', 'adeline-portfolio')); ?></dd>
                                </div>
                            </dl>
                        <?php endif; ?>

                        <a class="front-card__link" href="<?php the_permalink(); ?>">
                            <?php esc_html_e('Voir l’etude de cas', 'adeline-portfolio'); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="front-section__footer">
                <a class="front-action front-action--secondary" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>">
                    <?php esc_html_e('Voir toutes les realisations', 'adeline-portfolio'); ?>
                </a>
            </div>
        <?php else : ?>
            <article class="front-card front-card--placeholder">
                <p class="front-card__kicker"><?php esc_html_e('Portfolio', 'adeline-portfolio'); ?></p>
                <h2><?php esc_html_e('Aucun projet publie pour le moment', 'adeline-portfolio'); ?></h2>
                <p><?php esc_html_e('Ajoute des projets pour alimenter automatiquement cette grille case study.', 'adeline-portfolio'); ?></p>
                <?php if (current_user_can('edit_posts')) : ?>
                    <a class="front-card__link" href="<?php echo esc_url(admin_url('post-new.php?post_type=project')); ?>">
                        <?php esc_html_e('Ajouter un projet', 'adeline-portfolio'); ?>
                    </a>
                <?php endif; ?>
            </article>
        <?php endif; ?>
    </section>
    <?php endif; ?>
    <?php

    wp_reset_postdata();
endwhile;

get_footer();
