<?php 
class Category {

    private $conn;
    private $table = 'categories';

    public $id;
    public $category;
  

    public function __construct($db) {
        $this->conn = $db;
    }

    //get all categries
    public function read() {
 
        $query = 'SELECT * FROM ' . $this->table . ' C ORDER BY id';
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement;
    }

    //Get single category
    public function read_single() {
        $query = 'SELECT id, category FROM ' . $this->table . ' 
        WHERE id = ? 
        ORDER BY id DESC
        LIMIT 0,1';
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->category = $row['category'];
    }

     //create category
     public  function create() {
     
        $query = 'INSERT INTO ' . $this->table . ' 
                    SET id = :id, category = :category';
        $statement = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':category', $this->category);
       
        if($statement->execute()) {
            return true;
        }
        printf("Error: %s\n",$statement->error);
            return false;
    }

      //update category
      public  function update() {
     
        $query = 'UPDATE ' . $this->table . ' 
                    SET id = :id, category = :category
                    WHERE id = :id ';
        $statement = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $statement->bindParam(':id', $this->id);
        $statement->bindParam(':category', $this->category);
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