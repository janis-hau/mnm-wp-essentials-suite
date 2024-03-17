<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\scripts_and_styles\_config-frontend.php

// Define the configuration for scripts and styles for both frontend and admin areas.
mnm_define_dynamic_constant(
    $mnm_namespace_function . '_scripts_and_styles',
    array(
        // Array of scripts to be enqueued.
        'scripts' => array(
            // Configuration for a specific script.
            array(
                // Unique handle for the script.
                'handle'    => $mnm_namespace_function . '_script', 
                // URL to the script file.
                'src'       => mnm_get_dynamic_constant($mnm_namespace_constant . '_URL') . 'assets/js/' . $mnm_namespace_function . '_script.js',
                // Array of script dependencies, e.g., jQuery.
                'deps'      => array('jquery'),
                // Version of the script, based on file modification time.
                'ver'       => filemtime(mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . 'assets/js/' . $mnm_namespace_function . '_script.js'),
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
            // Additional scripts can be defined here...
        ),
        // Array of styles to be enqueued.
        'styles' => array(
            // Configuration for a specific style.
            array(
                // Unique handle for the stylesheet.
                'handle' => $mnm_namespace_function . '_style', 
                // URL to the stylesheet file.
                'src'    => mnm_get_dynamic_constant($mnm_namespace_constant . '_URL') . 'assets/css/' . $mnm_namespace_function . '_style.css',
                // Array of stylesheet dependencies.
                'deps'   => array(),
                // Version of the stylesheet, based on file modification time.
                'ver'    => filemtime(mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . 'assets/css/' . $mnm_namespace_function . '_style.css'), 
                // Media type for which this stylesheet has been defined, e.g., 'all', 'screen', 'print'.
                'media'  => 'all' 
            ),
            // Additional styles can be defined here...
        )
    )
);
