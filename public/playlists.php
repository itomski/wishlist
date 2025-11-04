<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Wishlist\ORM\Playlist;

require_once '../vendor/autoload.php';

session_start();

$data = $_POST;

$rules = [
    'name' => 'required|string|min:2|max:50'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $location = new Playlist($data);
        if($location->save()) {
            header('Location: index.php?a=playlists');
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