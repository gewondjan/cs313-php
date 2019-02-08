
<?

try {

    $url = getevn('DATABASE_URL');
    
    $dbParts = parse_url($url);
    
    $dbname = ltrim($dbParts['path'], '/');
    
    $db = new PDO("psql:host=$dbParts['host'];port=$dbParts['port'];dbname=$dbname", $dbParts['user'], $dbParts['pass']);
    
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
    <?
        $statement = $db->query('SELECT * from weather');
        
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            echo "<h1>$row['city']</h1>";
        }

    ?>

</body>
</html>