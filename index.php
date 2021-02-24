<?php
require_once('database.php');

$queryItems = 'SELECT * FROM todoitems
               ORDER BY ItemNum DESC';
$statement = $db->prepare($queryItems);
$statement->execute();
$items = $statement->fetchAll();
$statement->closeCursor();

if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}
$queryCategory = 'SELECT * FROM categories
                  WHERE categoryID = :category_id';
$statement = $db->prepare($queryCategory);
$statement->bindValue(':category_id', $category_id);
$statement->execute();
$category = $statement->fetch();
$category_name = $category['categoryName'];
$statement->closeCursor();

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
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
<main>
    <table id="item_list">
        <th id="list_heading" colspan="3"><h2>ToDo List</h2></th>
        </tr>
        
        <tr>
        <?php foreach ($items as $item) : ?>
            <td colspan="2" id="title2"><?php echo $item['Title']; ?></td>
            <td rowspan="2" id="delete_column">
                <form action="delete_item.php" method="post">
                <input type="hidden" name="item_num"
                    value="<?php echo $item['ItemNum']; ?>">
                <input id="delete_item_button" type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <tr>
            <td id="desc2"><?php echo $item['Description']; ?></td>
        </tr>
        <tr>
            <td>
                <?php foreach ($categories as $category) : ?>
                    <a href=".?category_id=<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?></a>
                   
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    
        <div id="nothing_to_do">    
        <?php if(!empty($items)) { ?>
            <section>
            </section>
        <?php } else { ?>
            <p>You have nothing to do!</p>
            <?php } ?>
        </div>

    <p><a href="category_list.php">Add/Delete Categories</a></p>
    <p><a href="add_item_form.php">Add an item to your list</a></p>
    </main>
</body>
</html>