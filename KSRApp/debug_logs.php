<?php
require_once 'vendor/autoload.php';
require_once 'app/Config/database.php';

use App\Config\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $db = Database::getConnection();
    echo "Database connection successful.\n";

    $sql = "CREATE TABLE IF NOT EXISTS login_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ip_address VARCHAR(45),
        user_agent VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        INDEX idx_user_id (user_id),
        INDEX idx_login_time (login_time)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $db->exec($sql);
    echo "Table 'login_logs' created or already exists.\n";

    $stmt = $db->query("DESCRIBE login_logs");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Table 'login_logs' exists. Columns:\n";
    foreach ($columns as $col) {
        echo "- " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }

    $stmt = $db->query("SELECT COUNT(*) as count FROM login_logs");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total rows in login_logs: " . $count . "\n";

    if ($count > 0) {
        $stmt = $db->query("SELECT * FROM login_logs ORDER BY id DESC LIMIT 1");
        $last = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Last log: " . print_r($last, true) . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
