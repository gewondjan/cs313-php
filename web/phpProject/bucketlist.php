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
    $stmt = $db->prepare('SELECT bl.id, bl.itemdescription, bl.primarypriority, bl.secondarypriority FROM project.users AS u JOIN project.bucketlist AS bl ON u.id = bl.user_id WHERE u.id = :id ORDER BY primarypriority asc, secondarypriority asc, itemdescription asc;');
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


    echo "<div class='row'>";

    $bucketlistCoordinateToRow = array();
    $bucketlistNewItems = array();
    foreach($bucketlist as $row) {
        $row['coordinate'] = $row['primarypriority'] . "-" . $row['secondarypriority'];
        if ($row['coordinate'] != '0-0') {
            $bucketlistCoordinateToRow[$row['coordinate']] = $row;
        } else {
            array_push($bucketlistNewItems, $row);
        }
    }

    function addCard($currentItem, $abcPriorities) {
        echo "<div class='card' id='" . $currentItem['id'] . "'>";
            echo "<div class='card-body'><a class='no-underline-link' href='todos.php?bucketlistItemId=" . $currentItem['id'] . "'><h4 class='card-title bucket-list-item'>" . $currentItem['itemdescription'] . "</h4></a>";
            echo "<b>Priority: </b>";
            //Primary Priority
            echo "<label class='priorityLabel' for='abcPriority" . $currentItem['id'] . "'>A-C: </label>";
            echo "<select onchange='moveCard(" . $currentItem['id'] . ")' id='abcPriority" . $currentItem['id'] . "' class='priority prioritySelect'>";

                foreach($abcPriorities as $priority) {
                    $priorityDisplay = ($priority['priority'] == '0') ? '' : $priority['priority'];
                    echo "<option class='priority' id='abcOption" . $priority['priority'] . "-" . $currentItem['id'] . "' value='" . $priority['priority'] . "'";
                    if ($priority['priority'] == $currentItem['primarypriority'])
                    {
                        echo "selected='selected'";
                    }
                    echo ">" . $priorityDisplay . "</option>";
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
 
    foreach($abcPriorities as $abcPriority) {
        echo "<div class='col'>";
        for ($it = 1; $it <= 10; $it++) {
            $coordinate = $abcPriority['priority'] . "-" . $it;
            echo "<div class='card-holder' id='" . $coordinate . "'>";
            if (array_key_exists($coordinate, $bucketlistCoordinateToRow)) {
                $currentItem = $bucketlistCoordinateToRow[$coordinate];
                addCard($currentItem, $abcPriorities);    
            }

            //card-holder close outside of the if statement
            echo "</div>";
        }

        if ($abcPriority['priority'] = '0'){
            echo "<div id='0-0'>";
            echo "<button class='center-button' onclick='addBucketlistItem()'>NEW</button>";
            foreach($bucketlistNewItems as $newItem) {
                addCard($newItem, $abcPriorities);
            }
            echo "</div>";
        }
            

        //col close
        echo "</div>";
    }
        
    //Close the row div
    echo "</div>";

?>

</body>
</html>