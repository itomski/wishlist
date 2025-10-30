<?php

namespace Wishlist;

class AccountUtils {

    private function __construct()
    {
    }

    public static function loginRequired() {
        if(!self::isLoggedIn()) {
            header('Location: index.php?a=login');
            die();
        }
    }

    public static function isLoggedIn(): bool {
        return isset($_SESSION['user']);
    }

    public static function logOut() {
        unset($_SESSION['user']);
        header('Location: index.php?a=login');
        die();
    }
}