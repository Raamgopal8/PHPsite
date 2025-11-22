<?php
namespace App\Models;

class BaseModel {
    protected $db;
    protected $table;

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($conditions) {
        $where = [];
        $params = [];
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $params[] = $value;
        }
        $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} $whereClause LIMIT 1");
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($data));
        return $this->db->lastInsertId();
    }

    public function update($conditions, $data) {
        $set = [];
        $params = [];
        
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
            $params[] = $value;
        }
        
        $where = [];
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $params[] = $value;
        }
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $set) . " WHERE " . implode(' AND ', $where);
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($conditions) {
        $where = [];
        $params = [];
        
        foreach ($conditions as $key => $value) {
            $where[] = "$key = ?";
            $params[] = $value;
        }
        
        $sql = "DELETE FROM {$this->table} WHERE " . implode(' AND ', $where);
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
}