<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="site-shell front-section">
    <?php while (have_posts()) : the_post(); ?>
        <?php
        $show_hero = adeline_portfolio_is_section_visible(get_the_ID(), 'show_hero', true);
        $show_page_content = adeline_portfolio_is_section_visible(get_the_ID(), 'show_page_content', true);
        $show_featured_image = adeline_portfolio_is_section_visible(get_the_ID(), 'show_featured_image', true);
        $show_back_link = adeline_portfolio_is_section_visible(get_the_ID(), 'show_back_link', true);
        ?>
        <article <?php post_class('project-entry'); ?>>
            <?php if ($show_hero) : ?>
                <div class="front-section__heading">
                    <p class="front-section__eyebrow"><?php esc_html_e('Projet', 'adeline-portfolio'); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <?php if (has_excerpt()) : ?>
                        <p><?php echo esc_html(get_the_excerpt()); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($show_featured_image && has_post_thumbnail()) : ?>
                <div class="project-entry__media">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <?php if ($show_page_content) : ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>

            <?php if ($show_back_link) : ?>
                <div class="front-section__footer">
                    <a class="front-action front-action--secondary" href="<?php echo esc_url(get_post_type_archive_link('project')); ?>">
                        <?php esc_html_e('Retour aux projets', 'adeline-portfolio'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</section>
<?php
get_footer();