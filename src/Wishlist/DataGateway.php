<?php

namespace Wishlist;

use PDOException;

class DataGateway {

    private function __construct()
    {
    }

    public static function getAllLocations(): array {
        $sql = 'SELECT l.*, BIN_TO_UUID(id) AS id FROM locations AS l';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->query($sql);
        return $stmt->fetchAll();
    }

    public static function getAllEventsByUser(string $uuid): array {
        $sql = 'SELECT e.*, BIN_TO_UUID(id) AS id FROM events AS e WHERE user_id = UUID_TO_BIN(?)';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$uuid]);
        return $stmt->fetchAll();
    }
}