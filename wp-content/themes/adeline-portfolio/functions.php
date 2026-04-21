<?php

if (!defined('ABSPATH')) {
    exit;
}

function adeline_portfolio_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    add_editor_style('assets/css/editor.css');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'adeline-portfolio'),
        'footer' => __('Footer Menu', 'adeline-portfolio'),
    ));
}
add_action('after_setup_theme', 'adeline_portfolio_setup');

function adeline_portfolio_register_block_customizations() {
    register_block_pattern_category(
        'adeline-portfolio',
        array('label' => __('Adeline Portfolio', 'adeline-portfolio'))
    );

    register_block_style(
        'core/group',
        array(
            'name'  => 'glass-section',
            'label' => __('Section vitree', 'adeline-portfolio'),
        )
    );

    register_block_style(
        'core/columns',
        array(
            'name'  => 'portfolio-columns',
            'label' => __('Colonnes portfolio', 'adeline-portfolio'),
        )
    );

    register_block_style(
        'core/heading',
        array(
            'name'  => 'section-heading',
            'label' => __('Titre de section', 'adeline-portfolio'),
        )
    );
}
add_action('init', 'adeline_portfolio_register_block_customizations');

function adeline_portfolio_register_post_types() {
    register_post_type(
        'project',
        array(
            'labels' => array(
                'name'               => __('Projets', 'adeline-portfolio'),
                'singular_name'      => __('Projet', 'adeline-portfolio'),
                'menu_name'          => __('Projets', 'adeline-portfolio'),
                'name_admin_bar'     => __('Projet', 'adeline-portfolio'),
                'add_new'            => __('Ajouter', 'adeline-portfolio'),
                'add_new_item'       => __('Ajouter un projet', 'adeline-portfolio'),
                'new_item'           => __('Nouveau projet', 'adeline-portfolio'),
                'edit_item'          => __('Modifier le projet', 'adeline-portfolio'),
                'view_item'          => __('Voir le projet', 'adeline-portfolio'),
                'all_items'          => __('Tous les projets', 'adeline-portfolio'),
                'search_items'       => __('Rechercher des projets', 'adeline-portfolio'),
                'not_found'          => __('Aucun projet trouve.', 'adeline-portfolio'),
                'not_found_in_trash' => __('Aucun projet dans la corbeille.', 'adeline-portfolio'),
            ),
            'public'             => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-portfolio',
            'has_archive'        => true,
            'rewrite'            => array('slug' => 'projets'),
            'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
            'menu_position'      => 21,
            'publicly_queryable' => true,
        )
    );
}
add_action('init', 'adeline_portfolio_register_post_types');

function adeline_portfolio_flush_rewrite_rules() {
    adeline_portfolio_register_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'adeline_portfolio_flush_rewrite_rules');

function adeline_portfolio_maybe_flush_rewrite_rules() {
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    $stored_version = get_option('adeline_portfolio_theme_version');

    if ($stored_version === $version) {
        return;
    }

    flush_rewrite_rules();
    update_option('adeline_portfolio_theme_version', $version);
}
add_action('init', 'adeline_portfolio_maybe_flush_rewrite_rules', 20);

function adeline_portfolio_primary_menu_fallback() {
    $projects_link = post_type_exists('project') ? get_post_type_archive_link('project') : home_url('/projets/');

    echo '<ul class="site-nav__list">';
    echo '<li class="menu-item"><a class="site-nav__link" href="' . esc_url(home_url('/')) . '">Accueil</a></li>';
    echo '<li class="menu-item"><a class="site-nav__link" href="' . esc_url($projects_link) . '">Projets</a></li>';
    echo '</ul>';
}

function adeline_portfolio_primary_menu_link_class($atts, $item, $args) {
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        $existing = isset($atts['class']) ? $atts['class'] . ' ' : '';
        $atts['class'] = $existing . 'site-nav__link';
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'adeline_portfolio_primary_menu_link_class', 10, 3);

