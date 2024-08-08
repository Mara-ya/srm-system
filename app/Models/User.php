<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class User {
    private $collection;

    public function __construct() {
        $client = new Client("mongodb://localhost:27017");
        $this->collection = $client->mydatabase->users;
    }

    public static function find($query = []) {
        $instance = new self();
        return $instance->collection->findOne($query);
    }

    public static function findById($id) {
        $instance = new self();
        return $instance->collection->findOne(['_id' => new ObjectId($id)]);
    }

    public static function findAll() {
        $instance = new self();
        return $instance->collection->find()->toArray();
    }

    public function save() {
        $data = [
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role,
        ];
        return $this->collection->insertOne($data);
    }

    public function update($id, $data) {
        return $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
    }
}
