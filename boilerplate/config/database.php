<?php
echo 'Current path: ' . __DIR__ . '<br>';
echo 'Looking for: ' . realpath(__DIR__ . '/../../vendor/autoload.php') . '<br>';
echo file_exists(__DIR__ . '/../../vendor/autoload.php') ? '✅ Found' : '❌ Not found';
echo file_exists(__DIR__ . '/../vendor/autoload.php') ? '✅ Found' : '❌ Not found';


require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..'); 
$dotenv->load();

class Database {
    private $host;
    private $database;
    private $username;
    private $password;
    private $port;
    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->port = $_ENV['DB_PORT'];
        $this->database = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
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
