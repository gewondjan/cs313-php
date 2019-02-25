<?php
    require 'dbConnection.php';


?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'header.php' ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>

<?php
    $db = get_db();
    $stmt = $db->prepare('SELECT bl.itemdescription, t.description FROM project.bucketlist AS bl JOIN project.todos AS t ON bl.id = t.bucketlistid WHERE t.bucketlistid = :id');
    $stmt->bindValue(":id", $_GET['bucketlistItemId'], PDO::PARAM_INT);
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<h1>Todos for <?php $todos['itemdescription'] ?></h1>


<ul>
<?php
    foreach($todos as $todo) {
        echo "<li>" . $todo['description'] . "</li>";
    }

?>
</ul>



</body>
</html>