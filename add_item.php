<?php

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$item_num = filter_input(INPUT_POST, 'item_num', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');

require_once('database.php');

    $query = 'INSERT INTO todoitems
                 (ItemNum, Title, Description, categoryID)
              VALUES
                 (:item_num, :title, :description, :category_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();

    include('index.php');

?>