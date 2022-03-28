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
        
    }
}
