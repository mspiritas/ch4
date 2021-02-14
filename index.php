<?php
require_once('database.php');

if (!isset($item_num)) {
    $item_num = filter_input(INPUT_GET, 'item_num', FILTER_VALIDATE_INT);
    if ($item_num == NULL || $item_num == FALSE) {
        $item_num = 1;
    }
}

$query = 'SELECT * FROM todoitems
          WHERE ItemNum = :item_num';
$statement = $db->prepare($query);
$statement->bindValue(':item_num', $item_num);
$statement->execute();
$items = $statement->fetch();
$title = $items['Title'];
$statement->closeCursor();

$query = 'SELECT * FROM todoitems
          ORDER BY ItemNum DESC';
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
    <h1>My ToDo Items</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>

        <tr>
        <?php foreach ($items as $item) : ?>
            <td><?php echo $item['Title']; ?></td>
            <td><form action="delete_item.php" method="post">
                <input type="hidden" name="item_num"
                    value="<?php echo $item['ItemNum']; ?>">
                <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Item</h2>
    
    <!-- add product form -->
    <form action="add_item.php" method="post"
            id="add_item_form">
        <input type="text" name="name" maxlenth="20" placeholder="Title">
        <input type="text" name="name" maxlenth="50" placeholder="Description">
        <input id="add_item_button" type="submit" value="Add Item">
    </form>

    </main>
</body>
</html>