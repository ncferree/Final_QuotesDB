<?php 
class Author {
    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    //get all authors
    public function read() {
        $query = 'SELECT * FROM ' . $this->table . '  ORDER BY id';
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    //Get single author
    public function read_single() {
        $query = 'SELECT id, author FROM ' . $this->table . ' 
        WHERE id = ? 
        ORDER BY id DESC
        LIMIT 0,1';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->author = $row['author'];
    }

     //create author
     public  function create() {
     
        $query = 'INSERT INTO ' . $this->table . ' 
                    SET id = :id, author = :author';
        $statement = $this->conn->prepare($query);
        $this->author = htmlspecialchars(strip_tags($this->author));
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':author', $this->author);
       
        if($statement->execute()) {
            return true;
        }
        printf("Error: %s\n",$statement->error);
            return false;
    }

       //updtae author
       public  function update() {
     
        $query = 'UPDATE ' . $this->table . ' 
                    SET id = :id, author = :author
                    WHERE id = :id ';
        $statement = $this->conn->prepare($query);
        $this->author = htmlspecialchars(strip_tags($this->author));
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':author', $this->author);
        if($statement->execute()) {
            return true;
        }
        printf("Error: %s\n",$statement->error);
            return false;
    }

       //delete quote
       public function delete() {
        $query = 'DELETE FROM '. $this->table . ' WHERE id = :id' ;
        $statement = $this->conn->prepare($query);
        $statement->bindParam(':id', $this->id);
        if($statement->execute()) {
            return true;
        }
        printf("Error: %s\n",$statement->error);
            return false;
    }
}