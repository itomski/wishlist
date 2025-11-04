<?php

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Wishlist\ORM\Song;

require_once '../vendor/autoload.php';

$data = $_POST;

$rules = [
    'interpret' => 'required|string|min:2|max:50',
    'title' => 'required|string|min:2|max:50',
    'playlist_id' => 'required|string|min:2|max:50'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $song = new Song($data); // By playlist_id auch in die JOIN-Table speichern
        if($song->save()) {
            header('Location: index.php?a=songs&p='.$data['playlist_id']);
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