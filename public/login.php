<?php


/*
use Wishlist\Database;
use Wishlist\AccountUtils;
*/
use Wishlist\ORM\User;

session_start();

require_once '../vendor/autoload.php';

/*
$data = $_POST;
$dbh = Database::getInstance()->getConnection();

$sql = 'SELECT BIN_TO_UUID(id) AS id, name, password, created_at FROM users 
            WHERE LOWER(name) = LOWER(?)
            AND deleted_at IS NULL';

$stmt = $dbh->prepare($sql);
$stmt->execute([$data['name']]);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$user = $stmt->fetch();
*/

$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'password');
$user = User::findByName($name);

if($user != null) {
    if(password_verify($password, $user->getPassword())) {
        $user->setPassword(null);
        $_SESSION['user'] = serialize($user);
        header('Location: index.php'); // Umleitung auf die Startseite
    }
    else {
        header('Location: index.php?a=login&i=error');
    }
}
else {
    header('Location: index.php?a=login&i=error');
}