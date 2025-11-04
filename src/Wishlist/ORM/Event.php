<?php

namespace Wishlist\ORM;

use PDOException;
use \Wishlist\Database;
use Ramsey\Uuid\Uuid;
use Wishlist\AccountUtils;

class Event {

    private ?string $id = null;
    private string $name;
    private ?string $description;
    private ?int $startAt;
    private ?Location $location = null;
    private array $playlists = [];
    private ?User $user;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
        return $this;
    }

    public function getStartAt(): ?int
    {
        return $this->startAt;
    }

    public function setStartAt(?int $startAt)
    {
        $this->startAt = $startAt;
        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location)
    {
        $this->location = $location;
        return $this;
    }

    public function getPlaylists(): array
    {
        return $this->playlists;
    }

    public function setPlaylists(?array $playlists)
    {
        if(is_array($playlists)) {
            $this->playlists = $playlists;
        }
        return $this;
    }

    public function addPlaylist(Playlist $playlist)
    {
        $this->playlists[] = $playlist;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user)
    {
        $this->user = $user;
        return $this;
    }
    
    // CRUD

    public function save(): bool {

        $dbh = Database::getInstance()->getConnection();

        $sql = 'INSERT INTO events (id, name, description, '.($this->location ? 'location_id,' : '').' start_at, user_id) 
                    VALUES(UUID_TO_BIN(:id),:name, :description, '.($this->location ? 'UUID_TO_BIN(:location_id),' : '').' :start_at, UUID_TO_BIN(:user_id))';
        $stmt = $dbh->prepare($sql);

        $data = ['name' => $this->name, 
                'description' => $this->description, 
                'start_at' => ($this->startAt) ? date('y-m-d H:i:s',$this->startAt) : null ];

        if($this->location) {
            $data['location_id'] = $this->location->id;
        }
       
        $data['id'] = Uuid::uuid4();
        $data['user_id'] = AccountUtils::getUser()->getId();

        $stmt->execute($data);
        
        $insertId = $dbh->lastInsertId();
        if($insertId != null) {
            $this->id = $insertId;
            return true;
        }
        return false;
    }

    public function savePlaylist(): bool {

        if(count($this->playlists) > 0) {
            try {
                $dbh = Database::getInstance()->getConnection();

                $sql = 'INSERT INTO playlists_to_events (playlist_id, event_id) 
                            VALUES(UUID_TO_BIN(?), UUID_TO_BIN(?))';
                
                $stmt = $dbh->prepare($sql);
                
                foreach($this->playlists as $playlist) {
                    $stmt->execute([$playlist->id, $this->getId()]);
                }
                return true;
            }
            catch(PDOException $e) {
                print_r($e->errorInfo);
                return false;
            }
        }
        return false;
    }


    use FindBy;

    public static function findByUser(User $user): array {

        $sql = 'SELECT e.*, BIN_TO_UUID(id) AS id FROM events AS e WHERE user_id = UUID_TO_BIN(?)';
        return self::findManyBy($sql, [$user->getId()]);
    }

    public static function findById(string $id): ?Event {

        $sql = 'SELECT e.*, BIN_TO_UUID(id) AS id FROM events AS e WHERE e.id = UUID_TO_BIN(?)';
        return self::findOneBy($sql, [$id]);
    }

    private static function fill(array $data): ?Event {
        if($data) {
            $event = new Event($data['name']);
            $event->setId($data['id']);
            $event->setDescription($data['description']);
            $event->setStartAt($data['start_at'] ? strtotime($data['start_at']) : null);
            // TODO: Playlist, User, Location hinzufügen
            /*
            $event->setLocation(); 
            $event->setPlaylists();
            $event->setUser();
            */
            return $event;
        }
        return null;
    }
}