<?php

namespace Sabbir\NflWp\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class Shortcode {
    private static $instance;

    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __construct() {
        add_shortcode('nfl', [$this, 'nfl_shortcode_callback']);
    }

    public function nfl_shortcode_callback($atts) {

        $atts = shortcode_atts(array(
            'style' => 1,
        ), $atts, 'nfl');

        return $this->render_shortcode($atts['style']);
    }

    private function render_shortcode($style) {
        $settings = DataManager::get_settings();
        $output = '';

        if (DataManager::validate_settings($settings)) {
            $apiKey = $settings['apiKey'];
            $cacheTime = (isset($settings['isCache']) && $settings['isCache'] && $settings['cacheTime']) ? $settings['cacheTime'] : 0;

            $output = $apiKey . ':' . $cacheTime;
            $dataManager = DataManager::instance();
            $apiData = $dataManager->get_api_data($apiKey, $cacheTime);
           
            $data = $apiData->get_team_by_conference();

            // $output = print_r($data,true);

            var_export($data);

        } else {
            $output = 'A valid apiKey is required to show data';
        }

        return $output;
    }
}
