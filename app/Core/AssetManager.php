<?php

namespace Sabbir\NflWp\Core;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class AssetManager {
    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'register_frontend_scripts']);
    }

    /**
     * Register frontend assets.
     *
     * @return void
     */
    public static function register_frontend_scripts() {

        wp_register_style('nfl-datatable-style', 'https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css');
        wp_register_style('nfl-frontend-style', NFLWP_ASSETS . 'css/app.css');

        wp_register_script('nfl-datatable-js', 'https://cdn.jsdelivr.net/npm/simple-datatables@latest', [], NFLWP_VERSION);
        wp_register_script('nfl-frontend-js', NFLWP_ASSETS . 'js/app.js', [], NFLWP_VERSION);
    }
}