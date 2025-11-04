<?php

namespace Wishlist\ORM;

trait ActiveRecord {

    private mixed $data = [];

    public function __construct(array $data = [])
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __get(string $attr): mixed
    {
        if(array_key_exists($attr, $this->data)) {
            return $this->data[$attr];
        }
        return null;
    }

    public function __set(string $attr, mixed $value)
    {
        if(in_array($attr, $this->attributes))
            $this->data[$attr] = $value;
    }
}