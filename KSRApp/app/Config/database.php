<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            // Get database configuration from environment variables
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $port = $_ENV['DB_PORT'] ?? '3306';
            $dbname = $_ENV['DB_DATABASE'] ?? 'cce';
            $username = $_ENV['DB_USERNAME'] ?? 'root';
            $password = $_ENV['DB_PASSWORD'] ?? '';

            try {
                // Force TCP/IP connection by using 127.0.0.1 instead of localhost
                $host = ($host === 'localhost') ? '127.0.0.1' : $host;
                
                // Add socket configuration if needed (uncomment and set the correct path if using sockets)
                // $socket = '/var/run/mysqld/mysqld.sock'; // Common path on Linux
                // $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4;unix_socket={$socket}";
                
                $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_PERSISTENT         => false, // Set to false to prevent connection pooling issues
                ];
                
                // Add error reporting for debugging
                error_log("Attempting to connect to MySQL: {$host}:{$port}");
                self::$connection = new PDO($dsn, $username, $password, $options);
                error_log("Successfully connected to MySQL");
                
            } catch (PDOException $e) {
                die("MySQL Connection Error: " . $e->getMessage() . "\n");
            }
        }
        
        return self::$connection;
    }
}