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

    $stmtPriorities = $db->prepare('SELECT * FROM project.abcPriority');
    $stmtPriorities->execute();
    $abcPriorities = $stmtPriorities->fetchAll(PDO::FETCH_ASSOC);

    //Add headers to grid
    echo "<div class='row'>";
    echo "<div class='col'><div class='card'>Unassigned</div></div>";
    echo "<div class='col'><div class='card'>A</div></div>";
    echo "<div class='col'><div class='card'>B</div></div>";
    echo "<div class='col'><div class='card'>C</div></div>";   
    echo "</div>";


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
        //Primary Priority
        echo "<select>";
        foreach($abcPriorities as $priority) {
            if ($priority == $row['primarypriority'])
            {
                echo "<option selected='selected'>";
            } else {
                echo "<option>";
            }
            echo $priority . "</option>";
        }
        echo  "</select>";
        //Secondard Priority
        echo "<select>";
        for ($i = 1; $i <= 10; $i++){
            if ($i == $row['secondarypriority'])
            {
                echo "<option selected='selected'>";
            } else {
                echo "<option>";
            }
            echo $i . "</option>";
        }
        
        echo "</select>";
        echo "<p class='card-text'>" . $row[''] . "</p>";
        echo "</div>";
    }
    echo "</div></div>";

?>

</body>
</html>