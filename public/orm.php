<?php
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

