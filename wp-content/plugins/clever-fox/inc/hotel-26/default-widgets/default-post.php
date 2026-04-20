<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$cleverfox_MediaId = get_option('hotel_26_media_id');

$cleverfox_content = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing mollis dolor facilisis porttitor.</p><!--more--><p>This is the rest of the content that will appear only on single post view.</p>';

// Define blog post categories
$cleverfox_blog_categories = array(
	'amenities' => 'Amenities',
	'hotel-trips' => 'Hotel Trips',
	'travel-guide' => 'Travel Guide',
	'trends' => 'Trends',
	'booking-deals' => 'Booking Deals',
);

// Create blog post categories if they don't exist
$cleverfox_created_blog_cats = [];
foreach ($cleverfox_blog_categories as $cleverfox_slug => $cleverfox_name) {
    $cleverfox_result = wp_insert_term($cleverfox_name, 'category', ['slug' => $cleverfox_slug]);
    $cleverfox_created_blog_cats[$cleverfox_slug] = !is_wp_error($cleverfox_result)
        ? $cleverfox_result['term_id']
        : get_term_by('slug', $cleverfox_slug, 'category')->term_id;
}

// Blog post data with multiple categories
$cleverfox_posts = [
    [
        'post_title' => 'How to Make Your Hotel Stay More Comfortable',
        'post_category_slugs' => [ 'amenities','hotel-trips'], // Multiple categories
        'tags' => ['Booking', 'Budget'],
    ],
    [
        'post_title' => 'Sustainable Practices in the Hotel Industry',
        'post_category_slugs' => ['travel-guide','trends'], 
        'tags' => ['Luxury','Tips'],
    ],
    [
        'post_title' => 'Family-Friendly Hotels: What to Look For',
        'post_category_slugs' => [ 'amenities', 'travel-guide'], 
        'tags' => ['Budget','Experience'],
    ],
	[
        'post_title' => 'Top Benefits of Booking Directly with Hotels',
        'post_category_slugs' => [ 'booking-deals','hotel-trips'], 
        'tags' => ['Booking','Tips'],
    ],
];

foreach ($cleverfox_posts as $cleverfox_index => $cleverfox_data) {
    // Convert category slugs to category IDs
    $cleverfox_category_ids = [];
    foreach ($cleverfox_data['post_category_slugs'] as $cleverfox_slug) {
        if (isset($cleverfox_created_blog_cats[$cleverfox_slug])) {
            $cleverfox_category_ids[] = $cleverfox_created_blog_cats[$cleverfox_slug];
        }
    }

    // Create the post
    $cleverfox_post_args = [
        'post_title'   => $cleverfox_data['post_title'],
        'post_status'  => 'publish',
        'post_content' => $cleverfox_content,
        'post_author'  => 1,
        'post_type'    => 'post',
        'post_category'=> $cleverfox_category_ids, // Assign multiple categories
        'tax_input'    => ['post_tag' => $cleverfox_data['tags']],
    ];

    $cleverfox_post_id = wp_insert_post($cleverfox_post_args);

    // Assign featured image if exists
    if (!is_wp_error($cleverfox_post_id) && isset($cleverfox_MediaId[$cleverfox_index + 1])) {
        set_post_thumbnail($cleverfox_post_id, $cleverfox_MediaId[$cleverfox_index + 1]);
    }

}
?>
