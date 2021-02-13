<?php
require_once('database.php');

if (!isset($item_num)) {
    $item_num = filter_input(INPUT_GET, 'item_num', FILTER_VALIDATE_INT);
    if ($item_num == NULL || $item_num == FALSE) {
        $item_num = 1;
    }
}

$queryitems = 'SELECT * FROM todoitems
          WHERE ItemNum = :item_num';
$statement = $db->prepare($query);
$statement->bindValue(':item_num', $item_num);
$statement->execute();
$item = $statement->fetch();
$title = $item['Title'];
$statement->closeCursor();

$query = 'SELECT * FROM todoitems
          ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>


<!DOCTYPE html>
<html>

<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<body>
<main>
    <h1>My Items</h1>
    <section>
        <h2><?php echo $title; ?></h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
            
            <?php foreach ($items as $item) : ?>
            <tr>
                <td><?php echo $item['Title']; ?></td>
                <td><?php echo $item['Description']; ?></td>
                <td><form action="delete_item.php" method="post">
                    <input type="hidden" name="item_num"
                           value="<?php echo $item['ItemNum']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_item_form.php">Add Item</a></p>       
    </section>
</main>
</body>
</html>