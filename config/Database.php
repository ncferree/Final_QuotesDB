<?php
    class Database {
        private $host = 'y5svr1t2r5xudqeq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
        private $db_name = 'xwvy9vqpsbr4t2zg';
        private $username = 'sm1azw3h03hq7ck5';
        private $password = 's0m5d8d13lpuhn7f';
        private $conn;

        public function connect() {
         
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
