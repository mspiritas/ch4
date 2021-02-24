<?php
require_once('database.php');

$query = 'SELECT * FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <main>
        <h2>Category List</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td>
                    <?php echo $category['categoryName']; ?>
                </td>
                <td>
                    <form action="delete_category.php" method="post">
                    <input type="hidden" name="category_id"
                        value="<?php echo $category['categoryID']; ?>">
                    <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        
        <h2>Add Category</h2>
            <form action="add_category.php" method="post"
                    id="add_category_form">
                <input type="text" name="name" placeholder="Category name">
                <input id="add_category_button" type="submit" value="Add Category">
            </form>

        <p><a href="index.php">Go back to ToDo List</a></p>

    </main>
</body>
</html>