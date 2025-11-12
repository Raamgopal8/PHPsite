<?php
namespace App\Core;

use App\Config\database;

class App
{
    public $db;

    public function __construct()
    {
        // Connect to MongoDB
        $this->db = database::getConnection();

        // Ensure session directory exists (but don't modify ini here)
        $sessPath = $_ENV['SESSION_PATH'] ?? __DIR__ . '/../../storage/sessions';
        if (!is_dir($sessPath)) {
            mkdir($sessPath, 0777, true);
        }
    }
}
