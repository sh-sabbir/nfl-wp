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
}
