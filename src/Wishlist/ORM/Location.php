<?php

namespace Wishlist\ORM;

class Location {

    // ID als Trait auslagern
    private ?string $id = null;
    private string $name;
    private ?string $street;
    private ?string $nr;
    private ?string $zip;
    private ?string $city;
    private ?string $country;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street)
    {
        $this->street = $street;
        return $this;
    }

    public function getNr(): ?string
    {
        return $this->nr;
    }

    public function setNr(?string $nr)
    {
        $this->nr = $nr;
        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string  $zip)
    {
        $this->zip = $zip;
        return $this;
    }

    public function getCity(): ?string 
    {
        return $this->city;
    }

    public function setCity(?string $city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry(): ?string 
    {
        return $this->country;
    }

    public function setCountry(?string $country)
    {
        $this->country = $country;
        return $this;
    }

    /*
    // CRUD
    // Create
    public function save();

    // Read
    public static function find(string $id);
    public static function findByEvent(Event $event);
    public static function findAll();

    // Update
    public function update();

    // Delete
    public function delete();
    */
}