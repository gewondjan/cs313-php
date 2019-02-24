<?php
    require 'header.php';
    require 'navbar.php';
    require 'dbConnection.php';

    session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <?php add_header(); ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>
<h1>Welcome to the bucketlist <?php echo $_SESSION['user_name']; ?></h1>
<?php
    $db = get_db();
    $stmt = $db->prepare('SELECT * FROM project.users AS u JOIN project.bucketlist AS bl ON u.id = bl.user_id WHERE u.id = :id');
    $stmt->bindValue(":id", $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    echo "<ul>";
    foreach($rows as $row) {
        echo "<li>" . $row['itemDescription'] . "</li>";        
    }
    echo "</ul>";
    
?>

</body>
</html>