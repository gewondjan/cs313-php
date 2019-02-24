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
    <?php add_header(); ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>
<h1>Welcome to the bucketlist <?php echo $_SESSION['user_name']; ?></h1>


</body>
</html>