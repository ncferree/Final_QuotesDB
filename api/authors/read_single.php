<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Author.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate quote object
    $author= new Author($db);

    //get id 
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    //get author
    $author->read_single();

    //create array
    $author_arr = array(
        'id' => $author->id,
        'author' =>$author->author    
    );

    //make JSON
    print_r(json_encode($author_arr));