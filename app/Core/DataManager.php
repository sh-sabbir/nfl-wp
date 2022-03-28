<?php

namespace Sabbir\NflWp\Core;

class DataManager {
    const SETTINGS_KEY = 'nflw_settings';

    public static function get_settings() {
        return get_option(self::SETTINGS_KEY, false);
    }
}
