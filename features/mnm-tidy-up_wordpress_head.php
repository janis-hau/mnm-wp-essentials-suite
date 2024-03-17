<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-tidy-up_wordpress_head.php

add_action('init', 'remheadlink');
function remheadlink()
{
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_header', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
}


function mnm_tidy_up_wp_head() {
    $settings = get_mnm_feature_setting('tidy_up_wp_head');

    if (!empty($settings['remove_rsd_link'])) {
        remove_action('wp_head', 'rsd_link');
    }
    if (!empty($settings['remove_wp_generator'])) {
        remove_action('wp_head', 'wp_generator');
    }
    if (!empty($settings['remove_index_rel_link'])) {
        remove_action('wp_head', 'index_rel_link');
    }
    if (!empty($settings['remove_wlwmanifest_link'])) {
        remove_action('wp_head', 'wlwmanifest_link');
    }
    if (!empty($settings['remove_feed_links'])) {
        remove_action('wp_head', 'feed_links', 2);
    }
    if (!empty($settings['remove_feed_links_extra'])) {
        remove_action('wp_head', 'feed_links_extra', 3);
    }
    if (!empty($settings['remove_parent_post_rel_link'])) {
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    }
    if (!empty($settings['remove_start_post_rel_link'])) {
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
    }
    if (!empty($settings['remove_adjacent_posts_rel_link_wp_head'])) {
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    }
    if (!empty($settings['remove_wp_shortlink_wp_head'])) {
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
        remove_action('wp_head', 'wp_shortlink_header', 10, 0);
    }
}
add_action('init', 'mnm_tidy_up_wp_head');
