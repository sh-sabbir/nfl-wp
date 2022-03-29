<?php

namespace Sabbir\NflWp;

class Utilities {

    public static function d() {
        call_user_func_array('dump', func_get_args());
    }

    public static function dd() {
        call_user_func_array('dump', func_get_args());
        die();
    }

    public static function slugify($str) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $str)));
    }

    public static function getInitials($string = null) {
        return array_reduce(
            explode(' ', $string),
            function ($initials, $word) {
                return sprintf('%s%s', $initials, substr($word, 0, 1));
            },
            ''
        );
    }
}
