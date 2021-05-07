<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Category.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $category= new Category($db);

    //get id 
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //get category
    $category->read_single();

    //create array
    $category_arr = array(
        'id' => $category->id,
        'category' =>$category->category    
    );

    //make JSON
    print_r(json_encode($category_arr));