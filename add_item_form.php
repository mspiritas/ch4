<? php
require('database.php');

$query = 'SELECT * FROM todoitems
          ORDER BY ItemNum';
$statement = $db->prepare($query);
$statement->execute();
$items = $statement->fetchAll();
$statement->closeCursor();
?>