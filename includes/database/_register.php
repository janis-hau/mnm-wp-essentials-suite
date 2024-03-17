<?php
// File path: wordpress\wp-content\plugins\wp-base-plugin\includes\database\create_update_tables.php

// Check if the function mnm_create_update_database_tables doesn't already exist
if (!function_exists('mnm_create_update_database_tables')) {
    // Define the function mnm_create_update_database_tables
    function mnm_create_update_database_tables()
    {
        global $wpdb, $mnm_namespace_function;

        // Include the WordPress database upgrade functionality
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        // Retrieve the tables configuration using a dynamic constant specific to your namespace
        $tables = mnm_get_dynamic_constant($mnm_namespace_function . '_tables');
        
        // Iterate over each table in the configuration
        foreach ($tables as $table => $fields) {

            // Prepare the full table name with WordPress table prefix
            $table_name        = $wpdb->prefix . $mnm_namespace_function . '_' . $table;
            $field_definitions = [];
            
            // Retrieve the existing columns in the table
            $existing_columns  = $wpdb->get_col("DESCRIBE {$table_name}");

            // Iterate over each field defined in the configuration
            foreach ($fields as $field => $type) {
                // If the field does not exist in the table
                if (!in_array($field, $existing_columns)) {
                    // Add the field to the table
                    $wpdb->query("ALTER TABLE {$table_name} ADD {$field} {$type}");
                }
                // Add the field definition to the array for table creation
                $field_definitions[] = "{$field} {$type}";
            }

            // Create SQL statement to create the table if it doesn't exist
            $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (" . implode(', ', $field_definitions) . ");";

            // Execute the SQL statement to create or update the table structure
            dbDelta($sql);
        }
    }

    // Register the function to be called when the plugin is activated
    register_activation_hook(__FILE__, 'mnm_create_update_database_tables');

    // Add an action to admin_init hook to call the function when in the admin area
    add_action('admin_init', function () {
        // Check if the current page is an admin page
        if (is_admin()) {
            // Call the function to create or update database tables
            mnm_create_update_database_tables();
        }
    });
}
