<?php

namespace Wishlist\ORM;

use \Ramsey\Uuid\Uuid;
use \Wishlist\Database;
use \PDO;
use Wishlist\AccountUtils;



class Playlist {

    private $attributes = ['id', 'name', 'type', 'user_id'];

    use ActiveRecord;

    // CRUD
    // Create / Update
    public function save() {

        if(empty($this->data['id'])) {
            $this->id = Uuid::uuid4();
            $sql = 'INSERT INTO playlists (id, name, type, user_id) 
                        VALUES(UUID_TO_BIN(:id), :name, :type, UUID_TO_BIN(:user_id))';
        }
        else {
            $sql = 'UPDATE playlists SET name = :name, type = :type, user_id = UUID_TO_BIN(:user_id),
                        WHERE id = UUID_TO_BIN(:id)';
        }

        $this->user_id = AccountUtils::getUser()->getId();
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        return $stmt->execute($this->data);
    }

    // Read

    public static function find(string $id): ?Playlist {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM playlists WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject(__CLASS__); // Fragt einen Datensatz ab
    }

    public static function all(): array {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM playlists';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function allByCurrentUser(): array {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM playlists WHERE BIN_TO_UUID(user_id) = :user_id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $user_id = AccountUtils::getUser()->getId();
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // Delete
    public static function delete(string $id) {

        $sql = 'DELETE FROM playlists WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        if($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

}