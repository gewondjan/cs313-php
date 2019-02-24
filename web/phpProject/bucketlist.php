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
    $stmt = $db->prepare('SELECT * FROM project.users AS u JOIN project.bucketlist AS bl ON u.id = bl.user_id WHERE u.id = :id ORDER BY primarypriority asc, secondarypriority asc');
    $stmt->bindValue(":id", $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);





    $assocPrimaryPriorityNumbers = array('' => 1, 'A' => 2, 'B' => 3, 'C' => 4);
    echo "<div class='row'><div class='col'>";
    $lastEntryPrimaryPriority = '';
    $numberColumnsToAdd = 0;
    foreach($rows as $row) {
        $currentEntryPrimaryPriority = $row['primarypriority'];
        $numberColumnsToAdd = $assocPrimaryPriorityNumbers[$currentEntryPrimaryPriority] - $assocPrimaryPriorityNumbers[$lastEntryPrimaryPriority];
        $lastEntryPrimaryPriority = $currentEntryPrimaryPriority;
        for ($it = 0; $it < $numberColumnsToAdd; $it++) {
            echo "</div><div class='col'>";
        }
        echo "<div class='card'>";
        echo "<div class='card-body'><h4 class='card-title'>" . $row['itemdescription'] . "</h4></div>";
        echo "</div>";
    }
    echo "</div></div>";

?>

</body>
</html>