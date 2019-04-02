<?php

    function showNavbar() {

        echo '<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">The Bucketlist App</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>&nbsp;&nbsp;
        <li><a href="action.php?action=goToBucketList"> BucketList </a></li>&nbsp;&nbsp;
        <li><a href="loginPage.php"> Sign-In </a></li>
        </ul>
        </div>
        </nav>';
        
        // Got this from: https://www.w3schools.com/bootstrap/bootstrap_navbar.asp
        //Got 'navbar-expand-lg' from https://getbootstrap.com/docs/4.0/components/navbar/
    }

?>