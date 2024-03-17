<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-remove-wp-responsive-images.php

function mnm_remove_wp_responsive_images()
{
    $settings = get_mnm_feature_setting('remove_wp_responsive_images');

    if (!empty($settings) && !empty($settings['is_active'])) {
        add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
    }
}

add_action('after_setup_theme', 'mnm_remove_wp_responsive_images');
