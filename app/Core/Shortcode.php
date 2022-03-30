<?php

namespace Sabbir\NflWp\Core;

use Sabbir\NflWp\Utilities;

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

        if ($atts['style'] == 4) {
            wp_enqueue_style('nfl-datatable-style');
        }
        wp_enqueue_script('nfl-datatable-js');

        wp_enqueue_style('nfl-frontend-style');
        wp_enqueue_script('nfl-frontend-js');

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

            if ($apiData->getData()) {
                if ($style == 4) {
                    $data = $apiData->get_team_list();
                } else {
                    $data = $apiData->get_team_by_conference();
                }
                $output = $this->load_template($style, $data);
            } else {
                $output = '<p>A valid apiKey is required to show data</p>';
            }
        } else {
            $output = '<p>A valid apiKey is required to show data</p>';
        }

        return $output;
    }

    private function load_template($template, $data) {
        ob_start();
        $filename = NFLWP_DIR_PATH . 'templates/style-' . $template . '.php';
        if (is_file($filename)) {
            @include($filename);
        }
        return ob_get_clean();
    }
}
