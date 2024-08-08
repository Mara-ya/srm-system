<?php

namespace App\Models;

use App\Core\Database;
use MongoDB\BSON\ObjectId;

class TimeEntry {
    public $id;
    public $user_id;
    public $hours;
    public $day;
    public $comment;

    public static function getEntriesByUser($user_id) {
        $collection = Database::getDatabase()->time_entries;
        $entries = $collection->find(['user_id' => new ObjectId($user_id)]);
        return $entries->toArray();
    }

    public function save() {
        $collection = Database::getDatabase()->time_entries;
        $result = $collection->insertOne([
            'user_id' => new ObjectId($this->user_id),
            'hours' => $this->hours,
            'day' => $this->day,
            'comment' => $this->comment,
        ]);
        return $result->getInsertedId();
    }
}
