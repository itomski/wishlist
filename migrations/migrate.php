<?php

use Wishlist\Database;

require_once '../vendor/autoload.php';

$dbh = Database::getInstance()->getConnection();

$files = array_diff(scandir(__DIR__), array('.', '..', 'migrate.php'));

foreach($files as $file) {
    require_once $file;
}