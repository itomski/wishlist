<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
//use Ramsey\Uuid\Uuid;
//use Wishlist\Database;
use Wishlist\ORM\User;

require_once '../vendor/autoload.php';

$data = $_POST;
$rules = [
    'name' => 'required|alpha_num|min:2|max:25',
    'email' => 'required|email',
    'password' => 'required|min:4|max:30',
    'password_conformation' => 'required|same:password',
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        // TODO: Daten speichern
        /*
        $dbh = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO users (id, name, email, password) VALUES(UUID_TO_BIN(:id),:name,LOWER(:email),:password)';
        $stmt = $dbh->prepare($sql);

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['id'] = Uuid::uuid4();
        unset($data['password_conformation']);

        $stmt->execute($data);
        if($dbh->lastInsertId() != null) {
            header('Location: index.php?a=login');
        }
        else {
            header('Location: index.php?a=register');
        }
        */
        $user = new User($data['name'], $data['email'], $data['password']);
        if($user->save()) {
            header('Location: index.php?a=login');
        }
        else {
            header('Location: index.php?a=register');
        }
    }
    else {
        // TODO: Fehler im Formular anzeigen
        header('Location: index.php?a=register');
    }
}
catch(ValidatorException $e) {
    echo $e->getMessage();
}