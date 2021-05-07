<?php
    class Database {
        private $conn;

        public function connect() {
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);

            $hostname = $dbparts['host'];
            $username = $dbparts['user'];
            $password = $dbparts['pass'];
            $database = ltrim($dbparts['path'],'/');
            
            $this->conn = null;
           

            try{
                $this->conn = new PDO('mysql: host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }
