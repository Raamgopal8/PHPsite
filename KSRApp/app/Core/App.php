<?php
namespace App\Core;

use App\Config\database;

class App
{
    public $db;

    public function __construct()
    {
        // Don't connect to database immediately - only when needed
        // This allows the app to work even if MySQL isn't running
        // Controllers can call $this->getDb() when they need database access
        
        // Ensure session directory exists (but don't modify ini here)
        $sessPath = $_ENV['SESSION_PATH'] ?? __DIR__ . '/../../storage/sessions';
        if (!is_dir($sessPath)) {
            mkdir($sessPath, 0777, true);
        }
    }
    
    public function getDb()
    {
        if ($this->db === null) {
            $this->db = database::getConnection();
        }
        return $this->db;
    }
}
