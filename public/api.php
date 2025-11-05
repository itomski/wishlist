<?php

require_once '../vendor/autoload.php';

use Wishlist\ORM\Event;
use Wishlist\ORM\Song;
use Wishlist\ORM\Location;
use Wishlist\ORM\Playlist;
use Wishlist\ORM\User;

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'GET') { // ABFRAGE

    /*
    $action = filter_input(INPUT_GET, 'a');
    $data = match($action) {
        'songs' => Song::all(),
        'playlists' => Playlist::all(), // TODO: checken
        'locations' => Location::all(),
        'users' => User::findAll(),
        'events' => Event::findAll(),
        default => []
    };
    */
    $data = Song::all();
    echo json_encode($data);
}
elseif($_SERVER['REQUEST_METHOD'] === 'POST') { // HINZUFÜGEN
    $song = new Song($_POST);
    if($song->save()) {
        http_response_code(201);
        echo json_encode($song);
    }
    else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON']);
        die();
    }
    
}
elseif($_SERVER['REQUEST_METHOD'] === 'PUT') { // UPDATE
    // TODO: Update implementieren
    echo json_encode(['success' => 'PUT']);
}
elseif($_SERVER['REQUEST_METHOD'] === 'DELETE') { // DELETE
    
    $id = filter_input(INPUT_GET, 'id');
    if(Song::delete($id)) {
        echo json_encode(['success' => 'Song deleted']);
    }
    else {
        http_response_code(404);
        echo json_encode(['error' => 'Song not found']);
    }
}
else { // ERROR
    http_response_code(404);
    echo json_encode(['error' => 'Aktion nicht möglich']);
}