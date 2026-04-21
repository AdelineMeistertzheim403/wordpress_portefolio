<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="site-shell content-block">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
        <?php
    endwhile;
    ?>
</section>
<?php
get_footer();
