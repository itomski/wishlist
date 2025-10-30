<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Ramsey\Uuid\Uuid;
use Wishlist\Database;

require_once '../vendor/autoload.php';

$data = $_POST;

$rules = [
    'name' => 'required|string|min:2|max:50'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $dbh = Database::getInstance()->getConnection();
        $sql = 'INSERT INTO locations (id, name, street, nr, zip, city, country) 
                    VALUES(UUID_TO_BIN(:id),:name, :street, :nr, :zip, :city, :country)';
        $stmt = $dbh->prepare($sql);

        $data['id'] = Uuid::uuid4();

        $stmt->execute($data);
        if($dbh->lastInsertId() != null) {
            header('Location: index.php?a=locations');
            die();
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