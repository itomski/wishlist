<?php
session_start();

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Wishlist\ORM\Event;
use Wishlist\ORM\Playlist;

require_once '../vendor/autoload.php';

$data = $_POST;

$rules = [
    'event_id' => 'required|string|min:2|max:100',
    'playlist_id' => 'required|string|min:2|max:100'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $event = Event::findById($data['event_id']);
        $playlist = Playlist::find($data['playlist_id']);

        // TODO: Nur speichern, wenn nicht bereits vorhanden
        $event->addPlaylist($playlist);

        if($event->savePlaylist()) {
            header('Location: index.php?a=event&e='.$data['event_id']);
            die();
        }
        else {
            // TODO: Fehlermeldung
            header('Location: index.php?a=event&e='.$data['event_id']);
            die();
        }
    }
    else {
        // TODO: Auf das Formular zurückspringen und Fehler anzeigen
        print_r($validator->getErrors());
    }
}
catch( ValidatorException $e) {
    echo $e->getMessage();
}