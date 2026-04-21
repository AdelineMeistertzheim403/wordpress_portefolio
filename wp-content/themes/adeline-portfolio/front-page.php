<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
if (have_posts()) :
    while (have_posts()) :
        the_post();
        $home_builder_mode = adeline_portfolio_get_home_builder_mode();
        $render_elementor_content = 'theme' !== $home_builder_mode;
        $render_theme_sections = 'elementor' !== $home_builder_mode;
        $hero_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $hero_classes = 'front-hero site-shell';
        $intro_text = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 34);
        $has_page_content = '' !== trim(wp_strip_all_tags(get_the_content()));
        $edit_link = get_edit_post_link(get_the_ID(), '');
        $featured_pages = adeline_portfolio_get_featured_pages(3);
        $primary_page = adeline_portfolio_find_page_by_slugs(array('projets', 'projects', 'portfolio'));
        $contact_page = adeline_portfolio_find_page_by_slugs(array('contact', 'contactez-moi'));
        $projects_archive_link = get_post_type_archive_link('project');
        $home_projects = adeline_portfolio_get_home_projects(3);
        $project_placeholders = adeline_portfolio_get_project_placeholders();
        $recent_posts = get_posts(array(
            'numberposts' => 3,
            'post_status' => 'publish',
        ));
        $show_hero = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_hero', true);
        $show_editorial = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_editorial', true);
        $show_pages = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_pages', true);
        $show_projects = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_projects', true);
        $show_posts = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_posts', true);
        $show_cta = $render_theme_sections && adeline_portfolio_get_home_setting('show_home_cta', true);

        if (!$hero_image_url) {
            $hero_classes .= ' front-hero--no-media';
        }

        if ('theme' === $home_builder_mode && $has_page_content) :
            ?>
            <section class="site-shell front-panel content-block entry-content entry-content--home">
                <?php the_content(); ?>
            </section>
            <?php
        endif;

        if ($render_elementor_content && $has_page_content) :
            ?>
            <section class="site-shell content-block content-block--elementor">
                <?php the_content(); ?>
            </section>
            <?php
        elseif ($render_elementor_content && !$has_page_content) :
            ?>
            <section class="site-shell front-section front-elementor-starter">
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Elementor', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Base de depart prete a personnaliser', 'adeline-portfolio'); ?></h2>
                    <p><?php esc_html_e('Ajoute tes sections Elementor ici: Hero, Services, Projets et Contact. Le mode actuel te laisse composer librement sans sections imposees.', 'adeline-portfolio'); ?></p>
                </div>
                <div class="front-grid front-grid--editorial">
                    <article class="front-card front-card--placeholder">
                        <p class="front-card__kicker"><?php esc_html_e('Section 1', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Hero principal', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Ajoute un grand titre, une phrase d’accroche et deux boutons d’action.', 'adeline-portfolio'); ?></p>
                    </article>
                    <article class="front-card front-card--placeholder">
                        <p class="front-card__kicker"><?php esc_html_e('Section 2', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Services ou competences', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Utilise une section 2 ou 3 colonnes pour presenter tes expertises.', 'adeline-portfolio'); ?></p>
                    </article>
                    <article class="front-card front-card--placeholder">
                        <p class="front-card__kicker"><?php esc_html_e('Section 3', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Projets et contact', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Termine avec tes projets recents puis un appel a contact clair.', 'adeline-portfolio'); ?></p>
                    </article>
                </div>
                <?php if ($edit_link && current_user_can('edit_post', get_the_ID())) : ?>
                    <div class="front-section__footer">
                        <a class="front-action front-action--primary" href="<?php echo esc_url($edit_link); ?>">
                            <?php esc_html_e('Editer avec Elementor', 'adeline-portfolio'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </section>
            <?php
        endif;

        if (!$render_theme_sections) {
            continue;
        }
        ?>
        <?php if ($show_hero) : ?>
            <section class="<?php echo esc_attr($hero_classes); ?>">
                <?php if ($hero_image_url) : ?>
                    <div class="front-hero__media">
                        <img
                            src="<?php echo esc_url($hero_image_url); ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>"
                            class="front-hero__portrait"
                        >
                    </div>
                <?php endif; ?>

                <div class="front-hero__content">
                    <p class="front-kicker"><?php echo esc_html(get_bloginfo('description')); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <?php if ($intro_text) : ?>
                        <p class="front-intro"><?php echo esc_html($intro_text); ?></p>
                    <?php endif; ?>

                    <div class="front-actions">
                        <?php if ($primary_page) : ?>
                            <a class="front-action front-action--primary" href="<?php echo esc_url(get_permalink($primary_page)); ?>">
                                <?php echo esc_html(get_the_title($primary_page)); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($contact_page) : ?>
                            <a class="front-action front-action--secondary" href="<?php echo esc_url(get_permalink($contact_page)); ?>">
                                <?php esc_html_e('Me contacter', 'adeline-portfolio'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($show_editorial) : ?>
            <section class="site-shell front-section front-section--editorial">
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Positionnement', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Une page d’accueil claire, credible et facile a faire evoluer', 'adeline-portfolio'); ?></h2>
                    <p><?php esc_html_e('Cette structure te permet de presenter ton profil, tes projets et ton approche sans retomber dans une page unique confuse. Tu peux conserver ces textes comme base, puis les remplacer progressivement.', 'adeline-portfolio'); ?></p>
                </div>

                <div class="front-grid front-grid--editorial">
                    <article class="front-card">
                        <p class="front-card__kicker"><?php esc_html_e('Qui je suis', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Un portfolio centre sur la clarte', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Utilise cette carte pour te presenter en quelques lignes: ton profil, ton expertise principale et la valeur que tu apportes.', 'adeline-portfolio'); ?></p>
                    </article>
                    <article class="front-card">
                        <p class="front-card__kicker"><?php esc_html_e('Ce que je fais', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Design, integration et evolution continue', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Tu peux resumer ici tes services: conception de pages, personnalisation WordPress, refonte visuelle, optimisation du contenu et accompagnement technique.', 'adeline-portfolio'); ?></p>
                    </article>
                    <article class="front-card">
                        <p class="front-card__kicker"><?php esc_html_e('Comment je travaille', 'adeline-portfolio'); ?></p>
                        <h3><?php esc_html_e('Une base propre, puis des iterations simples', 'adeline-portfolio'); ?></h3>
                        <p><?php esc_html_e('Cette troisieme carte peut expliquer ta methode: audit, maquette, implementation, tests, mise en ligne et autonomie de gestion du contenu.', 'adeline-portfolio'); ?></p>
                    </article>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($show_pages && !empty($featured_pages)) : ?>
            <section class="site-shell front-section front-section--cards">
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Navigation rapide', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Des sections claires pour guider la visite', 'adeline-portfolio'); ?></h2>
                </div>

                <div class="front-grid front-grid--pages">
                    <?php foreach ($featured_pages as $page) : ?>
                        <article class="front-card">
                            <p class="front-card__kicker"><?php esc_html_e('Page', 'adeline-portfolio'); ?></p>
                            <h3><?php echo esc_html(get_the_title($page)); ?></h3>
                            <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_post_field('post_content', $page->ID)), 24)); ?></p>
                            <a class="front-card__link" href="<?php echo esc_url(get_permalink($page)); ?>">
                                <?php esc_html_e('Ouvrir la section', 'adeline-portfolio'); ?>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($show_projects) : ?>
            <section class="site-shell front-section">
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Portfolio', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Projets a mettre en avant', 'adeline-portfolio'); ?></h2>
                    <p><?php esc_html_e('Cette section utilise maintenant le type de contenu Projet. Tu peux ajouter des fiches dans l’admin pour alimenter automatiquement la grille.', 'adeline-portfolio'); ?></p>
                </div>

                <div class="front-grid front-grid--projects">
                    <?php if (!empty($home_projects)) : ?>
                        <?php foreach ($home_projects as $project) : ?>
                            <article class="front-card front-card--project">
                                <?php if (has_post_thumbnail($project)) : ?>
                                    <a class="front-card__media" href="<?php echo esc_url(get_permalink($project)); ?>">
                                        <?php echo get_the_post_thumbnail($project, 'large'); ?>
                                    </a>
                                <?php endif; ?>
                                <p class="front-card__kicker"><?php esc_html_e('Projet', 'adeline-portfolio'); ?></p>
                                <h3><?php echo esc_html(get_the_title($project)); ?></h3>
                                <p><?php echo esc_html(get_the_excerpt($project) ?: wp_trim_words(wp_strip_all_tags(get_post_field('post_content', $project->ID)), 26)); ?></p>
                                <a class="front-card__link" href="<?php echo esc_url(get_permalink($project)); ?>">
                                    <?php esc_html_e('Voir le projet', 'adeline-portfolio'); ?>
                                </a>
                            </article>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?php foreach ($project_placeholders as $placeholder) : ?>
                            <article class="front-card front-card--project front-card--placeholder">
                                <p class="front-card__kicker"><?php esc_html_e('Projet exemple', 'adeline-portfolio'); ?></p>
                                <h3><?php echo esc_html($placeholder['title']); ?></h3>
                                <p><?php echo esc_html($placeholder['excerpt']); ?></p>
                                <?php if (current_user_can('edit_posts')) : ?>
                                    <a class="front-card__link" href="<?php echo esc_url(admin_url('post-new.php?post_type=project')); ?>">
                                        <?php esc_html_e('Ajouter un premier projet', 'adeline-portfolio'); ?>
                                    </a>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if ($projects_archive_link) : ?>
                    <div class="front-section__footer">
                        <a class="front-action front-action--secondary" href="<?php echo esc_url($projects_archive_link); ?>">
                            <?php esc_html_e('Parcourir tous les projets', 'adeline-portfolio'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <?php if ($show_posts && !empty($recent_posts)) : ?>
            <section class="site-shell front-section">
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Actualites', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Derniers contenus publies', 'adeline-portfolio'); ?></h2>
                </div>

                <div class="front-grid front-grid--posts">
                    <?php foreach ($recent_posts as $post) : ?>
                        <article class="front-card front-card--post">
                            <p class="front-card__meta"><?php echo esc_html(get_the_date('', $post)); ?></p>
                            <h3><?php echo esc_html(get_the_title($post)); ?></h3>
                            <p><?php echo esc_html(get_the_excerpt($post)); ?></p>
                            <a class="front-card__link" href="<?php echo esc_url(get_permalink($post)); ?>">
                                <?php esc_html_e('Lire la suite', 'adeline-portfolio'); ?>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($show_cta) : ?>
            <section class="site-shell front-section front-cta">
                <div class="front-cta__content">
                    <p class="front-section__eyebrow"><?php esc_html_e('Construire la suite', 'adeline-portfolio'); ?></p>
                    <h2><?php esc_html_e('Tu peux maintenant composer ton accueil en blocs et garder une base solide', 'adeline-portfolio'); ?></h2>
                    <p><?php esc_html_e('Ajoute des groupes, des colonnes et des sections pleine largeur dans le contenu de la page d’accueil. Le theme se charge du rendu global et des sections de soutien.', 'adeline-portfolio'); ?></p>
                </div>
                <div class="front-actions front-actions--stacked">
                    <?php if ($primary_page) : ?>
                        <a class="front-action front-action--primary" href="<?php echo esc_url(get_permalink($primary_page)); ?>">
                            <?php esc_html_e('Voir les projets', 'adeline-portfolio'); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($contact_page) : ?>
                        <a class="front-action front-action--secondary" href="<?php echo esc_url(get_permalink($contact_page)); ?>">
                            <?php esc_html_e('Parler de votre besoin', 'adeline-portfolio'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>
        <?php
    endwhile;
else :
    ?>
    <section class="site-shell content-block">
        <p><?php esc_html_e('No content found.', 'adeline-portfolio'); ?></p>
    </section>
    <?php
endif;
get_footer();
