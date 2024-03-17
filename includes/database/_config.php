<?php
// File path: wordpress\wp-content\plugins\wp-base-plugin\includes\database\_config.php

// Define dynamic constants for database tables using the mnm_define_dynamic_constant function.
// This configuration specifies the structure of each table required by the plugin.
mnm_define_dynamic_constant(
    // The dynamic constant name, based on the namespace function, to store table structures.
    $mnm_namespace_function . '_tables',
    // Array defining each table and their respective fields with data types.
    array(
        // Define the first table and its structure.
        'feature_settings' => [
            'id'           => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
            'feature_name' => 'VARCHAR(255) NOT NULL',
            'is_active'    => 'TINYINT(1) NOT NULL DEFAULT 1',
            'settings'     => 'TEXT NULL', // JSON-encoded string for flexible settings
            // More fields can be added here...
        ],
        // Define additional tables as needed...
        // 'another_table_name' => [
        //     // Table structure for 'another_table_name'...
        // ],
    )
);