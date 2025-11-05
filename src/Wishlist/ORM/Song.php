<?php

namespace Wishlist\ORM;

use JsonSerializable;
use \Wishlist\Database;
use \Ramsey\Uuid\Uuid;
use \PDO;
use PDOException;

class Song implements JsonSerializable {

    private $attributes = ['id', 'interpret', 'title', 'playlist_id'];

    use ActiveRecord;

    public function save() {

        $playlist_id = $this->data['playlist_id'];
        unset($this->data['playlist_id']);

        /* if(empty($this->data['id'])) { */
            $this->data['id'] = Uuid::uuid4();
            $sql = 'INSERT INTO songs (id, interpret, title) 
                        VALUES(UUID_TO_BIN(:id), :interpret, :title)';
        /*
        }
        else {
            $sql = 'UPDATE locations SET interpret = :interpret, title = :title
                        WHERE id = UUID_TO_BIN(:id)';
        }
        */

        try {
            $dbh = Database::getInstance()->getConnection();
            $dbh->beginTransaction();
            
            $stmt = $dbh->prepare($sql);
            $stmt->execute($this->data);
            
            $sql = 'INSERT INTO songs_to_playlist (song_id, playlist_id) 
                    VALUES(UUID_TO_BIN(:song_id), UUID_TO_BIN(:playlist_id))';

            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':song_id', $this->data['id']);
            $stmt->bindParam(':playlist_id', $playlist_id);
            $stmt->execute();

            $dbh->commit();
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    // Read

    public static function find(string $id): ?Song {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM songs WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject(__CLASS__); // Fragt einen Datensatz ab
    }

    public static function all(): array {

        $sql = 'SELECT *, BIN_TO_UUID(id) AS id FROM songs';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    public static function allByPlaylist(string $id): array {

        $sql = 'SELECT songs.*, BIN_TO_UUID(songs.id) AS id 
                    FROM songs_to_playlist LEFT JOIN songs
                    ON songs_to_playlist.song_id = songs.id
                    WHERE songs_to_playlist.playlist_id = UUID_TO_BIN(:playlist_id)';

        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':playlist_id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, __CLASS__);
    }

    // Delete
    public static function delete(string $id) {

        $sql = 'DELETE FROM songs WHERE BIN_TO_UUID(id) = :id';
        $dbh = Database::getInstance()->getConnection();
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function jsonSerialize(): array {
        $arr = get_object_vars($this);
        return $arr['data'];
    }
}