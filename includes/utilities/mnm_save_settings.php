<?php
function mnm_save_feature_settings()
{
    global $wpdb, $mnm_namespace_function;
    check_admin_referer('mnm-feature-settings-save', 'mnm-feature-settings-nonce');

    if (!current_user_can('manage_options')) {
        wp_die('Unzureichende Berechtigungen');
    }

    $table_name = $wpdb->prefix . $mnm_namespace_function . '_feature_settings';

    mnm_pre_r($_POST);

    foreach ($_POST['features'] as $feature_name => $feature_settings) {

        mnm_pre_r($feature_name);
        mnm_pre_r($feature_settings);

        $is_active = (isset($feature_settings['is_active']) && array_key_exists('is_active', $feature_settings ) ) ? $feature_settings['is_active'] : 0; // Prüft, ob die Checkbox markiert wurde.

        mnm_pre_r($is_active);

        $settings = maybe_serialize($feature_settings); // Serialisiert die Einstellungen für die Speicherung.

        // Update oder Insert Logik
        $existing = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE feature_name = %s", $feature_name));
        if ($existing > 0) {
            $wpdb->update($table_name, ['is_active' => $is_active, 'settings' => $settings], ['feature_name' => $feature_name]);
        } else {
            $wpdb->insert($table_name, ['feature_name' => $feature_name, 'is_active' => $is_active, 'settings' => $settings]);
        }
    }

    wp_redirect(add_query_arg(['page' => 'settings', 'status' => 'success'], admin_url('admin.php')));
    exit;
}

add_action('admin_post_update_mnm_settings', 'mnm_save_feature_settings');



function get_mnm_feature_setting($feature_name)
{
    global $wpdb, $mnm_namespace_function;
    // Der Tabellenname, der deine Einstellungen speichert. Stelle sicher, dass dieser mit deiner tatsächlichen Tabelle übereinstimmt.
    $table_name = $wpdb->prefix . $mnm_namespace_function . '_feature_settings';

    // Bereite eine SQL-Anfrage vor, um die Einstellungen für das angegebene Feature zu holen.
    $sql = $wpdb->prepare("SELECT * FROM $table_name WHERE feature_name = %s", $feature_name);
    $settings = $wpdb->get_row($sql, ARRAY_A);

    // Überprüfe, ob Ergebnisse vorhanden sind und gib sie entsprechend zurück.
    if (!empty($settings)) {
        // Korrektes Deserialisieren des 'settings'-Felds.
        $settings['settings'] = maybe_unserialize($settings['settings']);
        return $settings;
    }

    // Gib null zurück, wenn keine Einstellungen gefunden wurden.
    return null;
}
