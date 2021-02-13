<? php
require('database.php');

$query = 'SELECT * FROM todoitems
          ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ToDo List</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <header><h1>Add Items to your ToDo List</h1></header>    
    <main>
        <form action="add_item.php" method="post" id="add_item_form">
            <input type="text" name="title" maxlength="20" required>
            <input type="text" name="description" maxlength="50" required>
            <input type="submit" value="Add Item">
        </form>
        <a href="index.php">View my ToDo List</a>
    </main>
</body>
</html>