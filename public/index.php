<?php

use Wishlist\AccountUtils;
use Wishlist\DataGateway;
use Wishlist\DataUtils;
use Wishlist\DebugUtils;
use Wishlist\ORM\Event;
use Wishlist\ORM\Location;
use Wishlist\ORM\Playlist;
use Wishlist\ORM\Song;
use Wishlist\ORM\User;

session_start();

require_once '../vendor/autoload.php';

DataUtils::init();

$action = filter_input(INPUT_GET, 'a') ?? '';

switch(strtolower($action)) {
    case 'login': 
        $subTpl = 'login.tpl.php';
        break;

    case 'register':
        $subTpl = 'register.tpl.php';
        break;

    case 'events':
        AccountUtils::loginRequired();
        $data = Event::findByUser(AccountUtils::getUser());
        $subTpl = 'events.tpl.php';
        break;

    case 'event':
        AccountUtils::loginRequired();
        $event_id = filter_input(INPUT_GET, 'e');
        $event = Event::findById($event_id);
        $data = Playlist::allByEvent($event);
        $subTpl = 'event.tpl.php';
        break;

    case 'remove': 
        AccountUtils::loginRequired();
        $playlist_id = filter_input(INPUT_GET, 'p');
        $event_id = filter_input(INPUT_GET, 'e');
        Playlist::deleteFromEvent($playlist_id, $event_id);
        header('Location: index.php?a=event&e='.$event_id);
        die();    
        break;

    case 'locations': 
        AccountUtils::loginRequired();
        $data = Location::all();
        $subTpl = 'locations.tpl.php';
        break;

    case 'playlists':
        AccountUtils::loginRequired();
        $data = Playlist::allByCurrentUser();
        $subTpl = 'playlists.tpl.php';
        break;

    case 'songs':
        AccountUtils::loginRequired();
        $playlistId = filter_input(INPUT_GET, 'p');
        $data = Song::allByPlaylist($playlistId);
        $subTpl = 'songs.tpl.php';
        break;

    case 'logout': 
        AccountUtils::logOut();
        break;

    default: 
        $subTpl = 'welcome.tpl.php';
}

include '../templates/standard.tpl.php';

DebugUtils::setDebugMode(false);
DebugUtils::print(['post' => $_POST, 'get' => $_GET, 'session' => $_SESSION, 'data' => ($data ?? [])]);