<?php

namespace App\Core;

use MongoDB\Client;

class Model {
    protected $collection;

    public function __construct() {
        $this->client = new Client("mongodb://localhost:27017");
        $this->database = $this->client->selectDatabase('mydatabase');
    }

    public function getCollection() {
        return $this->database->selectCollection($this->collection);
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
