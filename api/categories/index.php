<?php
    header('Access-Control-Allow_Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../model/Category.php';

    //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

    //instantiate category object
    $category = new Category($db);

    //category query
    $result = $category->read();

    //get row count
    $num = $result->rowCount();

    //check if any categories
    if($num > 0) {

        //quote array
        $categories_arr = array();
    
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $category_item = array(
                'id' => $id,
                'category' => $category
            );

            array_push($categories_arr, $category_item);
        }
        echo json_encode($categories_arr);
    } else {
        echo json_encode(
            array('message' => 'Categories Found')
        );
    }
