<?php

    // require database
    require('config/Database.php');

    //require models
    require('model/Quote.php');
    require('model/Author.php');
    require('model/Category.php');

    //connect to the database
    $database = new Database();
    $db = $database->connect();

    //instantiate models
    $author = new Author($db);
    $category = new Category($db);
    $quote = new Quote($db);


    // Get Parameter data sent to Controller
  
    $authorId = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);

    //Get request Quote Data
    if ($authorId) {
        $quote->authorId = $authorId;
     }
    if ($categoryId) {
        $quote->categoryId = $categoryId; 
    }

    // Read Data
    $authors = $author->read();
    $categories = $category->read();
    $quotes = $quote->read();

    include('view/quotes_list.php');