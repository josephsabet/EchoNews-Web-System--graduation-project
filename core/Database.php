<?php

namespace Core;

use mysqli;
use Exception;

class Database {
    private static $instance = null;
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;

    // Load credentials from environment variables (set in .env or server config)
    // Falls back to safe XAMPP localhost defaults if no env is set.
    private function loadConfig() {
        $this->host   = getenv('DB_HOST')   ?: '127.0.0.1';
        $this->user   = getenv('DB_USER')   ?: 'root';
        $this->pass   = getenv('DB_PASS')   ?: '';
        $this->dbname = getenv('DB_NAME')   ?: 'news';
        $this->port   = (int)(getenv('DB_PORT') ?: 3307);
    }

    // Private constructor to prevent multiple instances
    private function __construct() {
        $this->loadConfig();
        // We use exception handling to deal with connection errors cleanly
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
        try {
            $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname, $this->port);
            $this->connection->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("Database Connection failed: " . $e->getMessage());
        }
    }

    // Method to get the single instance of the database class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the mysqli connection object
    public function getConnection() {
        return $this->connection;
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserialization of the instance
    public function __wakeup() {
        throw new Exception("Cannot unserialize a singleton.");
    }
}
