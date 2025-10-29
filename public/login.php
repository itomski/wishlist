<?php
session_start();

use Wishlist\Database;

require_once '../vendor/autoload.php';

$data = $_POST;

$dbh = Database::getInstance()->getConnection();
$sql = 'SELECT * FROM users WHERE LOWER(name) = LOWER(?)';
$stmt = $dbh->prepare($sql);
$stmt->execute([$data['name']]);
$user = $stmt->fetch();

if($user != null) {
    if(password_verify($data['password'], $user['password'])) {
        $_SESSION['login'] = true;
        header('Location: index.php'); // Umleitung auf die Startseite
    }
    else {
        echo 'Falsche Zugangsdaten!<br>';
    }
}
else {
    echo 'Falsche Zugangsdaten!<br>';
}