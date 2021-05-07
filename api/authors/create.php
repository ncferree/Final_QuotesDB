<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


    require '../../config/Database.php';
    require '../../model/Author.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate authorobject
    $author= new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->id = $data->id;
    $author->author = $data->author;

    //create author
    if($author->create()) {
        echo json_encode(
            array('message' => 'Author Created')
        );
} else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );

}