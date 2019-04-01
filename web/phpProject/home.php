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
    <? add_header(); ?>
</head>
<body>
<div id='navbar'><?php showNavbar(); ?></div>
<h1>Welcome to the Bucketlist</h1>
<h2><i> - where all your dreams can come true!</i></h2>
<a href="action.php?action=goToBucketList"><button class='btn-primary'>Go to BucketList</button></a>

</body>
</html>