<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Quote.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $quote = new Quote($db);

    //parameter data
    $authorId = filter_input(INPUT_GET, 'authorID', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);

    //pass parameter to model
    if ($authorId) { 
        $quote->authorId = $authorId; 
    } elseif ($categoryId) {
        $quote->categoryId = $categoryId;
    } elseif ($authorId && $categoryId) {
        $quote->authorId && $this->categoryId;
    } elseif ($limit) {
        $quote->limit = $limit;
    }

    //quote query
    $result = $quote->read();


    //get row count
    $num = $result->rowCount();

    //check if any quotes
    if($num > 0) {
        //quote array
        $quotes_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                'author' => $author,
                'category' => $category
            );
            array_push($quotes_arr, $quote_item);
        }
        echo json_encode($quotes_arr);
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );  
    } 



 


        
