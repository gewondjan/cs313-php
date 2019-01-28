<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>

    <?php
        $cereal_array = $_SESSION["cereal_array"];
        $cereals_checked = $_SESSION["cereals_checked"];
        foreach($cereals_checked as $cereal){
            echo "<h1>$cereal_array[$cereal]</h1>";
        }
        echo "<p>$cereal_array[LC]</p>";

    ?>

</body>
</html>