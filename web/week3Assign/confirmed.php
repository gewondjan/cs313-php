<?php

    session_start();
    include 'Cereal.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation Page</title>
</head>
<body>
    <h1>Congratulations, <?php echo $_POST["orderName"]; ?>! Your Order has been confirmed!</h1>
    <h2>The following items are on their way</h2>
    <ul>
        <?php
            $cereal_array = $_SESSION["cereal_array"]; 
            foreach($_SESSION["cereals_checked"] as $cereal) {
                echo "<li>$cereal_array[$cereal]</li>";
            }
            ?>
    </ul>
    <h2>To be shipped to: </h2>
    <h4><? echo $_POST["addressLine"] . "<br>" . $_POST["city"] . ', ' . $_POST["state"] . " " . $_POST["zip"]; ?></h4>
    <h1>Enjoy your Cereal!</h1>
    
</body>
</html>