<?php

use Wishlist\AccountUtils;
use Wishlist\DataGateway;
use Wishlist\DebugUtils;
use Wishlist\ORM\Event;
use Wishlist\ORM\User;

session_start();

require_once '../vendor/autoload.php';

$action = filter_input(INPUT_GET, 'a') ?? '';

/*
$subTpl = match(strtolower($action)) {
    'login' => 'login.tpl.php',
    'register' => 'register.tpl.php',
    'events' => 'events.tpl.php',
    'locations' => 'locations.tpl.php',
    'playlists' => 'playlists.tpl.php',
    'logout' => AccountUtils::logOut(),
    default => 'welcome.tpl.php'
};
*/

switch(strtolower($action)) {
    case 'login': 
        $subTpl = 'login.tpl.php';
        break;

    case 'register': 
        $subTpl = 'register.tpl.php';
        break;

    case 'events':
        AccountUtils::loginRequired();
        //$data = DataGateway::getAllEventsByUser($_SESSION['user']['id']);
        $data = Event::findByUser(AccountUtils::getUser());
        $subTpl = 'events.tpl.php';
        break;

    case 'locations': 
        AccountUtils::loginRequired();
        $data = DataGateway::getAllLocations();
        $subTpl = 'locations.tpl.php';
        break;

    case 'playlists':
        AccountUtils::loginRequired();
        $subTpl = 'playlists.tpl.php';
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