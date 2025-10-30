<?php

namespace Wishlist;

class DebugUtils {

    private static $debugMode = false;

    private function __construct()
    {
    }    

    public static function setDebugMode(bool $on) {
        self::$debugMode = $on;
    }

    public static function print(array $data) {
        if(self::$debugMode) {
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
    }
}