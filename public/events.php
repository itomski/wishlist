<?php
session_start();

use BlakvGhost\PHPValidator\Validator;
use BlakvGhost\PHPValidator\ValidatorException;
use Ramsey\Uuid\Uuid;
use Wishlist\ORM\Event;
use Wishlist\DebugUtils;

require_once '../vendor/autoload.php';

$data = $_POST;

$rules = [
    'name' => 'required|string|min:2|max:50'
];

try {
    $validator = new Validator($data, $rules);

    if($validator->isValid()) {
        
        $event = new Event($data['name']);
        $event->setDescription($data['description']);
        $event->setStartAt($data['start_at'] ? strtotime($data['start_at']) : null);
        //$event->setLocation(null);
        if($event->save()) {
            header('Location: index.php?a=events');
            die();
        }
        else {
            // TODO: Fehlermeldung
            header('Location: index.php?a=events');
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