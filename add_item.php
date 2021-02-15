<?php

$item_num = filter_input(INPUT_POST, 'item_num', FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, 'title');
$description = filter_input(INPUT_POST, 'description');


require_once('database.php');

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

    include('index.php');

?>