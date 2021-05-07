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

    //get id 
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    //get quote
    $quote->read_single();

    //create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' =>$quote->quote,
        'author' => $quote->author,
        'category' => $quote-> category
    );

    //make JSON
    print_r(json_encode($quote_arr));