<?php
    require 'header.php';
    require 'navbar.php';
    require 'dbConnection.php';

    session_start();
    $db = get_db();

?>
<!DOCTYPE html>
<html>
<head>
    <?php require 'header.php' ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>



</body>
</html>