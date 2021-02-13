<?php
require_once('database.php');

// Get all categories
$query = 'SELECT * FROM todoitems
                       ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>ToDoList</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>ToDo List</h1></header>
<main>
    <h1>My Items</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>&nbsp;</th>
        </tr>

        <!-- The rest of the table -->
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

    <h2>Add Category</h2>
    
    <!-- add product form -->
    <form action="add_item.php" method="post"
            id="add_item_form">
        <label>Name:</label>
        <input type="text" name="name">
        <input id="add_item_button" type="submit" value="Add Item">
    </form>

    <br>
    <p><a href="index.php">List Products</a></p>

    </main>
</body>
</html>