function adeline_portfolio_enqueue_assets() {
    wp_enqueue_style(
        'adeline-portfolio-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'adeline-portfolio-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'adeline_portfolio_enqueue_assets');

function adeline_portfolio_find_page_by_slugs($slugs) {
    foreach ($slugs as $slug) {
        $page = get_page_by_path($slug);

        if ($page instanceof WP_Post && 'publish' === $page->post_status) {
            return $page;
        }
    }

    return null;
}

function adeline_portfolio_get_featured_pages($limit = 3) {
    $front_page_id = (int) get_option('page_on_front');
    $featured_pages = array();
    $priority_groups = array(
        array('projets', 'projects', 'portfolio'),
        array('a-propos', 'about', 'presentation'),
        array('contact', 'contactez-moi'),
        array('services', 'prestations', 'expertises'),
    );

    foreach ($priority_groups as $group) {
        $page = adeline_portfolio_find_page_by_slugs($group);

        if (!$page || $page->ID === $front_page_id || isset($featured_pages[$page->ID])) {
            continue;
        }

        $featured_pages[$page->ID] = $page;

        if (count($featured_pages) >= $limit) {
            return array_values($featured_pages);
        }
    }

    $fallback_pages = get_pages(array(
        'sort_column' => 'menu_order,post_title',
        'parent'      => 0,
        'exclude'     => array($front_page_id),
        'number'      => $limit * 2,
    ));

    foreach ($fallback_pages as $page) {
        if (isset($featured_pages[$page->ID])) {
            continue;
        }

        $featured_pages[$page->ID] = $page;

        if (count($featured_pages) >= $limit) {
            break;
        }
    }

    return array_values($featured_pages);
}

function adeline_portfolio_get_home_projects($limit = 3) {
    return get_posts(array(
        'post_type'      => 'project',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    ));
}

function adeline_portfolio_get_project_placeholders() {
    return array(
        array(
            'title'   => __('Refonte de site vitrine', 'adeline-portfolio'),
            'excerpt' => __('Presente ici un projet de refonte avec objectif, choix UX, contraintes techniques et resultat obtenu.', 'adeline-portfolio'),
        ),
        array(
            'title'   => __('Developpement de theme WordPress', 'adeline-portfolio'),
            'excerpt' => __('Tu peux mettre en avant ton travail sur mesure: structure de page, performances, flexiblite editoriale et design system.', 'adeline-portfolio'),
        ),
        array(
            'title'   => __('Migration et modernisation', 'adeline-portfolio'),
            'excerpt' => __('Utilise une troisieme carte pour montrer ta capacite a reprendre un existant, fiabiliser et faire evoluer un projet.', 'adeline-portfolio'),
        ),
    );
}

function adeline_portfolio_get_home_setting($name, $default = false) {
    return (bool) get_theme_mod($name, $default);
}

function adeline_portfolio_get_archive_setting($name, $default = true) {
    return (bool) get_theme_mod($name, $default);
}

function adeline_portfolio_get_visibility_fields() {
    return array(
        'show_hero' => __('Afficher le hero', 'adeline-portfolio'),
        'show_page_content' => __('Afficher le contenu principal', 'adeline-portfolio'),
        'show_featured_image' => __('Afficher l image mise en avant', 'adeline-portfolio'),
        'show_contextual_blocks' => __('Afficher les blocs contextuels', 'adeline-portfolio'),
        'show_entry_navigation' => __('Afficher la navigation precedent/suivant', 'adeline-portfolio'),
        'show_form' => __('Afficher le formulaire', 'adeline-portfolio'),
        'show_sidebar' => __('Afficher la colonne d informations', 'adeline-portfolio'),
        'show_case_studies' => __('Afficher la grille case studies', 'adeline-portfolio'),
        'show_case_meta' => __('Afficher les metadonnees case study', 'adeline-portfolio'),
        'show_back_link' => __('Afficher le lien retour', 'adeline-portfolio'),
    );
}

function adeline_portfolio_get_visibility_presets($post_type) {
    $all_true = array();

    foreach (array_keys(adeline_portfolio_get_visibility_fields()) as $field) {
        $all_true[$field] = true;
    }

    $presets = array(
        'custom' => array(
            'label' => __('Personnalise', 'adeline-portfolio'),
            'values' => $all_true,
        ),
    );

    if ('page' === $post_type) {
        $presets['cv_focus'] = array(
            'label' => __('Preset CV focalise', 'adeline-portfolio'),
            'values' => array_merge($all_true, array(
                'show_featured_image' => false,
                'show_contextual_blocks' => true,
                'show_case_studies' => false,
            )),
        );

        $presets['contact_minimal'] = array(
            'label' => __('Preset Contact minimal', 'adeline-portfolio'),
            'values' => array_merge($all_true, array(
                'show_page_content' => false,
                'show_sidebar' => false,
                'show_contextual_blocks' => false,
                'show_case_studies' => false,
                'show_featured_image' => false,
            )),
        );

        $presets['realisations_showcase'] = array(
            'label' => __('Preset Realisations showcase', 'adeline-portfolio'),
            'values' => array_merge($all_true, array(
                'show_page_content' => true,
                'show_case_studies' => true,
                'show_case_meta' => true,
                'show_contextual_blocks' => false,
                'show_form' => false,
            )),
        );
    }

    if ('post' === $post_type) {
        $presets['article_longform'] = array(
            'label' => __('Preset Article long-form', 'adeline-portfolio'),
            'values' => array_merge($all_true, array(
                'show_hero' => true,
                'show_featured_image' => true,
                'show_entry_navigation' => true,
                'show_contextual_blocks' => false,
                'show_form' => false,
                'show_sidebar' => false,
                'show_case_studies' => false,
            )),
        );
    }

    if ('project' === $post_type) {
        $presets['project_case_study'] = array(
            'label' => __('Preset Projet etude de cas', 'adeline-portfolio'),
            'values' => array_merge($all_true, array(
                'show_hero' => true,
                'show_page_content' => true,
                'show_featured_image' => true,
                'show_back_link' => true,
                'show_contextual_blocks' => false,
                'show_form' => false,
                'show_sidebar' => false,
            )),
        );
    }

    return $presets;
}

function adeline_portfolio_is_section_visible($post_id, $section, $default = true) {
    $visibility = get_post_meta($post_id, '_adeline_visibility', true);

    if (!is_array($visibility) || !array_key_exists($section, $visibility)) {
        return (bool) $default;
    }

    return (bool) $visibility[$section];
}

function adeline_portfolio_add_visibility_meta_box() {
    foreach (array('page', 'post', 'project') as $post_type) {
        add_meta_box(
            'adeline_portfolio_visibility',
            __('Affichage de la page', 'adeline-portfolio'),
            'adeline_portfolio_render_visibility_meta_box',
            $post_type,
            'side',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'adeline_portfolio_add_visibility_meta_box');

function adeline_portfolio_render_visibility_meta_box($post) {
    $fields = adeline_portfolio_get_visibility_fields();
    $values = get_post_meta($post->ID, '_adeline_visibility', true);
    $stored_preset = get_post_meta($post->ID, '_adeline_visibility_preset', true);
    $presets = adeline_portfolio_get_visibility_presets($post->post_type);

    if (!is_array($values)) {
        $values = array();
    }

    wp_nonce_field('adeline_portfolio_save_visibility', 'adeline_portfolio_visibility_nonce');

    echo '<p><label for="adeline-visibility-preset"><strong>' . esc_html__('Preset', 'adeline-portfolio') . '</strong></label></p>';
    echo '<select id="adeline-visibility-preset" name="adeline_visibility_preset" style="width:100%; margin-bottom:10px;">';

    foreach ($presets as $preset_key => $preset) {
        $selected = selected($stored_preset ? $stored_preset : 'custom', $preset_key, false);
        echo '<option value="' . esc_attr($preset_key) . '" ' . $selected . '>' . esc_html($preset['label']) . '</option>';
    }

    echo '</select>';
    echo '<p>' . esc_html__('Decoche les elements que tu veux masquer sur cette page.', 'adeline-portfolio') . '</p>';

    foreach ($fields as $field => $label) {
        $checked = array_key_exists($field, $values) ? (bool) $values[$field] : true;
        echo '<p><label>';
        echo '<input type="checkbox" name="adeline_visibility[' . esc_attr($field) . ']" value="1" ' . checked($checked, true, false) . ' /> ';
        echo esc_html($label);
        echo '</label></p>';
    }
}

function adeline_portfolio_save_visibility_meta_box($post_id) {
    if (!isset($_POST['adeline_portfolio_visibility_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['adeline_portfolio_visibility_nonce'])), 'adeline_portfolio_save_visibility')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = adeline_portfolio_get_visibility_fields();
    $post_type = get_post_type($post_id);
    $presets = adeline_portfolio_get_visibility_presets($post_type);
    $preset_key = isset($_POST['adeline_visibility_preset']) ? sanitize_text_field(wp_unslash($_POST['adeline_visibility_preset'])) : 'custom';

    if (!isset($presets[$preset_key])) {
        $preset_key = 'custom';
    }

    update_post_meta($post_id, '_adeline_visibility_preset', $preset_key);

    if ('custom' !== $preset_key) {
        update_post_meta($post_id, '_adeline_visibility', $presets[$preset_key]['values']);
        return;
    }

    $incoming = isset($_POST['adeline_visibility']) && is_array($_POST['adeline_visibility'])
        ? wp_unslash($_POST['adeline_visibility'])
        : array();
    $sanitized = array();

    foreach ($fields as $field => $label) {
        $sanitized[$field] = isset($incoming[$field]) && '1' === (string) $incoming[$field];
    }

    update_post_meta($post_id, '_adeline_visibility', $sanitized);
}
add_action('save_post', 'adeline_portfolio_save_visibility_meta_box');

function adeline_portfolio_sanitize_editorial_tone($value) {
    $allowed = array('premium', 'friendly');

    if (in_array($value, $allowed, true)) {
        return $value;
    }

    return 'premium';
}

function adeline_portfolio_get_editorial_tone() {
    $tone = get_theme_mod('editorial_tone', 'premium');

    return adeline_portfolio_sanitize_editorial_tone($tone);
}

function adeline_portfolio_is_friendly_tone() {
    return 'friendly' === adeline_portfolio_get_editorial_tone();
}

function adeline_portfolio_get_page_variant_data($post_id) {
    $post = get_post($post_id);
    $is_friendly = adeline_portfolio_is_friendly_tone();

    if (!$post instanceof WP_Post) {
        return array(
            'key'      => 'default',
            'eyebrow'  => __('Page', 'adeline-portfolio'),
            'subtitle' => __('Une page claire et elegante, sur la meme base visuelle que le reste du portfolio.', 'adeline-portfolio'),
            'highlights' => array(),
        );
    }

    $slug = $post->post_name;
    $variants = array(
        'cv' => array(
            'slugs' => array('mon-cv', 'cv', 'resume'),
            'eyebrow' => __('Mon CV', 'adeline-portfolio'),
            'subtitle' => $is_friendly
                ? __('Mon parcours, mes competences et ma facon de travailler, presentes de maniere simple et concrete.', 'adeline-portfolio')
                : __('Un parcours structure, des competences concretes et une vision claire de la valeur que j apporte sur un projet web.', 'adeline-portfolio'),
            'highlights' => array(__('Parcours', 'adeline-portfolio'), __('Competences', 'adeline-portfolio'), __('Objectif pro', 'adeline-portfolio')),
        ),
        'projects' => array(
            'slugs' => array('mes-realisations', 'realisations', 'portfolio', 'projects'),
            'eyebrow' => __('Mes realisations', 'adeline-portfolio'),
            'subtitle' => $is_friendly
                ? __('Des projets presentes comme des histoires claires: besoin de depart, approche choisie et resultat concret.', 'adeline-portfolio')
                : __('Chaque projet est presente comme une etude de cas: besoin de depart, choix de conception et resultat obtenu.', 'adeline-portfolio'),
            'highlights' => array(__('Etude de cas', 'adeline-portfolio'), __('Execution', 'adeline-portfolio'), __('Impact', 'adeline-portfolio')),
        ),
        'articles' => array(
            'slugs' => array('articles-techniques', 'articles', 'blog'),
            'eyebrow' => __('Articles techniques', 'adeline-portfolio'),
            'subtitle' => $is_friendly
                ? __('Je partage ici des retours terrain et des solutions pratiques que tu peux appliquer facilement.', 'adeline-portfolio')
                : __('Des articles utiles, concrets et actionnables pour partager mes methodes, mes tests et mes retours terrain.', 'adeline-portfolio'),
            'highlights' => array(__('Guides', 'adeline-portfolio'), __('Retours terrain', 'adeline-portfolio'), __('Bonnes pratiques', 'adeline-portfolio')),
        ),
        'contact' => array(
            'slugs' => array('me-contacter', 'contact', 'contactez-moi'),
            'eyebrow' => __('Me contacter', 'adeline-portfolio'),
            'subtitle' => $is_friendly
                ? __('Tu as une idee ou un besoin precis ? Parlons-en simplement pour definir la meilleure suite.', 'adeline-portfolio')
                : __('Tu as un besoin de refonte, de personnalisation WordPress ou de modernisation ? Echangeons simplement pour cadrer la suite.', 'adeline-portfolio'),
            'highlights' => array(__('Brief clair', 'adeline-portfolio'), __('Delais realistes', 'adeline-portfolio'), __('Reponse rapide', 'adeline-portfolio')),
        ),
    );

    foreach ($variants as $key => $variant) {
        if (in_array($slug, $variant['slugs'], true)) {
            return array(
                'key'        => $key,
                'eyebrow'    => $variant['eyebrow'],
                'subtitle'   => $variant['subtitle'],
                'highlights' => $variant['highlights'],
            );
        }
    }

    return array(
        'key'      => 'default',
        'eyebrow'  => __('Page', 'adeline-portfolio'),
        'subtitle' => __('Une page claire et elegante, sur la meme base visuelle que le reste du portfolio.', 'adeline-portfolio'),
        'highlights' => array(),
    );
}

function adeline_portfolio_get_key_page_blocks($variant_key) {
    $is_friendly = adeline_portfolio_is_friendly_tone();

    $blocks = array(
        'cv' => array(
            array(
                'title' => __('Experience recente', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je presente ici les missions les plus parlantes, avec les objectifs de depart et les resultats obtenus.', 'adeline-portfolio')
                    : __('Je mets en avant les missions qui ont le plus d impact: objectifs, responsabilites, et resultats visibles pour l equipe ou le client.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Competences clees', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Mes competences sont regroupees par themes pour que tu voies rapidement ce que je peux apporter.', 'adeline-portfolio')
                    : __('Mes competences sont organisees par domaines: conception web, WordPress, integration front-end, qualite et deploiement.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Cap sur la suite', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je partage aussi le type de projet qui me motive: utile, bien cadre et concret a mettre en oeuvre.', 'adeline-portfolio')
                    : __('Je precise le type de projet que je recherche: des missions utiles, ambitieuses et bien cadrees, avec un vrai enjeu produit.', 'adeline-portfolio'),
            ),
        ),
        'projects' => array(
            array(
                'title' => __('Contexte', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Chaque realisation part d un besoin tres concret: clarte, modernisation, performance ou fiabilite.', 'adeline-portfolio')
                    : __('Chaque realisation part d un besoin concret: clarifier l offre, moderniser l interface, fiabiliser le deploiement ou gagner en performance.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Solution', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je decris simplement l approche choisie: structure, design, outils et decisions techniques importantes.', 'adeline-portfolio')
                    : __('Je presente l approche retenue: architecture, design system, structure des contenus, outils et arbitrages techniques.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Impact', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je termine avec ce qui change vraiment: meilleure experience, plus de clarte et plus d autonomie au quotidien.', 'adeline-portfolio')
                    : __('Le resultat est mesure avec des indicateurs lisibles: experience utilisateur, clarte editoriale, autonomie de publication et robustesse.', 'adeline-portfolio'),
            ),
        ),
        'articles' => array(
            array(
                'title' => __('Pourquoi cet article', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Chaque article repond a une question que je rencontre en vrai, avec une solution directement testable.', 'adeline-portfolio')
                    : __('Chaque publication repond a une question reelle de production ou de maintenance, avec une reponse directement exploitable.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Structure recommandee', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je garde une structure simple: contexte, solution, etapes, pieges a eviter et check-list finale.', 'adeline-portfolio')
                    : __('Je garde un format constant: contexte, solution, etapes, pieges frequents puis une check-list actionnable.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Ce que tu peux appliquer', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Le but est que tu repartes avec des exemples concrets et des actions utiles des aujourd hui.', 'adeline-portfolio')
                    : __('L objectif est simple: fournir des exemples concrets, des commandes reutilisables et des decisions justifiees.', 'adeline-portfolio'),
            ),
        ),
        'contact' => array(
            array(
                'title' => __('Parlons de ton besoin', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Refonte, theme WordPress, optimisation ou accompagnement: je t aide a y voir clair rapidement.', 'adeline-portfolio')
                    : __('Refonte, creation de theme, optimisation technique ou accompagnement continu: je t aide a prioriser les prochaines actions.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Un brief simple suffit', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Donne-moi ton objectif, ton contexte et ton delai ideal: je te reponds avec une proposition claire.', 'adeline-portfolio')
                    : __('Partage ton objectif, ton contexte, ton delai ideal et les contraintes principales pour obtenir une reponse pertinente.', 'adeline-portfolio'),
            ),
            array(
                'title' => __('Un retour rapide et clair', 'adeline-portfolio'),
                'text'  => $is_friendly
                    ? __('Je te fais un retour rapide avec les options les plus adaptees a ta situation.', 'adeline-portfolio')
                    : __('Je reviens vers toi avec une premiere proposition de cadrage et les options les plus adaptees a ta situation.', 'adeline-portfolio'),
            ),
        ),
    );

    if (!isset($blocks[$variant_key])) {
        return array();
    }

    return $blocks[$variant_key];
}

function adeline_portfolio_get_case_study_meta($project_id) {
    $meta_map = array(
        'context'  => get_post_meta($project_id, 'project_context', true),
        'stack'    => get_post_meta($project_id, 'project_stack', true),
        'result'   => get_post_meta($project_id, 'project_result', true),
        'duration' => get_post_meta($project_id, 'project_duration', true),
        'role'     => get_post_meta($project_id, 'project_role', true),
    );

    return array_map('wp_strip_all_tags', $meta_map);
}

function adeline_portfolio_sanitize_checkbox($checked) {
    return (bool) $checked;
}

function adeline_portfolio_sanitize_url($value) {
    return esc_url_raw($value);
}

function adeline_portfolio_sanitize_image_url($value) {
    return esc_url_raw($value);
}

function adeline_portfolio_sanitize_banner_mode($value) {
    $allowed = array('compact', 'full', 'edge');

    if (in_array($value, $allowed, true)) {
        return $value;
    }

    return 'compact';
}

function adeline_portfolio_output_customizer_css() {
    $accent = get_theme_mod('theme_color_accent', '#60a5fa');
    $accent_alt = get_theme_mod('theme_color_accent_alt', '#22d3ee');
    $text_body = get_theme_mod('theme_color_text_body', '#cbd5e1');
    $text_strong = get_theme_mod('theme_color_text_strong', '#e2e8f0');
    $bg_start = get_theme_mod('theme_color_bg_start', '#020617');
    $bg_end = get_theme_mod('theme_color_bg_end', '#0f172a');
    $banner_bg = get_theme_mod('header_banner_bg_color', '#0f172a');
    $banner_text = get_theme_mod('header_banner_text_color', '#e2e8f0');

    $values = array(
        '--accent' => sanitize_hex_color($accent) ?: '#60a5fa',
        '--accent-alt' => sanitize_hex_color($accent_alt) ?: '#22d3ee',
        '--text-body' => sanitize_hex_color($text_body) ?: '#cbd5e1',
        '--text-strong' => sanitize_hex_color($text_strong) ?: '#e2e8f0',
        '--bg-start' => sanitize_hex_color($bg_start) ?: '#020617',
        '--bg-end' => sanitize_hex_color($bg_end) ?: '#0f172a',
        '--banner-bg' => sanitize_hex_color($banner_bg) ?: '#0f172a',
        '--banner-text' => sanitize_hex_color($banner_text) ?: '#e2e8f0',
    );

    $css = ':root {';
    foreach ($values as $variable => $value) {
        $css .= $variable . ':' . $value . ';';
    }
    $css .= '}';

    echo '<style id="adeline-portfolio-customizer">' . esc_html($css) . '</style>';
}
add_action('wp_head', 'adeline_portfolio_output_customizer_css', 30);

function adeline_portfolio_sanitize_home_builder_mode($value) {
    $allowed = array('theme', 'elementor', 'hybrid');

    if (in_array($value, $allowed, true)) {
        return $value;
    }

    return 'hybrid';
}

function adeline_portfolio_get_home_builder_mode() {
    $mode = get_theme_mod('home_builder_mode', 'hybrid');

    return adeline_portfolio_sanitize_home_builder_mode($mode);
}

function adeline_portfolio_customize_register($wp_customize) {
    $wp_customize->add_section(
        'adeline_portfolio_appearance',
        array(
            'title'    => __('Banniere et couleurs', 'adeline-portfolio'),
            'priority' => 33,
        )
    );

    $wp_customize->add_setting(
        'show_header_banner',
        array(
            'default'           => false,
            'sanitize_callback' => 'adeline_portfolio_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'show_header_banner',
        array(
            'type'    => 'checkbox',
            'section' => 'adeline_portfolio_appearance',
            'label'   => __('Afficher la banniere du header', 'adeline-portfolio'),
        )
    );

    $wp_customize->add_setting(
        'header_banner_text',
        array(
            'default'           => __('Bienvenue sur mon portfolio', 'adeline-portfolio'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'header_banner_text',
        array(
            'type'    => 'text',
            'section' => 'adeline_portfolio_appearance',
            'label'   => __('Texte de la banniere', 'adeline-portfolio'),
        )
    );

    $wp_customize->add_setting(
        'header_banner_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'adeline_portfolio_sanitize_url',
        )
    );

    $wp_customize->add_setting(
        'header_banner_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'adeline_portfolio_sanitize_image_url',
        )
    );

    $wp_customize->add_setting(
        'header_banner_mode',
        array(
            'default'           => 'compact',
            'sanitize_callback' => 'adeline_portfolio_sanitize_banner_mode',
        )
    );

    $wp_customize->add_control(
        'header_banner_mode',
        array(
            'type'    => 'select',
            'section' => 'adeline_portfolio_appearance',
            'label'   => __('Mode d affichage de la banniere', 'adeline-portfolio'),
            'choices' => array(
                'compact' => __('Banniere compacte', 'adeline-portfolio'),
                'full'    => __('Banniere pleine largeur (hero compact)', 'adeline-portfolio'),
                'edge'    => __('Hero sans bord arrondi (edge-to-edge)', 'adeline-portfolio'),
            ),
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'header_banner_image',
            array(
                'section'     => 'adeline_portfolio_appearance',
                'label'       => __('Image de la banniere (optionnelle)', 'adeline-portfolio'),
                'description' => __('Tu peux afficher une image seule ou avec le texte.', 'adeline-portfolio'),
            )
        )
    );

    $wp_customize->add_control(
        'header_banner_url',
        array(
            'type'        => 'url',
            'section'     => 'adeline_portfolio_appearance',
            'label'       => __('Lien de la banniere (optionnel)', 'adeline-portfolio'),
            'description' => __('Si renseigne, la banniere devient cliquable.', 'adeline-portfolio'),
        )
    );

    $color_settings = array(
        'header_banner_bg_color' => array(
            'label' => __('Couleur de fond de la banniere', 'adeline-portfolio'),
            'default' => '#0f172a',
        ),
        'header_banner_text_color' => array(
            'label' => __('Couleur du texte de la banniere', 'adeline-portfolio'),
            'default' => '#e2e8f0',
        ),
        'theme_color_accent' => array(
            'label' => __('Couleur principale', 'adeline-portfolio'),
            'default' => '#60a5fa',
        ),
        'theme_color_accent_alt' => array(
            'label' => __('Couleur secondaire', 'adeline-portfolio'),
            'default' => '#22d3ee',
        ),
        'theme_color_text_body' => array(
            'label' => __('Couleur du texte courant', 'adeline-portfolio'),
            'default' => '#cbd5e1',
        ),
        'theme_color_text_strong' => array(
            'label' => __('Couleur des titres', 'adeline-portfolio'),
            'default' => '#e2e8f0',
        ),
        'theme_color_bg_start' => array(
            'label' => __('Couleur de fond haut', 'adeline-portfolio'),
            'default' => '#020617',
        ),
        'theme_color_bg_end' => array(
            'label' => __('Couleur de fond bas', 'adeline-portfolio'),
            'default' => '#0f172a',
        ),
    );

    foreach ($color_settings as $name => $config) {
        $wp_customize->add_setting(
            $name,
            array(
                'default'           => $config['default'],
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $name,
                array(
                    'section' => 'adeline_portfolio_appearance',
                    'label'   => $config['label'],
                )
            )
        );
    }

    $wp_customize->add_section(
        'adeline_portfolio_editorial',
        array(
            'title'    => __('Tonalite editoriale', 'adeline-portfolio'),
            'priority' => 34,
        )
    );

    $wp_customize->add_setting(
        'editorial_tone',
        array(
            'default'           => 'premium',
            'sanitize_callback' => 'adeline_portfolio_sanitize_editorial_tone',
        )
    );

    $wp_customize->add_control(
        'editorial_tone',
        array(
            'type'        => 'select',
            'section'     => 'adeline_portfolio_editorial',
            'label'       => __('Style du wording', 'adeline-portfolio'),
            'description' => __('Premium: plus institutionnel. Friendly: plus accessible et conversationnel.', 'adeline-portfolio'),
            'choices'     => array(
                'premium'  => __('Premium', 'adeline-portfolio'),
                'friendly' => __('Friendly', 'adeline-portfolio'),
            ),
        )
    );

    $wp_customize->add_section(
        'adeline_portfolio_homepage',
        array(
            'title'    => __('Accueil Portfolio', 'adeline-portfolio'),
            'priority' => 35,
        )
    );

    $wp_customize->add_section(
        'adeline_portfolio_archive_visibility',
        array(
            'title'    => __('Visibilite des pages liste', 'adeline-portfolio'),
            'priority' => 35,
        )
    );

    $archive_settings = array(
        'show_articles_archive_hero' => __('Afficher le hero des articles', 'adeline-portfolio'),
        'show_articles_archive_pagination' => __('Afficher la pagination des articles', 'adeline-portfolio'),
        'show_projects_archive_hero' => __('Afficher le hero des projets', 'adeline-portfolio'),
        'show_projects_archive_pagination' => __('Afficher la pagination des projets', 'adeline-portfolio'),
    );

    foreach ($archive_settings as $name => $label) {
        $wp_customize->add_setting(
            $name,
            array(
                'default'           => true,
                'sanitize_callback' => 'adeline_portfolio_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            $name,
            array(
                'type'    => 'checkbox',
                'section' => 'adeline_portfolio_archive_visibility',
                'label'   => $label,
            )
        );
    }

    $wp_customize->add_setting(
        'home_builder_mode',
        array(
            'default'           => 'hybrid',
            'sanitize_callback' => 'adeline_portfolio_sanitize_home_builder_mode',
        )
    );

    $wp_customize->add_control(
        'home_builder_mode',
        array(
            'type'    => 'select',
            'section' => 'adeline_portfolio_homepage',
            'label'   => __('Mode de construction de l’accueil', 'adeline-portfolio'),
            'choices' => array(
                'theme'     => __('Theme uniquement', 'adeline-portfolio'),
                'elementor' => __('Elementor uniquement', 'adeline-portfolio'),
                'hybrid'    => __('Hybride (Elementor + sections theme)', 'adeline-portfolio'),
            ),
        )
    );

    $settings = array(
        'show_home_hero' => array(
            'label'   => __('Afficher le hero du theme', 'adeline-portfolio'),
            'default' => true,
        ),
        'show_home_editorial' => array(
            'label'   => __('Afficher la section editoriale', 'adeline-portfolio'),
            'default' => true,
        ),
        'show_home_pages' => array(
            'label'   => __('Afficher les pages mises en avant', 'adeline-portfolio'),
            'default' => true,
        ),
        'show_home_projects' => array(
            'label'   => __('Afficher les projets', 'adeline-portfolio'),
            'default' => true,
        ),
        'show_home_posts' => array(
            'label'   => __('Afficher les actualites', 'adeline-portfolio'),
            'default' => true,
        ),
        'show_home_cta' => array(
            'label'   => __('Afficher l’appel a l’action final', 'adeline-portfolio'),
            'default' => true,
        ),
    );

    foreach ($settings as $name => $config) {
        $wp_customize->add_setting(
            $name,
            array(
                'default'           => $config['default'],
                'sanitize_callback' => 'adeline_portfolio_sanitize_checkbox',
            )
        );

        $wp_customize->add_control(
            $name,
            array(
                'type'    => 'checkbox',
                'section' => 'adeline_portfolio_homepage',
                'label'   => $config['label'],
            )
        );
    }

    $wp_customize->add_section(
        'adeline_portfolio_contact',
        array(
            'title'    => __('Contact', 'adeline-portfolio'),
            'priority' => 36,
        )
    );

    $wp_customize->add_setting(
        'contact_form_shortcode',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'contact_form_shortcode',
        array(
            'type'        => 'text',
            'section'     => 'adeline_portfolio_contact',
            'label'       => __('Shortcode du formulaire', 'adeline-portfolio'),
            'description' => __('Exemple: [contact-form-7 id="123" title="Contact"]', 'adeline-portfolio'),
        )
    );

    $wp_customize->add_setting(
        'contact_intro',
        array(
            'default'           => __('Parlons de ton projet, de tes priorites et de la meilleure facon de passer a l action.', 'adeline-portfolio'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'contact_intro',
        array(
            'type'    => 'text',
            'section' => 'adeline_portfolio_contact',
            'label'   => __('Intro contact', 'adeline-portfolio'),
        )
    );

    $wp_customize->add_setting(
        'contact_response_time',
        array(
            'default'           => __('Reponse sous 24 a 48h ouvrées', 'adeline-portfolio'),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'contact_response_time',
        array(
            'type'    => 'text',
            'section' => 'adeline_portfolio_contact',
            'label'   => __('Delai de reponse', 'adeline-portfolio'),
        )
    );
}
add_action('customize_register', 'adeline_portfolio_customize_register');
