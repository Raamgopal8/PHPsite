<?php
namespace App\Models;

class BaseModel {
    protected $db;
    protected $collection;

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        return $this->db->{$this->collection}->find()->toArray();
    }

    public function find($filter) {
        return $this->db->{$this->collection}->findOne($filter);
    }

    public function insert($doc) {
        return $this->db->{$this->collection}->insertOne($doc);
    }

    public function update($filter, $update) {
        return $this->db->{$this->collection}->updateOne($filter, ['$set' => $update]);
    }

    public function delete($filter) {
        return $this->db->{$this->collection}->deleteOne($filter);
    }
}
