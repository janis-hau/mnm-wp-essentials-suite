<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\template\_config.php

// Define the configuration for custom page templates.
mnm_define_dynamic_constant(
    $mnm_namespace_function . '_templates',
    array(
        // Define a custom template named 'template-berater.php'.
        'template-berater.php' => array(
            // Specify the path to the template file.
            'path' => mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . 'templates/template-example.php',
            // Set a user-friendly name for the template, which is displayed in the admin panel.
            'name' => __('mnm example template') // The __('...') function is used for localization.
        ),
        // Additional custom templates can be defined here...
    )
);
