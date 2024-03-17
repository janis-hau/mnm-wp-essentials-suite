<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\scripts_and_styles\_config-admin.php

// Define the configuration for scripts and styles specifically for the WordPress admin area.
mnm_define_dynamic_constant(
    $mnm_namespace_function . '_admin_scripts_and_styles',
    array(
        // Array of scripts to be enqueued in the admin area.
        'scripts' => array(
            // Configuration for a specific admin script.
            array(
                // Unique handle for the script.
                'handle'    => $mnm_namespace_function . '_script',
                // URL to the script file.
                'src'       => mnm_get_dynamic_constant($mnm_namespace_constant . '_URL') . 'assets/js/' . $mnm_namespace_function . '_admin_script.js',
                // Array of script dependencies, e.g., jQuery.
                'deps'      => array('jquery'),
                // Version of the script, based on file modification time.
                'ver'       => filemtime(mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . 'assets/js/' . $mnm_namespace_function . '_admin_script.js'),
                // Whether to place the script in the footer.
                'in_footer' => true,
                'localize'  => array(
                    // Object name for localized data.
                    'name' => 'myScriptData', 
                    'data' => array(
                        // URL for AJAX requests.
                        'ajaxUrl' => admin_url('admin-ajax.php'), 
                        // Additional data can be added here...
                    )
                )
            ),
            // Additional admin scripts can be defined here...
        ),
        // Array of styles to be enqueued in the admin area.
        'styles' => array(
            // Configuration for a specific admin style.
            array(
                // Unique handle for the stylesheet.
                'handle' => $mnm_namespace_function . '_style', 
                // URL to the stylesheet file.
                'src'    => mnm_get_dynamic_constant($mnm_namespace_constant . '_URL') . 'assets/css/' . $mnm_namespace_function . '_admin_style.css',
                // Array of stylesheet dependencies.
                'deps'   => array(),
                // Version of the stylesheet, based on file modification time.
                'ver'    => filemtime(mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . 'assets/css/' . $mnm_namespace_function . '_admin_style.css'),
                // Media type for which this stylesheet has been defined, e.g., 'all', 'screen', 'print'.
                'media'  => 'all'
            ),
            // Additional admin styles can be defined here...
        )
    )
);
