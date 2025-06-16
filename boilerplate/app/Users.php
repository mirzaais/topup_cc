<?php
    class Users {
        private $conn;
        private $table_name = "users";

        public $id;
        public $username;
        public $email;
        public $password;
        public $balance;
        

        public function __construct($db){
            $this->conn = $db;
        }

        // Tampilkan data semua user
        public function index(){
            $query = "SELECT * FROM {$this->table_name}";
            $data = $this->conn->prepare($query);
            $data->execute();
            return $data;
        }

        // Tampilkan halaman create
        public function create(){
            header("Location: create.php");
            exit();
        }

        // Tambah user ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    (username, email, password, balance) 
                    VALUES (?, ?, ?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->username, 
                $this->email, 
                $this->password, 
                $this->balance, 
                
            ]);
        
            return $data->rowCount() > 0;
        }

        // Tampilkan halaman edit
        public function edit(){
            $query = "SELECT * FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
            return $data;
        }

        // Update user ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET username=?, email=?, password=?, balance=?
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->username, 
                $this->email, 
                $this->password, 
                $this->balance, 
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus produk dari database
        public function delete(){
            try {
                // Nonaktifkan kunci asing sementara
                $query_disable_fk = "SET FOREIGN_KEY_CHECKS=0";
                $stmt_disable_fk = $this->conn->prepare($query_disable_fk);
                $stmt_disable_fk->execute();
        
                // Lakukan penghapusan
                $query = "DELETE FROM {$this->table_name} WHERE id = ?";
                $data = $this->conn->prepare($query);
                $data->execute([$this->id]);
        
                // Aktifkan kembali kunci asing
                $query_enable_fk = "SET FOREIGN_KEY_CHECKS=1";
                $stmt_enable_fk = $this->conn->prepare($query_enable_fk);
                $stmt_enable_fk->execute();
            
                return $data->rowCount() > 0;
            } catch (PDOException $e) {
                // Tangani kesalahan eksekusi query
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>