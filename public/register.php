<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Ramsey\Uuid\Uuid;
use Wishlist\Database;

require_once '../vendor/autoload.php';

$data = $_POST;
$rules = [
    'name' => 'required|alpha_num|min:2|max:25',
    'email' => 'required|email',
    'password' => 'required|min:4|max:30',
    'password_conformation' => 'required|same:password',
];

echo '<pre>';
try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        // TODO: Daten speichern
        $dbh = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO users (id, name, email, password) VALUES(UUID_TO_BIN(:id),:name,LOWER(:email),:password)';
        $stmt = $dbh->prepare($sql);

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['id'] = Uuid::uuid4();
        unset($data['password_conformation']);

        $stmt->execute($data);
        if($dbh->lastInsertId() != null) {
            echo 'User wurde gespeichert<br>';
        }    
    }
    else {
        // TODO: Auf das Formular zurückspringen und Fehler anzeigen
        print_r($validator->getErrors());
    }
}
catch(ValidatorException $e) {
    echo $e->getMessage();
}
echo '</pre>';