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
    $stmt = $db->prepare('SELECT bl.itemdescription, t.description, t.completeddate, t.id FROM project.bucketlist AS bl JOIN project.todos AS t ON bl.id = t.bucketlistid WHERE t.bucketlistid = :id ORDER BY t.completeddate desc');
    $stmt->bindValue(":id", $_GET['bucketlistItemId'], PDO::PARAM_INT);
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);




echo "<h1>Todos for " . $todos[0]['itemdescription'] . "</h1>";


echo "<div class='row'><div class='col'>";
foreach($todos as $todo) {
    
    echo "<div class='card'><div class='card-body'>";
    if ($todo['completeddate'] == null) {
        echo "<i id='checkbox-" . $todo['id'] . "' class="far fa-square" onclick='checkTodo(" . $todo['id'] . ")'></i>";
    } else {
        echo "<i id='checkbox-" . $todo['id'] . "' class="far fa-check-square" onclick='uncheckTodo(" . $todo['id'] . ")'></i>";
    }
    echo "<h4>" . $todo['description'] . "</h4>";

    //card and card-body
    echo "</div></div>";
}
//Row and column
echo "</div></div>";

?>

</body>
</html>