<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');


    require '../../config/Database.php';
    require '../../model/Category.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate category object
    $category= new Category($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $category->id = $data->id;
    $category->category = $data->category;

    //create category
    if($category->create()) {
        echo json_encode(
            array('message' => 'Category Created')
        );
} else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );

}