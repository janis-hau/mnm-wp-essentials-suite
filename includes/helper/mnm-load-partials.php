<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\helper\mnm-load-partials.php

/**
 * Loads a partial template file with optional data.
 * 
 * This function dynamically includes a PHP partial file located in the 'partials' directory.
 * It allows passing data to the partial, making it reusable with different content.
 *
 * @param string $partial_name The name of the partial file to be included (without the .php extension).
 * @param array $data Optional associative array of data to be passed to the partial.
 */
function mnm_load_partials($partial_name, $data = array())
{
    // Ensure the provided data is an array.
    if (!is_array($data)) {
        $data = array();
    }

    // Extracts variables to be used in the partial from the data array.
    extract($data);

    // Construct the file path of the partial.
    $file = mnm_get_dynamic_constant($mnm_namespace_constant . '_PATH') . '/partials/' . $partial_name . '.php';

    // Check if the partial file exists and include it.
    if (file_exists($file)) {
        include $file;
    }
}
