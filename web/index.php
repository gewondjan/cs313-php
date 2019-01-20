<!DOCTYPE html>

<html>
<head>
    <title>Ryan Gewondjan Page For CS 313</title>    
    <!--JQUERY Got this from https://www.w3schools.com/jquery/jquery_get_started.asp-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JavaScript File -->
    <script type="text/javascript" src="main.js"></script>
    <!-- Bootstrap Copied from https://getbootstrap.com/docs/4.0/getting-started/introduction/-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="main.css">
    

</head>
<body>
    <?php include "nav.php";  ?>

    <div class ="card-group" id="presentation-banner">
            <?php include 'me.php'; ?>
    </div>
    <div class ="card-deck menu-options">        
        <div class="card options">
                <p class="option-titles" name="me">Me</p>
        </div>
        <div class="card options">
            <p class="option-titles" name="dreams">Dreams</p>
        </div>
        <div class="card options">
            <p class="option-titles" name="code">Code</p>
        </div>
        <div class = "card options">
            <p class="option-titles" name= "fun">Fun</p>
        </div>



    </div>
</body>
</html>