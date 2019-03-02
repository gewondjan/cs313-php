<?php
    require 'dbConnection.php';
    require 'header.php';
    require 'navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php add_header();  ?>
    <script src='todos.js'></script>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>

<?php
    $db = get_db();
    $stmt = $db->prepare('SELECT bl.id as bucketlistid, bl.itemdescription, t.description, t.completeddate, t.id FROM project.bucketlist AS bl JOIN project.todos AS t ON bl.id = t.bucketlistid WHERE t.bucketlistid = :id ORDER BY t.completeddate desc');
    $stmt->bindValue(":id", $_GET['bucketlistItemId'], PDO::PARAM_INT);
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtForBucketListItem = $db->prepare('SELECT itemdescription FROM project.bucketlist WHERE id = :id');
    $stmtForBucketListItem->bindValue(":id", $_GET['bucketlistItemId'], PDO::PARAM_INT);
    $stmtForBucketListItem->execute();
    $bucketlistItemTitle = $stmtForBucketListItem->fetchAll(PDO::FETCH_ASSOC);


echo "<h1>Todos for " . $bucketlistItemTitle[0]['itemdescription'] . "</h1>";


echo "<div class='row'><div class='col' id='allTodosHolder'>";
foreach($todos as $todo) {
    
    echo "<div class='card' id='todo-" . $todo['id'] . "'><div class='card-body todo-card'>";
    if ($todo['completeddate'] == null) {
        echo "<i id='checkbox-" . $todo['id'] . "' class='large-icon far fa-square' onclick='checkTodo(" . $todo['id'] . ")'></i>&nbsp;";
    } else {
        echo "<i id='checkbox-" . $todo['id'] . "' class='large-icon far fa-check-square' onclick='uncheckTodo(" . $todo['id'] . ")'></i>&nbsp;";
    }
    echo "<div class='todo'><h4 id='todo-title-" . $todo['id'] . "' onclick='editTodo(" . $todo['id'] . ")'>" . $todo['description'] . "</h4></div>";
    echo "<button class='icon-button' onclick='deleteTodo(" . $todo['id'] . ")'><i class='fas fa-times'></i></button>";
    

    //card-body, card
    echo "</div></div>";
}
//Row and column
echo "</div></div>";
echo "<button onclick='addNewTodo(" . $_GET['bucketlistItemId'] . ")'><i class='extra-large-icon center-button fas fa-plus-square'></i><h3>New Todo</h3></button>"

?>

</body>
</html>