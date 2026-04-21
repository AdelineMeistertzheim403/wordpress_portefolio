<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="site-shell content-block">
    <h1>Page not found</h1>
    <p>The page you requested does not exist.</p>
    <p><a href="<?php echo esc_url(home_url('/')); ?>">Return to the homepage</a></p>
</section>
<?php
get_footer();
