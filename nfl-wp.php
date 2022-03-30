<?php

/**
 * Plugin Name: Nfl WP
 * Plugin URI: https://github.com/sh-sabbir/nfl-wp
 * Description: A plugin for showing NFL team data in various format!
 * Version: 1.0.0
 * Author: Sabbir Hasan <sabbirshouvo@gmail.com>
 * Author URI: https://iamsabbir.dev
 * Requires at least: 5.0
 * Tested up to: 5.9.2
 * Requires PHP: 7.0
 * Text Domain: nfl-wp
 * License: http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @copyright Copyright (c) 2022, Sabbir Hasan
 * @package Nfl_Wp
 *
 */

// Exit if accessed directly
defined('ABSPATH') || die();

require_once dirname(__FILE__) . "/lib/autoload.php";

/**
 * Define Plugin Constants
 */
define('NFLWP_VERSION', '1.0.0');
define('NFLWP__FILE__', __FILE__);
define('NFLWP_DIR_PATH', plugin_dir_path(NFLWP__FILE__));
define('NFLWP_DIR_URL', plugin_dir_url(NFLWP__FILE__));
define('NFLWP_ASSETS', trailingslashit(NFLWP_DIR_URL . 'assets'));


/**
 * A journey of a thousand miles begins with a single step.
 * - Chinese proverb.
 * 
 * @return void Some voids are not really void!
 */

function nflwp_let_the_journey_begin() {
    \Sabbir\NflWp\Base::instance();
}
add_action('plugins_loaded', 'nflwp_let_the_journey_begin');
