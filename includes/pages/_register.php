<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\pages\_pages.php

/**
 * Registers admin pages for the plugin.
 * 
 * This function adds pages and subpages to the WordPress admin menu
 * based on a configuration from a dynamic constant. It checks if the function
 * 'register_plugin_pages' already exists to prevent function redeclaration.
 */
if (!function_exists('register_plugin_pages')) {
    // Hook the function to the 'admin_menu' action
    add_action('admin_menu', 'register_plugin_pages');

    function register_plugin_pages()
    {
        global $mnm_namespace_function;

        // Retrieve the array of pages from the dynamic constant.
        $pages = mnm_get_dynamic_constant($mnm_namespace_function . '_pages');

        // Iterate through each page configuration in the array.
        foreach ($pages as $page) {
            // Check if the page is a subpage.
            if (isset($page['parent_slug'])) {
                // Add a subpage to the admin menu.
                add_submenu_page(
                    $page['parent_slug'], // Parent slug
                    $page['title'],       // Page title
                    $page['menu_title'],  // Menu title
                    $page['capability'],  // Required capability for access. Example: 'manage_options'
                    $page['slug'],        // Page slug
                    $page['function']     // Function to display the page content
                );
            } else {
                // Add a main menu page.
                add_menu_page(
                    $page['title'],       // Page title
                    $page['menu_title'],  // Menu title
                    $page['capability'],  // Required capability for access. Example: 'manage_options'
                    $page['slug'],        // Page slug
                    $page['function']     // Function to display the page content
                );
            }
        }
    }
}
