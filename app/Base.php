<?php

/**
 * Plugin base class
 *
 * @package Nfl_Wp
 */

namespace Sabbir\NflWp;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class Base {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', [$this, 'i18n']);
    }

    public function i18n() {
        load_plugin_textdomain(
            'happy-elementor-addons',
            false,
            dirname(plugin_basename(NFLWP__FILE__)) . '/i18n/'
        );
    }

    public function init() {

        // Load Frontend Assets
        Core\AssetManager::init();

        // Register All Ajax handles
        Core\AjaxHandler::init();

        // Decalre Shortcodes
        Core\Shortcode::instance();

        if (is_admin()) {
            // Load Admin Dashboard
            Core\Dashboard::instance();
        }
    }
}
