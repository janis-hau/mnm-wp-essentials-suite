<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-stop-heartbeat.php

// ********************************************************************************
// * #hearbeat api disable exclude articles
// */
function mnm_configure_heartbeat_api()
{
    $settings = get_mnm_feature_setting('heartbeat_api');

    // Direktes Anwenden der Einstellungen ohne "modify_heartbeat"
    if (!empty($settings['disable_on_pages'])) {
        add_action('init', 'mnm_disable_heartbeat_except_for_post_edit_pages');
    }
    if (isset($settings['heartbeat_frequency']) && $settings['heartbeat_frequency'] > 0 && $settings['heartbeat_frequency'] !== 60) {
        add_filter('heartbeat_settings', 'mnm_custom_heartbeat_frequency');
    }
    
}

function mnm_disable_heartbeat_except_for_post_edit_pages()
{
    global $pagenow;
    if ($pagenow != 'post.php' && $pagenow != 'post-new.php') {
        wp_deregister_script('heartbeat');
    }
}

function mnm_custom_heartbeat_frequency($settings)
{
    $settings['interval'] = get_mnm_feature_setting('heartbeat_api')['heartbeat_frequency'] ?? 60;
    return $settings;
}

add_action('after_setup_theme', 'mnm_configure_heartbeat_api');
