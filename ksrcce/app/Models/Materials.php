<?php
namespace App\Models;

class Material extends BaseModel {
    protected $table = 'materials';
    public function __construct($db) { parent::__construct($db); }

    public function upload($title, $filePath, $type, $subject) {
        return $this->insert([
            'title' => $title,
            'file' => $filePath,
            'type' => $type,
            'subject' => $subject,
            'created_at' => date('c')
        ]);
    }
}
