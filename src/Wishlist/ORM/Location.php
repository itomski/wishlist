<?php

namespace Wishlist\ORM;

use \Ramsey\Uuid\Uuid;
use \Wishlist\Database;
use \PDO;

class Location {

    // Erlaubte Attribute
    private $attributes = ['id', 'name', 'street', 'nr', 'zip', 'city', 'country'];

    use ActiveRecord;

    // CRUD

    // Create / Update
    public function save() {

        if(empty($this->data['id'])) {
            $this->data['id'] = Uuid::uuid4();
            $sql = 'INSERT INTO locations (id, name, street, nr, zip, city, country) 
                        VALUES(UUID_TO_BIN(:id), :name, :street, :nr, :zip, :city, :country)';
        }
        else {
            $sql = 'UPDATE locations SET name = :name, street = :street, nr = :nr,
                        zip = :zip, city = :city, country = :country
                        WHERE id = UUID_TO_BIN(:id)';
        }

        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        return $stmt->execute($this->data);
    }

    // Read

    public static function find(string $id): ?Location {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM locations WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject(__CLASS__); // Fragt einen Datensatz ab
    }

    public static function all(): array {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM locations';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // Delete
    public static function delete(string $id) {

        $sql = 'DELETE FROM locations WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}