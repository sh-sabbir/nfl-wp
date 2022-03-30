<?php

namespace Sabbir\NflWp\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class AjaxHandler {

    public static function init() {

        // Handle Plugin Settings
        add_action('wp_ajax_nflwp_settings_save', [__CLASS__, 'nflwp_settings_set_ajax']);
    }

    public static function nflwp_settings_set_ajax() {

        if (!(isset($_REQUEST['nonce']) && wp_verify_nonce($_REQUEST['nonce'], 'nfl-settings'))) {
            wp_send_json_error(null, 400);
        }

        $settings = isset($_REQUEST['settings']) ? $_REQUEST['settings'] : "";
        $settings = str_replace('\\', '', $settings);

        // echo $settings;
        $settingsArray = json_decode($settings, TRUE);
        $oldSettingsArray = DataManager::get_settings();

        $save = update_option(DataManager::SETTINGS_KEY, $settingsArray);

        if ($settingsArray == $oldSettingsArray) {
            wp_send_json_success($settingsArray);
        }

        if ($save) {
            wp_send_json_success($settingsArray);
        }
        wp_send_json_error(null, 400);
    }
}
