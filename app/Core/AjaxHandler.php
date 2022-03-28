<?php

namespace Sabbir\NflWp\Core;

// use Sabbir\NflWp\Core\DataManager;
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class AjaxHandler {

    public static function init() {
        // Handle Api Call to Remote source
        add_action('wp_ajax_nflwp_get_team', [__CLASS__, 'nflwp_team_api_ajax']);
        add_action('wp_ajax_nopriv_ha_nflwp_get_team', [__CLASS__, 'nflwp_team_api_ajax']);

        // Handle Plugin Settings Data
        add_action('wp_ajax_nflwp_settings_save', [__CLASS__, 'nflwp_settings_set_ajax']);
        add_action('wp_ajax_nopriv_nflwp_settings_save', [__CLASS__, 'nflwp_settings_set_ajax']);
        add_action('wp_ajax_nflwp_settings_get', [__CLASS__, 'nflwp_settings_get_ajax']);
    }

    public static function nflwp_team_api_ajax() {
    }

    public static function nflwp_settings_set_ajax() {
        $settings = isset($_REQUEST['settings']) ? $_REQUEST['settings'] : "";
        $settings = str_replace('\\', '', $settings);

        // echo $settings;
        $settingsArray = json_decode($settings, TRUE);

        $save = update_option(DataManager::SETTINGS_KEY, $settingsArray);

        if ($save) {
            wp_send_json_success($settingsArray);
        }
        wp_send_json_error(null, 400);
        // $serialized = serialize($settingsArray);
        // print_r();
        // echo serialize($settingsArray);

        // die();
    }
}
