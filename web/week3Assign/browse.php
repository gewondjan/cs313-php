<?php
    session_start();
    include 'Cereal.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Browse for Cereal</title>
</head>
<body>
    <h1>Welcome to Cereal Delivery</h1>
    <h2>For the moments when you are in need of a bowl of cereal.</h2>
    <br>
    <h3>Choose from our wide selection of cereals.</h3>


    <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">

    <?php
        $cereals = array("LC" => "Lucky Charms", "CC" => "Captain Crunch", "GN" => "Grape Nuts", "CH" => "Cherios",
                        "HBO" => "Honey Bunches of Oats", "T" => "Trix", "FL" => "Fruit Loops", "FF" => "Frosted Flakes",
                        "FP" => "Fruity Pebbles");
       
        if (!isset($_SESSION["cereal_array"])) {
            $_SESSION["cereal_array"] = $cereals;
        }

        if (isset($_POST['cereals_checked'])) {
            $_SESSION['cereals_checked'] = $_POST['cereals_checked'];
            
            $master_cereal_list = (isset($_SESSION['master_cereal_list']) ? $_SESSION['master_cereal_list'] : array());
            //NEED EITHER A CONSTRUCTOR OR SETTER FUNCTION
            // foreach($_SESSION['cereals_checked'] as $cereal_id) {
            //     $temp = new Cereal();
            //     $temp->name = $cereals[$cereal_id];
            //     //If the quantity was specified for that particular cereal, then use that, but if not just use 1.
            //     $temp->count = isset($_POST["number$cereal_id"]) ? $_POST["number$cereal_id"] : 1;
            //     $master_cereal_list[$cereal_id] = $temp;
            // }        

            $_SESSION['master_cereal_list'] = $master_cereal_list;

        }

        foreach ($cereals as $cereal_id => $cereal_name){
            echo "<input type='checkbox' name='cereals_checked[]' value='$cereal_id'><span>$cereal_name</span>";
            echo "<input list='numbers$cereal_id' name='number$cereal_id'><datalist id='numbers$cereal_id'><option value='1'><option value='2'><option value='3'><option value='4'></datalist><br>";
        }
    ?>
        <input type="submit" value="Add to Cart">
    </form>

    <a href="cart.php">View Cart</a>

</body>
</html>