<?php
namespace App\Models;

class Achiever extends BaseModel {
    protected $table = 'achievers';
    
    public function __construct($db) {
        parent::__construct($db);
    }

    public function add($name, $exam, $rank, $photo = null) {
        return $this->insert([
            'name' => $name,
            'exam' => $exam,
            'rank' => $rank,
            'photo' => $photo
        ]);
    }
}
