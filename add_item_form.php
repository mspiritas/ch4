<?php
require('database.php');
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
    <title>My ToDo List</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <main>
        <h1>Add Item</h1>
        <form action="add_item.php" method="post" id="add_item_form">
            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>
            
            <input type="text" id="title" name="title" maxlength="20" placeholder="Title">
            <br>
            <input type="text" id="desc" name="description" maxlength="50" placeholder="Description">
            <input id="add_item_button" type="submit" value="Add Item">

            <!--<label>Title:</label>
            <input type="text" name="Title"><br>

            <label>Description:</label>
            <input type="text" name="description"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Item"><br>-->
        </form>
        <p><a href="index.php">View my ToDo List</a></p>
    </main>
</body>
</html>


 <!--           <form action="add_item.php" method="post"
                    id="add_item_form">
                <input type="text" id="title" name="title" maxlength="20" placeholder="Title">
                <br>
                <input type="text" id="desc" name="description" maxlength="50" placeholder="Description">
                <input id="add_item_button" type="submit" value="Add Item">
            </form>-->