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
            $host = $_ENV['DB_HOST'] ?? null;
            $port = $_ENV['DB_PORT'] ?? '3306';
            $dbname = $_ENV['DB_DATABASE'] ?? null;
            $username = $_ENV['DB_USERNAME'] ?? null;
            $password = $_ENV['DB_PASSWORD'] ?? '';

            if (!$host || !$dbname || !$username) {
                die("Critical Error: Database configuration missing in .env (DB_HOST, DB_DATABASE, or DB_USERNAME).\n");
            }

            try {
                // Ensure we use the exact host provided, no localhost -> 127.0.0.1 mapping which can be confusing in containers
                $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
                
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                    PDO::ATTR_PERSISTENT         => false,
                ];

                self::$connection = new PDO($dsn, $username, $password, $options);
                // Set timezone to IST
                self::$connection->exec("SET time_zone = '+05:30'");
                
            } catch (PDOException $e) {
                // Security: Don't reveal full error details in die() for production
                error_log("Database Connection Error: " . $e->getMessage());
                die("A database error occurred. Please try again later.\n");
            }
        }
        
        return self::$connection;
    }
}