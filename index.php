<?php
require_once('database.php');

if (!isset($item_num)) {
    $item_num = filter_input(INPUT_GET, 'item_num', FILTER_VALIDATE_INT);
    if ($item_num == NULL || $item_num == FALSE) {
        $item_num = 1;
    }
}

$query = 'SELECT * FROM todoitems
          ORDER BY ItemNum DESC';
$statement = $db->prepare($query);
$statement->execute();
$items = $statement->fetchAll();
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
            <td rowspan="2" id="delete_column"><form action="delete_item.php" method="post">
                <input type="hidden" name="item_num"
                    value="<?php echo $item['ItemNum']; ?>">
                <input id="delete_item_button" type="submit" value="Delete">
            </td>
        </tr>
        <tr>
            <td id="desc2"><?php echo $item['Description']; ?></td>
            
                </form>
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

    <table id="add_input">
    <th id="item_heading"><h2 class="add_item_title">Add Item</h2></th>
    <tr>
        <td>
            <form action="add_item.php" method="post"
                    id="add_item_form">
                <input type="text" id="title" name="title" maxlength="20" placeholder="Title">
                <br>
                <input type="text" id="desc" name="description" maxlength="50" placeholder="Description">
                <input id="add_item_button" type="submit" value="Add Item">
            </form>
        </td>
    </tr>
    </table>
    </main>
</body>
</html>