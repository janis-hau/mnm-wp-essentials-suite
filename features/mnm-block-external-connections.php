<?php
// FILE PATH: wp-content\plugins\mnm-wp-essentials-suite\features\mnm-block-external-connections.php

function mnm_pre_http_request_block($preempt, $parsed_args, $url)
{
    // Verwende nur außerhalb des Admin-Bereichs
    if (is_admin()) {
        return $preempt;
    }

    // Hole die Einstellungen aus der Datenbank
    $settings = get_mnm_feature_setting('block_external_connections');

    // Überprüfe, ob das Feature aktiv ist
    if (isset($settings['is_active']) && $settings['is_active']) {
        // Behandle die Whitelist
        $whitelist = isset($settings['settings']['whitelist']) ? explode("\n", trim($settings['settings']['whitelist'])) : [];

        // Überprüfe, ob die URL in der Whitelist enthalten ist
        foreach ($whitelist as $whitelisted_domain) {
            if (strpos($url, trim($whitelisted_domain)) !== false) {
                return $preempt; // Erlaube die Anfrage, wenn URL in der Whitelist
            }
        }

        // Blockiere die Anfrage, da sie nicht in der Whitelist enthalten ist
        return new WP_Error('blocked', __('Diese Anfrage wurde blockiert.', 'mnmwpes'));
    }

    // Füge ein Logging hinzu
    if (is_wp_error($preempt)) {
        error_log('Anfrage blockiert: ' . $url);
    } else {
        error_log('Anfrage erlaubt: ' . $url);
    }

    // Gebe die ursprüngliche Antwort zurück, wenn das Feature nicht aktiv ist
    return $preempt;
}

add_filter('pre_http_request', 'mnm_pre_http_request_block', 10, 3);
