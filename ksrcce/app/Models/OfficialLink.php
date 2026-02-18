<?php

namespace App\Models;

class OfficialLink extends BaseModel {
    protected $table = 'official_links';
    
    public function getLinks() {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC")->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (title, url) VALUES (?, ?)");
        return $stmt->execute([$data['title'], $data['url']]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
