<?php
require_once __DIR__ . '/../../vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable('/app');
// $dotenv->load();

class Database {
    private $host;
    private $database;
    private $username;
    private $password;
    private $port;
    public $conn;

    public function __construct() {
        $this->host     = getenv('DB_HOST');
        $this->port     = getenv('DB_PORT');
        $this->database = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
    }

    public function dbConnection(){
        $this->conn = null;
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("Connection failed: " . $e->getMessage());
        }

        return $this->conn;
    }
}
