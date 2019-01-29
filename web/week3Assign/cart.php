<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>

<h1>Shopping Cart</h1>
<form method='post' action='<?php $_SERVER["PHP_SELF"];  ?>'>
    <?php

        $cereal_array = $_SESSION["cereal_array"];
        $cereals_checked = $_SESSION["cereals_checked"];
        $final_cereal_list = array();
        if (isset($_POST['remove'])) {
            $remove_list = $_POST['remove'];
            foreach($cereals_checked as $cereal){
                $keep = true;
                foreach($remove_list as $remove) {
                    if ($remove == $cereal) {
                        $keep = false;
                    }
                }
                if ($keep) {
                    array_push($final_cereal_list, $cereal);
                }
            }
        } else {
            $final_cereal_list = $cereals_checked;
        }
        sort($final_cereal_list);
        $_SESSION["cereals_checked"] = $final_cereal_list;

        foreach($final_cereal_list as $cereal) {
            echo "<input type='checkbox' name='remove[]' value='$cereal'><span>$cereal_array[$cereal]</span><br>";
        }

        ?>
        <input type='submit' value='Remove Selected Items'>

</form>
<a href='browse.php'>Keep Shopping</a>
<a href='checkout.php'>Continue to Checkout</a>

</body>
</html>