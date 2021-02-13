<?php

$item_num = filter_input(INPUT_POST, 'item_num', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');

if ($item_num == null || $item_num == false ||
    $title == null || $description == null) {
    $error = "Please enter valid ToDo items.";
    include('error.php');
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO todoitems
                 (ItemNum, Title, Description)
              VALUES
                 (:item_num, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>