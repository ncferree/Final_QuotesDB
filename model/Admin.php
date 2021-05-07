<?php
class Admin {

    private $conn;
    private $table = 'administrators';

    public $id;
    public $quote;
    public $authorId;
    public $categoryId;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    //function to register a new admin
    public function add_admin($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO ' . $this->table . ' (username, password)
                    VALUES (:username, :password)';
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hash);
        $statement->execute();
        $statement->closeCursor();
    }

    //function to see is password and username are valid
    public function is_valid_admin($username, $password) {
        $query = 'SELECT password FROM ' . $this->table . ' 
                    WHERE username = :username';
        $statement = $this->conn->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = (!empty($row['password'])) ? $row['password'] : NULL; 
        return password_verify($password, $hash);
    }

    //Function to see if username exists
    public function username_exists($username) {
        $query = "SELECT COUNT(*) FROM ' . $this->table . ' WHERE username = :username";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }
}