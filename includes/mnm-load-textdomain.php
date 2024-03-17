<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\mnm-load-textdomain.php

/**
 * Load the plugin's textdomain for internationalization.
 *
 * This function is responsible for loading the textdomain that allows the plugin
 * to support localization and internationalization. It checks if 'mnm_load_textdomain'
 * is not already defined to avoid function redeclaration.
 */
if (!function_exists('mnm_load_textdomain')) {
    function mnm_load_textdomain()
    {
        global $mnm_plugin_data, $mnm_namespace_constant;

        // Load the textdomain for the plugin. The textdomain should match the one specified in the plugin headers.
        // The path to the directory containing translation files is also provided.
        load_plugin_textdomain($mnm_plugin_data['TextDomain'], false, mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . '/languages');
    }

    // Hook 'mnm_load_textdomain' function to the 'plugins_loaded' action.
    // This ensures that the textdomain is loaded as soon as all plugins are loaded, allowing the plugin to be translated.
    add_action('plugins_loaded', 'mnm_load_textdomain');
}
