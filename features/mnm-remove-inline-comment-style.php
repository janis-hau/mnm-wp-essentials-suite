<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-remove-inline-comment-style.php

add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    $settings = get_mnm_feature_setting('remove_inline_comment_style');

    if (!empty($settings['is_active'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }

}
