<?php

namespace Wishlist\ORM;

use \Wishlist\Database;
use \Ramsey\Uuid\Uuid;

class User {

    private ?string $id = null;
    private string $name;
    private string $email;
    private ?string $password;
    private ?int $createdAt = null;
    private ?int $deletedAt = null;

    public function __construct(string $name, string $email, string $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?int $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?int $deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    // CRUD: Create, Read, Update, Delete

    use FindBy;

    public function save(): bool {

        $dbh = Database::getInstance()->getConnection();

        $sql = 'INSERT INTO users (id, name, email, password) VALUES(UUID_TO_BIN(:id),:name,LOWER(:email),:password)';
        $stmt = $dbh->prepare($sql);

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        $id = Uuid::uuid4();
        
        $stmt->execute([
            'id' => $id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        $insertId = $dbh->lastInsertId();
        if($insertId != null) {
            $this->id = $insertId;
            return true;
        }
        return false;
    }

    public static function find(int $id): ?User {

        $sql = 'SELECT u.*, BIN_TO_UUID(id) AS id  
                    FROM users AS u
                    WHERE id = ?';

        return self::findOneBy($sql, [$id]);
    }

    public static function findByName(string $name): ?User {

        $sql = 'SELECT u.*, BIN_TO_UUID(id) AS id 
                FROM users AS u 
                WHERE LOWER(name) = LOWER(?) AND deleted_at IS NULL';
        
        return self::findOneBy($sql, [$name]);
    }

    public static function findAll(): array {

        $sql = 'SELECT u.*, BIN_TO_UUID(id) AS id  
                    FROM users AS u';

        return self::findManyBy($sql, []);
    }

    private static function fill(array $data): ?User {
        if($data) {
            $user = new User($data['name'], $data['email'], $data['password']);
            $user->setId($data['id'])
                ->setCreatedAt($data['created_at'] ? strtotime($data['created_at']) : null)
                ->setDeletedAt($data['deleted_at'] ? strtotime($data['deleted_at']) : null);
            return $user;
        }
        return null;
    }
}