<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-xml-rpc-deactivate.php

function mnm_deactivate_xml_rpc() {
    $feature_settings = get_mnm_feature_setting('xml_rpc_deactivate');
    if ($feature_settings && $feature_settings['is_active']) {
        add_filter('wp_headers', function ($headers) {
            unset($headers['X-Pingback']);
            return $headers;
        });

        add_filter('xmlrpc_enabled', '__return_false');
    }
}

add_action('init', 'mnm_deactivate_xml_rpc');


/*
 * This in htaccess
 *
 <Files xmlrpc.php>
 Order Deny,Allow
 Deny from all
 </Files>
 */