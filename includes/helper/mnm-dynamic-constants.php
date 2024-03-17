<?php
// File path: wordpress/wp-content/plugins/wp-base-plugin/includes/helper/mnm-dynamic-constants.php

/**
 * Defines a dynamic constant if it's not already defined.
 *
 * @param string $name  The name of the constant.
 * @param mixed $value  The value of the constant.
 */
function mnm_define_dynamic_constant($name, $value)
{
    // Check if the constant is not already defined.
    if (!defined($name)) {
        // Define the constant with the given name and value.
        define($name, $value);
    }
}

/**
 * Retrieves the value of a defined dynamic constant.
 * Returns null if the constant is not defined.
 *
 * @param string $name  The name of the constant to retrieve.
 * @return mixed        The value of the constant or null if not defined.
 */
function mnm_get_dynamic_constant($name)
{
    // Return the value of the constant if it's defined, otherwise return null.
    return defined($name) ? constant($name) : null;
}
