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
<h1>Log-in Page</h1>
<form action="index.php?action=login" method="post" autocomplete="off">

<label for='username'>Enter Username:</label>
<input type='text' id='username' name='username'>

<label for='password'>Enter Username:</label>
<input type='password' id='password' name='password'>

<input type='submit'>
</form>


</body>
</html>