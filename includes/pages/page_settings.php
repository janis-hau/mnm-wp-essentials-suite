<?php

function mnm_page_settings()
{
    global $wpdb, $mnm_namespace_function;

    // Sicherstellen, dass Änderungen nur von Benutzern mit entsprechender Berechtigung vorgenommen werden können
    if (!current_user_can('manage_options')) {
        wp_die(__('Sie haben nicht die erforderlichen Berechtigungen, um diese Seite aufzurufen.'));
    }

    // Speichern der Einstellungen, wenn das Formular übermittelt wird
    if (isset($_POST['submit']) && check_admin_referer('mnm-feature-settings-save', 'mnm-feature-settings-nonce')) {
        // Hier würde die Logik zum Speichern der Einstellungen stehen.
        echo '<div class="updated"><p>Einstellungen gespeichert.</p></div>';
    }

    // Dynamisch das Formular basierend auf der Struktur generieren
    $feature_settings_structure = mnm_get_features_settings_structure();

    echo '<div class="wrap ' . $mnm_namespace_function . '-wrap">';

    // // Simuliere eine erlaubte Anfrage
    // $response_allowed = wp_remote_get('http://google.com');
    // // Simuliere eine blockierte Anfrage
    // $response_blocked = wp_remote_get('http://my-new.me');

    // // Überprüfe die Antworten
    // echo '<pre>';
    // print_r($response_allowed);
    // print_r($response_blocked);
    // echo '</pre>';

    echo '<h2>' . esc_html(get_admin_page_title()) . '</h2>';
    echo '<form method="post" action="' . esc_attr(admin_url('admin-post.php')) . '">';
    echo '<input type="hidden" name="action" value="update_mnm_settings">';
    wp_nonce_field('mnm-feature-settings-save', 'mnm-feature-settings-nonce');

    foreach ($feature_settings_structure as $feature_key => $feature) {
        $current_settings = get_mnm_feature_setting($feature_key);

        echo '<div class="mnmwpes-feature">';
        echo '<h3>' . esc_html($feature['label']) . '</h3>';
        if (!empty($feature['description'])) {
            echo '<p>' . esc_html($feature['description']) . '</p>';
        }

        if (array_key_exists('fields', $feature) && is_array($feature['fields'])) {
            foreach ($feature['fields'] as $field_key => $field) {
                $field_value = isset($current_settings['settings'][$field_key]) ? $current_settings['settings'][$field_key] : ($field['default'] ?? '');
                $attributes = isset($field['attributes']) ? $field['attributes'] : [];

                echo '<div class="mnmwpes-options mnmwpes-'.$field['type'].'">';

                if ($field['type'] !== 'textarea') {
                    // Generiere den Feldtyp basierend auf der 'type'-Eigenschaft
                    switch ($field['type']) {
                        case 'checkbox':
                            $checked = $field_value ? 'checked' : '';
                            echo "<input type='hidden' name='features[$feature_key][$field_key]' value='0'>";
                            echo "<input type='checkbox' id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' value='1' $checked " . mnm_generate_html_attributes($attributes) . ">";
                            break;
                        case 'text':
                        case 'number':
                            // Der HTML5 'number' Typ unterstützt auch 'min', 'max', 'step'
                            echo "<input type='{$field['type']}' id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' value='" . esc_attr($field_value) . "' " . mnm_generate_html_attributes($attributes) . ">";
                            break;
                        case 'textarea':
                            echo "<textarea id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' class='regular-text' " . mnm_generate_html_attributes($attributes) . ">" . esc_textarea($field_value) . "</textarea>";
                            break;
                            // Ergänze bei Bedarf weitere Feldtypen
                    }

                    echo '<label for="' . $feature_key . '_' . esc_attr($field_key) . '">' . esc_html($field['label']) . '</label>';
                } else {
                    echo '<label for="' . $feature_key . '_' . esc_attr($field_key) . '">' . esc_html($field['label']) . '</label>';
                    // Generiere den Feldtyp basierend auf der 'type'-Eigenschaft
                    switch ($field['type']) {
                        case 'checkbox':
                            $checked = $field_value ? 'checked' : '';
                            echo "<input type='hidden' name='features[$feature_key][$field_key]' value='0'>";
                            echo "<input type='checkbox' id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' value='1' $checked " . mnm_generate_html_attributes($attributes) . ">";
                            break;
                        case 'text':
                        case 'number':
                            // Der HTML5 'number' Typ unterstützt auch 'min', 'max', 'step'
                            echo "<input type='{$field['type']}' id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' value='" . esc_attr($field_value) . "' " . mnm_generate_html_attributes($attributes) . ">";
                            break;
                        case 'textarea':
                            echo "<textarea id='" . $feature_key . '_' . esc_attr($field_key) . "' name='features[$feature_key][$field_key]' class='regular-text' " . mnm_generate_html_attributes($attributes) . ">" . esc_textarea($field_value) . "</textarea>";
                            break;
                            // Ergänze bei Bedarf weitere Feldtypen
                    }
                }

                if (!empty($field['description'])) {
                    echo '<p class="mnmwpes-description">' . esc_html($field['description']) . '</p>';
                }

                echo '</div>'; // /.mnmwpes-options
            }
        }


        if (!empty($feature['additional_html'])) {
            echo $feature['additional_html'];
        }
        echo '</div>'; // /.feature
    }

    submit_button('Einstellungen speichern');
    echo '</form>';
    echo '</div>';
}

function mnm_generate_html_attributes($attributes)
{
    $html = [];
    foreach ($attributes as $key => $value) {
        $html[] = esc_attr($key) . '="' . esc_attr($value) . '"';
    }
    return implode(' ', $html);
}
