<?php

namespace Wishlist;

class DataUtils {

    private static $old = null;
    private static $errors = null;
    private static $messages = null;

    public static function init() {
        self::$old = $_SESSION['old'] ?? [];
        self::$errors = $_SESSION['errors'] ?? [];
        self::$messages = $_SESSION['messages'] ?? [];
        unset($_SESSION['old']);
        unset($_SESSION['errors']);
        unset($_SESSION['messages']);
    }

    public static function hasOld(): bool {
        return count(self::$old) > 0;
    }

    public static function hasErrors(): bool {
        return count(self::$errors) > 0;
    }

    public static function hasError($key): bool {
        return isset(self::$errors[$key]);
    }

    public static function hasMessages(): bool {
        return count(self::$messages) > 0;
    }

    public static function getOld()
    {
        return self::$old;
    }

    public static function getOldByKey(string $key)
    {
        return self::$old[$key] ?? null;
    }

    public static function getErrors()
    {
        return self::$errors;
    }

    public static function getErrorsByKey(string $key)
    {
        return self::$errors[$key] ?? null;
    }

    public static function getMessages()
    {
        return self::$messages;
    }

    public static function getMessageByKey(string $key)
    {
        return self::$messages[$key] ?? null;
    }
}