<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\pages\_config.php

// Define a dynamic constant for the admin pages configuration.
mnm_define_dynamic_constant(
    $mnm_namespace_function . '_pages',
    array(
        // Define the main plugin page.
        array(
            'title'      => $mnm_plugin_data['Name'],       // The text to be displayed in the title tags of the page when the menu is selected.
            'menu_title' => $mnm_plugin_data['Name'],       // The text to be used for the menu.
            'capability' => 'manage_options',               // The capability required for this menu to be displayed to the user.
            'slug'       => $mnm_namespace_function,        // The slug name to refer to this menu by (should be unique).
            'function'   => 'mnm_page_main'                 // The function to be called to output the content for this page.
        ),
        // Define a settings subpage.
        array(
            'parent_slug' => $mnm_namespace_function,       // The slug name for the parent menu (or the file name of a standard WordPress admin page).
            'title'       => 'Settings',                    // The text to be displayed in the title tags of the page when the menu is selected.
            'menu_title'  => 'Settings',                    // The text to be used for the menu.
            'capability'  => 'manage_options',              // The capability required for this menu to be displayed to the user.
            'slug'        => 'settings',                    // The slug name to refer to this menu by (should be unique).
            'function'    => 'mnm_page_settings',           // The function to be called to output the content for this page.
        )
        // Additional pages can be added here.
    )
);
