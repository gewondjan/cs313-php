<?php

    function showNavbar() {

        echo '<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="bucketlist.php"> BucketList </a></li>
        <li><a href="accomplishments.php"> Accomplishments </a></li>
        <li><a href="loginPage.php"> Sign-In </a></li>
        </ul>
        </div>
        </nav>';
        
        // Got this from: https://www.w3schools.com/bootstrap/bootstrap_navbar.asp
        //Got 'navbar-expand-lg' from https://getbootstrap.com/docs/4.0/components/navbar/
    }

?>