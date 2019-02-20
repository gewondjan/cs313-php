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

    //Enter insert code here

    $action = $_GET['action'];

    switch($action) {
        case 'login':
            break;
        case 'signup':

            $clientUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
 
        
            $statement = $db->prepare('INSERT INTO teamActivity.users VALUES (:username, :password)');
            $statement->bindValue(':username', $clientUsername, PDO::PARAM_STR);
            $statement->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            $statement->execute();

            header("Location: login.php");
            die();    

            break;
        case 'welcome':
            break;
        default:
            echo "we should never be here";
            break;
    }



?>
