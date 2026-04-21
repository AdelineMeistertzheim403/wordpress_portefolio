<?php
/**
 * Template Name: Contact - Portfolio
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();
    $show_hero = adeline_portfolio_is_section_visible(get_the_ID(), 'show_hero', true);
    $show_page_content = adeline_portfolio_is_section_visible(get_the_ID(), 'show_page_content', true);
    $show_form = adeline_portfolio_is_section_visible(get_the_ID(), 'show_form', true);
    $show_sidebar = adeline_portfolio_is_section_visible(get_the_ID(), 'show_sidebar', true);
    $is_friendly = adeline_portfolio_is_friendly_tone();
    $intro_default = $is_friendly
        ? __('Parlons de ton projet simplement, puis construisons ensemble une feuille de route claire.', 'adeline-portfolio')
        : __('Parlons de ton projet, de tes priorites et de la meilleure facon de passer a l action.', 'adeline-portfolio');
    $intro = get_theme_mod('contact_intro', $intro_default);
    $response_time = get_theme_mod('contact_response_time', __('Reponse sous 24 a 48h ouvrées', 'adeline-portfolio'));
    $form_shortcode = trim((string) get_theme_mod('contact_form_shortcode', ''));
    $has_content = '' !== trim(wp_strip_all_tags(get_the_content()));
    $admin_email = get_bloginfo('admin_email');
    ?>
    <?php if ($show_hero) : ?>
        <section class="site-shell page-hero page-hero--contact">
            <div class="page-hero__content">
                <p class="front-section__eyebrow"><?php esc_html_e('Me contacter', 'adeline-portfolio'); ?></p>
                <h1><?php the_title(); ?></h1>
                <p><?php echo esc_html($intro); ?></p>
                <div class="page-hero__chips" aria-label="Informations contact">
                    <span class="page-hero__chip"><?php echo esc_html($response_time); ?></span>
                    <span class="page-hero__chip"><?php esc_html_e('Brief projet recommande', 'adeline-portfolio'); ?></span>
                    <span class="page-hero__chip">
                        <?php echo esc_html($is_friendly ? __('Plan d action simple et concret', 'adeline-portfolio') : __('Cadrage clair des prochaines etapes', 'adeline-portfolio')); ?>
                    </span>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="site-shell front-section page-content-section page-content-section--contact contact-layout<?php echo $show_sidebar ? '' : ' contact-layout--single'; ?>">
        <div class="contact-layout__content">
            <?php if ($show_page_content && $has_content) : ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php elseif ($show_page_content) : ?>
                <article class="front-card front-card--placeholder">
                    <p class="front-card__kicker"><?php esc_html_e('Brief recommande', 'adeline-portfolio'); ?></p>
                    <h2><?php echo esc_html($is_friendly ? __('Les infos utiles pour bien demarrer', 'adeline-portfolio') : __('Informations utiles pour bien demarrer', 'adeline-portfolio')); ?></h2>
                    <p><?php echo esc_html($is_friendly ? __('En quelques lignes: ton objectif, ton contexte et ton resultat attendu. Je m occupe de clarifier la suite.', 'adeline-portfolio') : __('En quelques lignes: ton objectif, le contexte actuel, les contraintes importantes et le resultat attendu.', 'adeline-portfolio')); ?></p>
                </article>
            <?php endif; ?>

            <?php if ($show_form) : ?>
                <div class="contact-form-shell">
                    <?php if ($form_shortcode) : ?>
                        <?php echo do_shortcode($form_shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php else : ?>
                        <article class="front-card front-card--placeholder">
                            <p class="front-card__kicker"><?php esc_html_e('Formulaire', 'adeline-portfolio'); ?></p>
                            <h2><?php echo esc_html($is_friendly ? __('Branche ton formulaire en une minute', 'adeline-portfolio') : __('Connecte ton formulaire en une minute', 'adeline-portfolio')); ?></h2>
                            <p><?php esc_html_e('Renseigne le shortcode dans Apparence > Personnaliser > Contact pour afficher ici ton formulaire de prise de contact.', 'adeline-portfolio'); ?></p>
                        </article>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($show_sidebar) : ?>
            <aside class="contact-layout__sidebar">
                <article class="front-card">
                    <p class="front-card__kicker"><?php esc_html_e('Email', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Contact direct', 'adeline-portfolio'); ?></h2>
                    <p><a href="mailto:<?php echo esc_attr($admin_email); ?>"><?php echo esc_html($admin_email); ?></a></p>
                </article>

                <article class="front-card">
                    <p class="front-card__kicker"><?php esc_html_e('Process', 'adeline-portfolio'); ?></p>
                    <h2><?php echo esc_html($is_friendly ? __('Comment on avance ensemble', 'adeline-portfolio') : __('Comment se deroule la collaboration', 'adeline-portfolio')); ?></h2>
                    <p><?php esc_html_e('1. Echange initial pour cadrer le besoin', 'adeline-portfolio'); ?></p>
                    <p><?php esc_html_e('2. Proposition de plan d action priorise', 'adeline-portfolio'); ?></p>
                    <p><?php esc_html_e('3. Production, validations et ajustements', 'adeline-portfolio'); ?></p>
                </article>

                <article class="front-card">
                    <p class="front-card__kicker"><?php esc_html_e('Delai', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Temps de reponse', 'adeline-portfolio'); ?></h2>
                    <p><?php echo esc_html($response_time); ?></p>
                </article>
            </aside>
        <?php endif; ?>
    </section>
    <?php
endwhile;

get_footer();
