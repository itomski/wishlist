<?php
session_start();

use Wishlist\Database;
use Wishlist\AccountUtils;

require_once '../vendor/autoload.php';

$data = $_POST;

$dbh = Database::getInstance()->getConnection();

$sql = 'SELECT BIN_TO_UUID(id) AS id, name, password, created_at FROM users 
            WHERE LOWER(name) = LOWER(?)
            AND deleted_at IS NULL';

$stmt = $dbh->prepare($sql);
$stmt->execute([$data['name']]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$user = $stmt->fetch();

if($user != null) {
    if(password_verify($data['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location: index.php'); // Umleitung auf die Startseite
    }
    else {
        header('Location: index.php?a=login&i=error');
    }
}
else {
    header('Location: index.php?a=login&i=error');
}