<?php

namespace Sabbir\NflWp\Core;

use Sabbir\NflWp\Utilities;

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class DataManager {
    const SETTINGS_KEY = 'nflw_settings';

    private $data;
    private static $instance;

    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function get_settings() {
        return get_option(self::SETTINGS_KEY, false);
    }

    public static function validate_settings($settings) {
        if (isset($settings['apiKey']) && !empty($settings['apiKey'])) {
            return true;
        }
        return false;
    }

    public function get_api_data($api_key, $cache) {
        $data = get_transient('nfl_api_data');

        if (!($cache > 0)) {
            $data = false;
        }

        $api_base = 'http://delivery.chalk247.com/team_list/NFL.JSON?api_key=';
        $api_url = $api_base . $api_key;

        if (false === $data) {
            $response = wp_remote_get($api_url);

            if (200 !== wp_remote_retrieve_response_code($response)) {
                return;
            }
            $data = wp_remote_retrieve_body($response);
            set_transient('nfl_api_data', $data, $cache * MINUTE_IN_SECONDS);
        }

        $this->data = json_decode($data);
        return $this;
    }

    public function get_team_list() {
        if ($this->data) {
            return $this->data->results->data->team;
        }
    }

    public function get_team_list_by_division() {
        if ($this->data) {
            $teams = $this->get_team_list();

            // Skeleton data structure
            $groups = [
                'north' => [],
                'east' => [],
                'south' => [],
                'west' => [],
            ];
            if ($teams) {
                foreach ($teams as $team) {
                    $division = Utilities::slugify($team->division);
                    $groups[$division][] = $team;
                }
            }
            // Utilities::dd($groups);
            return $groups;
        }
    }

    public function get_team_by_conference() {
        if ($this->data) {
            $teams = $this->get_team_list();

            // Skeleton data structure
            $groups = [
                'AFC' => [
                    'north' => [],
                    'east' => [],
                    'south' => [],
                    'west' => [],
                ],
                'NFC' => [
                    'north' => [],
                    'east' => [],
                    'south' => [],
                    'west' => [],
                ],
            ];
            if ($teams) {
                foreach ($teams as $team) {
                    $initial = Utilities::getInitials($team->conference);
                    $division = Utilities::slugify($team->division);
                    $groups[$initial][$division][] = $team;
                }
            }
            // Utilities::dd($groups);
            return $groups;
        }
    }
}
