<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="site-shell content-block">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('post-card'); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div><?php the_excerpt(); ?></div>
            </article>
        <?php endwhile; ?>

        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p>No content found.</p>
    <?php endif; ?>
</section>
<?php
get_footer();
