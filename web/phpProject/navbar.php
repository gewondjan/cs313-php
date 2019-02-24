<?php

    function showNavbar($currentTab) {

        echo '<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
        </ul>
        </div>
        </nav>';
        
        // Got this from: https://www.w3schools.com/bootstrap/bootstrap_navbar.asp
        //Got 'navbar-expand-lg' from https://getbootstrap.com/docs/4.0/components/navbar/
    }

?>