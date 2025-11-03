<?php

namespace Wishlist\ORM;

use \Wishlist\Database;

trait FindBy {

    protected static function findOneBy(string $sql, array $data): ?object {
        return self::findManyBy($sql, $data)[0];
    }

    protected static function findManyBy(string $sql, array $data): array {
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);
        $data = $stmt->fetchAll();
        $objects = [];
        foreach($data as $element) {
            $objects[] = self::fill($element);
        }
        return $objects;
    }
}

