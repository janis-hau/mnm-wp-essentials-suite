<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-rss-feed-turn-off.php

function mnm_configure_feed_settings()
{
    $settings = get_mnm_feature_setting('rss_feed_turn_off');
    $disable_message = !empty($settings['disable_message']) ? $settings['disable_message'] : 'Feed nicht verfügbar. Bitte besuche die Homepage.';

    $feeds = [
        'do_feed',
        'do_feed_rdf',
        'do_feed_rss',
        'do_feed_rss2',
        'do_feed_atom',
        'do_feed_rss2_comments',
        'do_feed_atom_comments',
    ];

    foreach ($feeds as $feed) {
        if (!empty($settings[$feed])) {
            add_action($feed, function () use ($disable_message) {
                wp_die($disable_message);
            }, 1);
        }
    }
}
add_action('after_setup_theme', 'mnm_configure_feed_settings');
