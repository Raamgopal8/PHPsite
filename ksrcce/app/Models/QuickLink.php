<?php

namespace App\Models;

class QuickLink extends BaseModel {
    protected $table = 'quick_links';
    
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY sort_order ASC, created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (title, url, icon, is_active, sort_order, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $data['title'],
            $data['url'],
            $data['icon'] ?? 'link',
            $data['is_active'] ?? 1,
            $data['sort_order'] ?? 0
        ]);
    }
    
    public function update($id, $data) {
        $fields = [];
        $values = [];
        
        if (isset($data['title'])) {
            $fields[] = "title = ?";
            $values[] = $data['title'];
        }
        if (isset($data['url'])) {
            $fields[] = "url = ?";
            $values[] = $data['url'];
        }
        if (isset($data['icon'])) {
            $fields[] = "icon = ?";
            $values[] = $data['icon'];
        }
        if (isset($data['is_active'])) {
            $fields[] = "is_active = ?";
            $values[] = $data['is_active'];
        }
        if (isset($data['sort_order'])) {
            $fields[] = "sort_order = ?";
            $values[] = $data['sort_order'];
        }
        
        if (empty($fields)) return false;
        
        $fields[] = "updated_at = NOW()";
        $values[] = $id;
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function toggleStatus($id) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET is_active = NOT is_active, updated_at = NOW() 
            WHERE id = ?
        ");
        return $stmt->execute([$id]);
    }
    
    public function reorder($links) {
        $this->db->beginTransaction();
        try {
            foreach ($links as $index => $linkId) {
                $stmt = $this->db->prepare("
                    UPDATE {$this->table} 
                    SET sort_order = ?, updated_at = NOW() 
                    WHERE id = ?
                ");
                $stmt->execute([$index, $linkId]);
            }
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
}
