<?php

namespace Sabbir\NflWp\Core;

use Sabbir\NflWp\Utilities;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class Dashboard {

    private static $instance;

    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('admin_menu', array($this, 'add_menu_items'));
        add_action('admin_enqueue_scripts', [$this, 'register_admin_scripts']);
    }

    public function init() {
    }

    public function register_admin_scripts($hook) {
        //Load CSS for entire wp-admin
        wp_enqueue_style('nflwp_admin_css', NFLWP_ASSETS . 'admin/css/admin.css');

        // But load js for only our setting page
        if ('toplevel_page_nfl-wp-settings' != $hook) {
            return;
        }
        wp_enqueue_script('nflwp_admin_js', NFLWP_ASSETS . 'admin/js/admin.js', [], NFLWP_VERSION, true);
    }

    public function add_menu_items() {
        add_menu_page(
            __('NFL WP Settings', 'nfl-wp'),
            __('NFL WP', 'nfl-wp'),
            'manage_options',
            'nfl-wp-settings',
            array($this, 'menuPage'),
            NFLWP_ASSETS.'img/nfl-logo.svg',
            58.5
        );
    }

    public function menuPage() {
        // Echo the html here...
        $template = 'settings';
        $file = NFLWP_DIR_PATH . 'templates/admin/dashboard-' . $template . '.php';
        if ( is_readable( $file ) ) {
            $settings = DataManager::get_settings();
            include( $file );
        }
    }
}
