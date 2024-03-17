<?php
// File Path: wp-content\plugins\mnm-trip-cal\inc\helper\mnm-pre.php

/**
 * Prints a human-readable version of a variable wrapped in <pre> tags for debugging purposes.
 * This function checks if 'mnm_pre_r' is not already defined to avoid function redeclaration.
 * 
 * @param mixed $arr The variable to be printed in a human-readable format.
 * @return void
 */
if (!function_exists('mnm_pre_r')) {
    function mnm_pre_r($arr)
    {
        echo '<pre style="padding:1rem;background:rgba(255,0,0,.1);font-size:1rem;color:#000;text-align:left;text-align-last:left">';
        print_r($arr);
        echo '</pre>';
    }
}

/**
 * Dumps information about a variable wrapped in <pre> tags for debugging purposes.
 * This function checks if 'mnm_pre_v' is not already defined to avoid function redeclaration.
 * 
 * @param mixed $arr The variable to be dumped.
 * @return void
 */
if (!function_exists('mnm_pre_v')) {
    function mnm_pre_v($arr)
    {
        echo '<pre style="padding:1rem;background:rgba(255,0,0,.1);font-size:1rem;color:#000">';
        var_dump($arr);
        echo '</pre>';
    }
}
