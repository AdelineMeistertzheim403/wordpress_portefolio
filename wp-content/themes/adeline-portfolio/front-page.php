<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="hero">
    <div class="site-shell">
        <p class="eyebrow">Portfolio</p>
        <h1><?php bloginfo('name'); ?></h1>
        <p><?php bloginfo('description'); ?></p>
    </div>
</section>

<section class="site-shell content-block">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</section>
<?php
get_footer();
