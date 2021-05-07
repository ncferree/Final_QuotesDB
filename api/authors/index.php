<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Author.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $author = new Author($db);

    //author query
    $result = $author->read();

    //get row count
    $num = $result->rowCount();

    //check if any quptes
    if($num > 0) {

        //quote array
        $authors_arr = array();
    
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $author_item = array(
                'id' => $id,
                'author' => $author
            );

            array_push($authors_arr, $author_item);
        }
        echo json_encode($authors_arr);
    } else {
        echo json_encode(
            array('message' => 'No Authors Found')
        );
    }
