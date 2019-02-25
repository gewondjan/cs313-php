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
    <script src="bucketlist.js"></script>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>
<h1>Welcome to the bucketlist <?php echo $_SESSION['user_name']; ?></h1>

<?php
    $db = get_db();
    $stmt = $db->prepare('SELECT bl.id, bl.itemdescription, bl.primarypriority, bl.secondarypriority FROM project.users AS u JOIN project.bucketlist AS bl ON u.id = bl.user_id WHERE u.id = :id ORDER BY primarypriority asc, secondarypriority asc;');
    $stmt->bindValue(":id", $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmtPriorities = $db->prepare('SELECT priority FROM project.abcPriority ORDER BY priority asc');
    $stmtPriorities->execute();
    $abcPriorities = $stmtPriorities->fetchAll(PDO::FETCH_ASSOC);

    //Add headers to grid
    echo "<div class='row'>";
    echo "<div class='col'><div class='card'><h4 class='column-title'>Unassigned</h4></div></div>";
    echo "<div class='col'><div class='card'><h4 class='column-title'>A</h4></div></div>";
    echo "<div class='col'><div class='card'><h4 class='column-title'>B</h4></div></div>";
    echo "<div class='col'><div class='card'><h4 class='column-title'>C</h4></div></div>";   
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
            echo "</div><div class='col'><div></div>";
        }
        echo "<div class='card-holder'>";
        echo "<div class='card' id='" . $row['id'] . "'>";
        echo "<div class='card-body'><a class='no-underline-link' href='todos.php?bucketlistItemId=" . $row['id'] . "'><h4 class='card-title bucket-list-item'>" . $row['itemdescription'] . "</h4></a>";
        echo "<b>Priority: </b>";
        //Primary Priority
        echo "<label class='priorityLabel' for='abcPriority'>A-C: </label>";
        echo "<select onchange='reorderBucketlistBoard(" . $row['id'] . ")' id='abcPriority' class='priority prioritySelect'>";
        foreach($abcPriorities as $priority) {
            if ($priority['priority'] == $row['primarypriority'])
            {
                echo "<option selected='selected' class='priority'>";
            } else {
                echo "<option class='priority'>";
            }
            echo $priority['priority'] . "</option>";
        }
        echo  "</select>&nbsp;&nbsp;";
        //Secondard Priority
        echo "<label class='priorityLabel' for='numberPriority'>1-10: </label>";
        echo "<select id='numberPriority' class='priority prioritySelect'>";
        for ($i = 0; $i <= 10; $i++){
            if ($i == $row['secondarypriority'])
            {
                echo "<option selected='selected' class='priority'>";
            } else {
                echo "<option class='priority'>";
            }
            echo ($i == 0 ) ?  '' : $i; 
            echo "</option>";
        }
        
        echo "</select>";
        //Close the Card-body div
        echo "</div>";
        //close the card div
        echo "</div>";
        //close the card-holder div
        echo "</div>";
    }
    //Close the last column div
    echo "</div>";
    //Close the row div
    echo "</div>";

?>

</body>
</html>