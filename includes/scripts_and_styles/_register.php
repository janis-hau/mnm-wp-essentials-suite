<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\add_plugins_and_scripts.php

/******************************************************************************
 * FRONTEND STYLES AND SCRIPTS
 * This function enqueues scripts and styles for the frontend.
 */
function mnm_register_scripts_and_styles()
{
    global $mnm_namespace_function;
    // Retrieve the scripts and styles configuration from a dynamic constant.
    $mnm_scripts_and_styles = mnm_get_dynamic_constant($mnm_namespace_function . '_scripts_and_styles');

    // Loop through each script in the configuration and enqueue them.
    foreach ($mnm_scripts_and_styles['scripts'] as $script) {
        wp_enqueue_script(
            $script['handle'],    // Handle of the script.
            $script['src'],       // Source URL of the script.
            $script['deps'],      // An array of registered script handles this script depends on.
            $script['ver'],       // Script version number.
            $script['in_footer']  // Whether to enqueue the script before </body> instead of in the head.
        );

        // Localize the script with data if needed.
        if (isset($script['localize'])) {
            wp_localize_script(
                $script['handle'],          // Handle of the script.
                $script['localize']['name'], // Object name for the script.
                $script['localize']['data']  // Array of data for localization.
            );
        }
    }

    // Loop through each style in the configuration and enqueue them.
    foreach ($mnm_scripts_and_styles['styles'] as $style) {
        wp_enqueue_style(
            $style['handle'],   // Handle of the stylesheet.
            $style['src'],      // Source URL of the stylesheet.
            $style['deps'],     // An array of registered stylesheet handles this stylesheet depends on.
            $style['ver'],      // Stylesheet version number.
            $style['media']     // The media for which this stylesheet has been defined.
        );
    }
}

add_action('wp_enqueue_scripts', 'mnm_register_scripts_and_styles');


/******************************************************************************
 * ADMIN-FRONTED STYLES AND SCRIPTS
 * This function enqueues scripts and styles for the WordPress admin area.
 */
function mnm_register_admin_scripts_and_styles()
{
    global $mnm_namespace_function;
    // Retrieve the admin scripts and styles configuration from a dynamic constant.
    $mnm_scripts_and_styles = mnm_get_dynamic_constant($mnm_namespace_function . '_admin_scripts_and_styles');

    // Loop through each script in the configuration and enqueue them for the admin area.
    foreach ($mnm_scripts_and_styles['scripts'] as $script) {
        wp_enqueue_script(
            $script['handle'],    // Handle of the script.
            $script['src'],       // Source URL of the script.
            $script['deps'],      // An array of registered script handles this script depends on.
            $script['ver'],       // Script version number.
            $script['in_footer']  // Whether to enqueue the script before </body> instead of in the head.
        );

        // Localize the script with data if needed.
        if (isset($script['localize'])) {
            wp_localize_script(
                $script['handle'],          // Handle of the script.
                $script['localize']['name'], // Object name for the script.
                $script['localize']['data']  // Array of data for localization.
            );
        }
    }

    // Loop through each style in the configuration and enqueue them for the admin area.
    foreach ($mnm_scripts_and_styles['styles'] as $style) {
        wp_enqueue_style(
            $style['handle'],   // Handle of the stylesheet.
            $style['src'],      // Source URL of the stylesheet.
            $style['deps'],     // An array of registered stylesheet handles this stylesheet depends on.
            $style['ver'],      // Stylesheet version number.
            $style['media']     // The media for which this stylesheet has been defined.
        );
    }
}

add_action('admin_enqueue_scripts', 'mnm_register_admin_scripts_and_styles');
