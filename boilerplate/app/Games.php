<?php
    class Games {
        private $conn;
        private $table_name = "games";

        public $id;
        public $name;
        public $platform;
        

        public function __construct($db){
            $this->conn = $db;
        }

        // Tampilkan data semua games
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

        // Tambah games ke database
        public function store(){
            $query = "INSERT INTO {$this->table_name} 
                    ( name, platform) 
                    VALUES (?, ?)
                    ";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->name, 
                $this->platform, 
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

        // Update games ke database
        public function update(){
            $query = "UPDATE {$this->table_name} 
                    SET name=?, platform=?
                    WHERE id=?";
            $data = $this->conn->prepare($query);
        
            $data->execute([
                $this->name, 
                $this->platform,  
                $this->id
            ]);
        
            return $data->rowCount() > 0;
        }

        // Hapus games dari database
        public function delete(){
            $query = "DELETE FROM {$this->table_name} WHERE id = ?";
            $data = $this->conn->prepare($query);
            $data->execute([$this->id]);
        
            return $data->rowCount() > 0;
        }
    }
?>