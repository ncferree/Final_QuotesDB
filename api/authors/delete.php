<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: Delete');
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

    //delete author
    if($author->delete()) {
        echo json_encode(
            array('message' => 'Author Deleted')
        );
} else {
    echo json_encode(
        array('message' => 'Author Not Deleted')
    );

}