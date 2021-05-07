<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


    require '../../config/Database.php';
    require '../../model/Author.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate author object
    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->id = $data->id;
    $author->author = $data->author;


    //update author
    if($author->update()) {
        echo json_encode(
            array('message' => 'Author Updated')
        );
} else {
    echo json_encode(
        array('message' => 'Author Not Updated')
    );

}