<?php
// File Path: wordpress\wp-content\plugins\wp-base-plugin\includes\template\_register.php

// Register custom page templates.
if (!function_exists('mnm_page_template')) {
    // Add a filter to apply custom templates based on certain conditions.
    add_filter('page_template', 'mnm_page_template');

    /**
     * Determines the correct page template based on the configuration.
     * 
     * @param string $page_template The path to the page template.
     * @return string The modified page template path.
     */
    function mnm_page_template($page_template)
    {
        global $mnm_namespace_function;
        // Retrieve the template configuration.
        $template_config = mnm_get_dynamic_constant($mnm_namespace_function . '_templates');

        // Get the current page's template slug.
        $template_slug = get_page_template_slug();
        // Check if there is a custom template for this slug and use it if available.
        if (isset($template_config[$template_slug])) {
            $page_template = $template_config[$template_slug]['path'];
        }

        return $page_template;
    }
}

if (!function_exists('mnm_add_page_template_to_select')) {
    // Add a filter to modify the list of templates available in the page attribute dropdown.
    add_filter('theme_page_templates', 'mnm_add_page_template_to_select', 10, 4);

    /**
     * Adds custom page templates to the page attribute dropdown in the editor.
     * 
     * @param array $post_templates An array of page templates. Keys are filenames, values are translated names.
     * @param WP_Theme $wp_theme The theme object.
     * @param WP_Post $post The post being edited.
     * @param string $post_type Post type.
     * @return array Modified array of post templates.
     */
    function mnm_add_page_template_to_select($post_templates, $wp_theme, $post, $post_type)
    {
        global $mnm_namespace_function;
        // Retrieve the template configuration.
        $template_config = mnm_get_dynamic_constant($mnm_namespace_function . '_templates');

        // Add each custom template to the list of available templates.
        foreach ($template_config as $slug => $data) {
            $post_templates[$slug] = $data['name'];
        }

        return $post_templates;
    }
}
