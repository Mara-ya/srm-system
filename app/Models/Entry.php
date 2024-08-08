<?php

namespace App\Models;

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class Entry {
    private $collection;

    public function __construct() {
        $client = new Client("mongodb://localhost:27017");
        $this->collection = $client->mydatabase->entries;
    }

    public static function find($query = []) {
        $instance = new self();
        return $instance->collection->find($query)->toArray();
    }

    public static function findById($id) {
        $instance = new self();
        return $instance->collection->findOne(['_id' => new ObjectId($id)]);
    }

    public function save() {
        $data = [
            'user_id' => $this->user_id,
            'hours' => $this->hours,
            'day' => $this->day,
            'comment' => $this->comment,
        ];
        return $this->collection->insertOne($data);
    }

    public function update($id, $data) {
        return $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
    }
}
