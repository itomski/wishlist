<?php

use Wishlist\ORM\User;
use Wishlist\ORM\Event;
use Wishlist\ORM\Location;

require_once '../vendor/autoload.php';
/*
// DataMapper

class Event {

    // Attribute
    // Konstruktor
    // Getter-Setter
}

class EventMapper {

    // Persistenz-Methoden
    public function save(Event $e) { 
        //...
    }

    public function findAll(): array { // array von Events
        //...
    }

    public function find(int $id): Event {
        //...
    }
    //... weitere Methoden
}

$e = new Event();
// Event mit Daten befüllen
$mapper = new EventMapper();
$mapper->save($e);

$events = $mapper->findAll();

*/

/*
// Active Record

class Event {

    // Attribute
    // Konstruktor
    // Getter-Setter
    // Persistenz-Methoden
}


$e = new Event();
// Event mit Daten befüllen
$e->save();

$events = Event::findAll();
*/

/*
use Wishlist\ORM\User;
use Wishlist\ORM\Event;

require_once '../vendor/autoload.php';

$users = User::findAll();

echo '<pre>';
print_r($users);
echo '</pre>';

$events = Event::findByUser($users[0]);

echo '<pre>';
print_r($events);
echo '</pre>';
*/

echo '<pre>';
$location = Location::find('87f416b0-11dc-432a-8636-ca0b2c5963e5');
print_r($location);
echo '</pre>';

echo '<pre>';
$locations = Location::all();
print_r($locations);
echo '</pre>';
