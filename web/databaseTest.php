
<?php

try {

    $url = getenv('DATABASE_URL');
    
    $dbParts = parse_url($url);
    
    $dbPort = $dbParts['port'];
    $dbHost = $dbParts['host'];
    $dbname = ltrim($dbParts['path'], '/');
    

    
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbname", $dbParts['user'], $dbParts['pass']);
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERROMODE_EXCEPTION);
    
} catch (PDOException $exception) {
    echo "Error: " . $exception->getMessage();
    die();
}

?>

<html>
<head>
</head>

<body>
    <?php
        $statement = $db->query('SELECT * from weather');
        
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            echo "<h1>$row['city']</h1>";
        }

    ?>

</body>
</html>