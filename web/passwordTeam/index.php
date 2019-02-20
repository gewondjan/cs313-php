
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

        $clientUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $statement = $db->prepare('SELECT * FROM teamActivity.users WHERE username = :username');
        $statement->bindValue(':username', $clientUsername);
        $statement->execute();            

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);


        if (password_verify($clientPassword, $rows[0]['password'])){
            $_SESSION['user_id'] = $rows[0]['id'];
            header("Location: welcome.php");
            die();    
        } else {
            header("Location: login.php");
            die();  

        }
            break;
        case 'signup':

            $clientUsername = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
            $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            echo "client username: " .  $clientUsername;
            echo "client password: " . $clientPassword;
            echo "hashedPassword: " . $hashedPassword;
        
        
            $statement = $db->prepare('INSERT INTO teamActivity.users (username, password) VALUES (:username, :password)');
            $statement->bindValue(':username', $clientUsername);
            $statement->bindValue(':password', $hashedPassword);
            $statement->execute();


            // include 'login.php';
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
