<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-block-wp-embed.php

function mnm_activate_feature_block_wp_embed() {
    $settings = get_mnm_feature_setting('block_wp_embed');
    
    if (isset($settings['is_active']) && $settings['is_active']) {
        add_action('init', 'block_wp_embed');
    }
}

function block_wp_embed() {
    wp_deregister_script('wp-embed');
}

add_action('init', 'mnm_activate_feature_block_wp_embed', 0); // Früher Priorität, um sicherzustellen, dass es vor anderen init Aktionen ausgeführt wird.
