<!DOCTYPE html>
<html>
    <head>
        <title>Group 6</title>
    </head>
    <body>
    <h1>Welcome <?php echo $_POST["name"]; ?></h1>
    <p>Your email is: <?php echo "<a href='mailto:" . $_POST["email"] . "'>" . $_POST["email"] . "</a>"; ?></p>
    <p>Your Major is: <?php echo $_POST["major"]; ?></p>

    <p>Your Comments: <?php echo $_POST["comment"]; ?> </p>
    <ul>
    </ul>

    </body>

</html>