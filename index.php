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
   $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);

   //Get request Quote Data
   // if ($authorId) {
   //     $quote->authorId = $authorId;
   //  }
   // if ($categoryId) {
   //     $quote->categoryId = $categoryId; 
   // }

   // Read Data
   $authors = $author->read();
   $categories = $category->read();
   //$quotes = $quote->read();

    $query = "?";
    if ($authorId && $categoryId) {
        $query .= "authorId={$authorId}&categoryId={$categoryId}";
    } elseif ($authorId) {
        $query .= "authorId={$authorId}";
    } elseif ($categoryId) {
        $query .= "categoryId={$categoryId}";
    }

    if ($limit) {
        $query .= "&limit={$limit}";
    }


    $url = "https://final-quotesdb.herokuapp.com/{$query}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $res = curl_exec($ch);
    curl_close($ch);

    $quotes = json_decode($res, true);


   include('view/quotes_list.php');
