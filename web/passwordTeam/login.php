<!DOCTYPE html>
<?php
    session_start();
    $url = parse_url(getenv('DATABASE_URL'));
    
    $dbname = ltrim($url['path'], '/');
    $dbHost = $url['host']; 
    $dbPort = $url['port'];
    
    try
    {
        $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbname", $url['user'], $url['pass']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }

?>

<html>
<head>
</head>
<body>
<h1>Please Sign up with a user name and password</h1>


</body>
</html>