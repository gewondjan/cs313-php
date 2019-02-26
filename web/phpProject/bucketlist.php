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
    $bucketlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


    $assocPrimaryPriorityNumbers = array('' => '0', 'A' => 'A', 'B' => 'B', 'C' => 'C');
    echo "<div class='row'>";
    // $lastEntryPrimaryPriority = '';
    // $numberColumnsToAdd = 0;
    // foreach($rows as $row) {

    $bucketlistCoordinateToRow = array();
    foreach($bucketlist as $row) {
        $primaryPrioritySymbol = ($row['primarypriority'] == '') ? '0' : $row['primarypriority']; 
        $row['coordinate'] = $primaryPrioritySymbol . "-" . $row['secondarypriority'];
        $bucketlistCoordinateToRow[$row['coordinate']] = $row;
    }


    // $rowI = 0;
    foreach($abcPriorities as $abcPriority) {
        echo "<div class='col'>";
        $abcPriority['priority'] = ($abcPriority['priority'] == '') ? '0' : $abcPriority['priority'];
        for ($it = 1; $it <= 10; $it++) {
            $coordinate = $abcPriority['priority'] . "-" . $it;
            echo "<div class='card-holder' id='" . $coordinate . "'>";
            if (array_key_exists($coordinate, $bucketlistCoordinateToRow)) {
                $currentItem = $bucketlistCoordinateToRow[$coordinate];
                echo "<div class='card' id='" . $currentItem['id'] . "'>";
                echo "<div class='card-body'><a class='no-underline-link' href='todos.php?bucketlistItemId=" . $currentItem['id'] . "'><h4 class='card-title bucket-list-item'>" . $currentItem['itemdescription'] . "</h4></a>";
                echo "<b>Priority: </b>";
                //Primary Priority
                echo "<label class='priorityLabel' for='abcPriority" . $currentItem['id'] . "'>A-C: </label>";
                echo "<select onchange='moveCard(" . $currentItem['id'] . ")' id='abcPriority" . $currentItem['id'] . "' class='priority prioritySelect'>";

                foreach($abcPriorities as $priority) {
                    echo "<option class='priority' id='abcOption" . $assocPrimaryPriorityNumbers[$priority['priority']] . "-" . $currentItem['id'] . "' value='" . $assocPrimaryPriorityNumbers[$priority['priority']] . "'";
                    if ($priority['priority'] == $currentItem['primarypriority'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">" . $priority['priority'] . "</option>";
                }
                echo  "</select>&nbsp;&nbsp;";
                //Secondard Priority
                echo "<label class='priorityLabel' for='numberPriority" . $currentItem['id'] . "'>1-10: </label>";
                echo "<select onchange='moveCard(" . $currentItem['id'] . ")' id='numberPriority" . $currentItem['id'] . "' class='priority prioritySelect'>";
                for ($i = 0; $i <= 10; $i++){
                    echo "<option class='priority' id='numberOption" . $i . "-" . $currentItem['id'] . "'";
                    if ($i == $currentItem['secondarypriority'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">";
                    echo ($i == 0 ) ?  '' : $i;
                    echo "</option>";
                }
                
                echo "</select>";
                //Close the Card-body div
                echo "</div>";
                //close the card div
                echo "</div>";

            }

            //card-holder close outside of the if statement
            echo "</div>";
        }

        //col close
        echo "</div>";
    }
        // $currentEntryPrimaryPriority = $bucketlist[$rowI]['primarypriority'];
        // $numberColumnsToAdd = $assocPrimaryPriorityNumbers[$currentEntryPrimaryPriority] - $assocPrimaryPriorityNumbers[$lastEntryPrimaryPriority];
        // $lastEntryPrimaryPriority = $currentEntryPrimaryPriority;
        // for ($it = 0; $it < $numberColumnsToAdd; $it++) {
        //     echo "</div><div class='col'><div></div>";
        // }
        
    //Close the row div
    echo "</div>";

?>

</body>
</html>