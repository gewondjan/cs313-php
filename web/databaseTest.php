
<?php

try {

    $url = getenv("DATABASE_URL");
    
    $dbParts = parse_url($url);
    
    $dbPort = $dbParts["port"];
    $dbHost = $dbParts["host"];
    $dbname = ltrim($dbParts["path"], "/");
    $dbUsername = $dbParts["user"];
    $dbPassword = $dbParts["pass"];
    

    
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbname", $dbUsername, $dbPassword);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERROMODE_EXCEPTION);
    
} catch (PDOException $exception) {
    echo "Error: " . $exception->getMessage();
    die();
}

?> 
<!DOCTYPE html>
<html>
<head>
</head>

<body>
<h2>Welcome</h2>
    <?php
        // $statement = $db->query('SELECT city from weather');
        
        // while($row = $statement->fetch(PDO::FETCH_ASSOC)){
        //     echo "<h1>" . $row['city'] . "</h1>";
        // }

    ?>

</body>
</html>