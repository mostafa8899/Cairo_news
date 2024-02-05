<?php

class DatabaseConnection {
    private static $instance = null;
    private $db;

    private function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=caironews", "root", "");
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function executeQuery($query) {
        $stmt = $this->db->prepare($query);
        return $stmt->execute();
    }

    public function closeConnection() {
        $this->db = null;
    }
}

?>