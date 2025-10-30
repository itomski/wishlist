<?php
session_start();

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Ramsey\Uuid\Uuid;
use Wishlist\Database;
use Wishlist\DebugUtils;

require_once '../vendor/autoload.php';

$data = $_POST;

$rules = [
    'name' => 'required|string|min:2|max:50'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $dbh = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO events (id, name, description, location_id, start_at, user_id) 
                    VALUES(UUID_TO_BIN(:id),:name, :description, UUID_TO_BIN(:location_id), :start_at, UUID_TO_BIN(:user_id))';
        $stmt = $dbh->prepare($sql);

        $data['id'] = Uuid::uuid4();
        $data['user_id'] = $_SESSION['user']['id'];

        $stmt->execute($data);
        if($dbh->lastInsertId() != null) {
            header('Location: index.php?a=events');
            die();
        }
        DebugUtils::setDebugMode(false);
        DebugUtils::print([$data]);
    }
    else {
        // TODO: Auf das Formular zurückspringen und Fehler anzeigen
        print_r($validator->getErrors());
    }
}
catch(ValidatorException $e) {
    echo $e->getMessage();
}