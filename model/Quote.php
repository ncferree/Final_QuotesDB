<?php 
class Quote {

    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author;
    public $category;
    public $authorId;
    public $categoryId;
    public $limit;

    public function __construct($db) {
        $this->conn = $db;
    }

        //get all quotes
        public function read() { 

            $query = 'SELECT Q.id, Q.quote, A.author, C.category, Q.authorId, Q.categoryId
                        FROM ' . $this->table . ' Q 
                        LEFT JOIN authors A ON Q.authorId = A.id
                        LEFT JOIN categories C ON Q.categoryId = C.id
                        ORDER BY Q.authorId DESC';
                  
            $statement = $this->conn->prepare($query);
              
                 
            $statement->execute();
            return $statement;
        }

        //Get single quote
        public function read_single() {
            $query = 'SELECT Q.id, Q.quote, A.author, C.category
            FROM ' . $this->table . ' Q 
            LEFT JOIN authors A ON Q.authorId = A.id 
            LEFT JOIN categories C ON Q.categoryId = C.id 
            WHERE Q.id = ? 
            ORDER BY Q.authorId DESC
            LIMIT 0,1';
            
            $statement = $this->conn->prepare($query);
            $statement->bindParam(1, $this->id);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->author = $row['author'];
            $this->category = $row['category'];

        }

        //create quote
        public  function create() {
        
            $query = 'INSERT INTO ' . $this->table . ' 
                        SET id = :id, quote = :quote, authorId = :authorId, categoryId = :categoryId';
            $statement = $this->conn->prepare($query);
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $statement->bindParam(':id', $this->id);
            $statement->bindParam(':quote', $this->quote);
            $statement->bindParam(':authorId', $this->authorId);
            $statement->bindParam(':categoryId', $this->categoryId);
            if($statement->execute()) {
                return true;
            }
            printf("Error: %s\n",$statement->error);
                return false;
        }

        //updtae quote
        public  function update() {
        
            $query = 'UPDATE ' . $this->table . ' 
                        SET id = :id, quote = :quote, authorId = :authorId, categoryId = :categoryId
                        WHERE id = :id ';
            $statement = $this->conn->prepare($query);
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $statement->bindParam(':id', $this->id);
            $statement->bindParam(':quote', $this->quote);
            $statement->bindParam(':authorId', $this->authorId);
            $statement->bindParam(':categoryId', $this->categoryId);
            if($statement->execute()) {
                return true;
            }
            json_encode("Error: %s\n",$statement->error);
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
            json_encode("Error: %s\n",$statement->error);
                return false;
        }
}